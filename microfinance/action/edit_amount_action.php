<?php
include '../settings/connection.php';
include ("../settings/core.php");
include_once '../functions/client_fxn.php';

// Start the session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function assign_error($error_message) {
    $_SESSION['assign_error'] = $error_message;
}

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Retrieve form data
    $c_id = intval($_POST['c_id']);
    $new_amount_loaned_to = floatval($_POST['amount_loaned_to']);
    
    // Retrieve client details
    $client_query = "SELECT client_name, email, amount_loaned_to FROM clients WHERE c_id = ?";
    $client_stmt = $conn->prepare($client_query);
    $client_stmt->bind_param("i", $c_id);
    $client_stmt->execute();
    $client_stmt->bind_result($client_name, $client_email, $current_amount_loaned_to);
    $client_stmt->fetch();
    $client_stmt->close();

    // Check if the current amount_loaned_to is found in the principal_amount column in transaction_mgt table
    $check_query = "SELECT COUNT(*) FROM transaction_mgt WHERE client_name = ? AND email = ? AND principal_amount = ?";
    $check_stmt = $conn->prepare($check_query);
    $check_stmt->bind_param("ssd", $client_name, $client_email, $current_amount_loaned_to);
    $check_stmt->execute();
    $check_stmt->bind_result($count);
    $check_stmt->fetch();
    $check_stmt->close();

    if ($count > 0) {
        // The current amount_loaned_to is found in the principal_amount column, do not allow update
        $_SESSION['assign_error'] = "Cannot Update: amount loaned out should remain unchanged";
        header("Location: ../admin/loan_management.php");
        exit();
    } else {
        // Update the amount_loaned_to in clients table
        $update_query = "UPDATE clients SET amount_loaned_to = ? WHERE c_id = ?";
        $update_stmt = $conn->prepare($update_query);
        $update_stmt->bind_param("di", $new_amount_loaned_to, $c_id);

        if ($update_stmt->execute()) {
            // Client loan status updated successfully
            header("Location: ../pop_up_messages/display_successful_edit_client_details.php");
            exit();
        } else {
            // Error executing update query
            echo "Error: Unable to update the client loan status.";
        }

        $update_stmt->close();
    }
} else {
    // Form not submitted
    header("Location: ../admin/loan_management.php");
    exit();
}

// Close connection
$conn->close();
?>
