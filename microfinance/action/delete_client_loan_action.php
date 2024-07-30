<?php
// Start the session
session_start();

// Include the connection file
include("../admin/header.php");
include ("../settings/core.php");
include '../settings/connection.php';
include '../functions/client_fxn.php';

function assign_error($error_message) {
    $_SESSION['assign_error'] = $error_message;
}

// Check if the client ID is provided in the GET request
if (isset($_GET['c_id'])) {
    // Retrieve the client ID from the GET parameter and sanitize it
    $c_id = intval($_GET['c_id']);

    // Prepare and execute the delete query only if the ID is valid
    if ($c_id > 0) {
        // Retrieve the client name and email from the clients table based on c_id
        $client_query = "SELECT client_name, email FROM clients WHERE c_id = ?";
        $client_stmt = $conn->prepare($client_query);
        $client_stmt->bind_param("i", $c_id);
        $client_stmt->execute();
        $client_stmt->bind_result($client_name, $client_email);
        $client_stmt->fetch();
        $client_stmt->close();

        // Check the outstanding balance from the transaction_mgt table
        $balance_query = "SELECT outstanding_balance FROM transaction_mgt WHERE client_name = ? AND email = ?";
        $balance_stmt = $conn->prepare($balance_query);
        $balance_stmt->bind_param("ss", $client_name, $client_email);
        $balance_stmt->execute();
        $balance_stmt->bind_result($outstanding_balance);
        $balance_stmt->fetch();
        $balance_stmt->close();

        // Proceed only if the outstanding balance is 0
        if ($outstanding_balance == 0) {
            // Update loan_application table to set rid to 3 where fname and lname match the client_name
            $update_loan_application_query = "UPDATE loan_application SET rid = 3 WHERE CONCAT(fname, ' ', lname) = ?";
            $update_stmt = $conn->prepare($update_loan_application_query);
            $update_stmt->bind_param("s", $client_name);
            $update_result = $update_stmt->execute();
            $update_stmt->close();

            if ($update_result) {
                // Write the DELETE query to delete the client/loan granted record from the database
                $delete_sql = "DELETE FROM clients WHERE c_id = ?";
                // Prepare the statement
                $stmt = $conn->prepare($delete_sql);

                // Check if the statement was prepared successfully
                if ($stmt) {
                    // Bind parameters
                    $stmt->bind_param("i", $c_id);

                    // Execute the query
                    if ($stmt->execute()) {
                        // Client/loan granted record deleted successfully, proceed to delete from transaction_mgt table
                        $delete_transaction_query = "DELETE FROM transaction_mgt WHERE client_name = ? AND email = ?";
                        $delete_transaction_stmt = $conn->prepare($delete_transaction_query);
                        $delete_transaction_stmt->bind_param("ss", $client_name, $client_email);
                        $delete_transaction_stmt->execute();
                        $delete_transaction_stmt->close();

                        // Redirect to the appropriate page
                        header("Location: ../admin/loan_management.php");
                        exit();
                    } else {
                        // Error executing query
                        echo "Error: Unable to execute the delete query.";
                    }

                    // Close statement
                    $stmt->close();
                } else {
                    // Error preparing statement
                    echo "Error: Unable to prepare the delete statement.";
                }
            } else {
                // Error updating loan application
                echo "Error: Unable to update loan application.";
            }
        } else {
            // Client has an outstanding balance, cannot delete
            $_SESSION['assign_error'] = "Cannot Delete: Client has an active outstanding balance";
            header("Location: ../admin/loan_management.php");
            exit();
        }
    } else {
        // Invalid client ID provided
        echo "Error: Invalid client ID.";
    }
} else {
    // Client ID not provided
    echo "Error: Client ID not provided.";
}

// Close connection
$conn->close();
?>
