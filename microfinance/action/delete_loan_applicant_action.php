<?php
// Include the connection file
include("../admin/header.php");
include '../settings/connection.php';
include '../functions/loanee_fxn.php';

// Check if the loan application ID is provided in the GET request
if (isset($_GET['la_id'])) {
    // Retrieve the loan application ID from the GET parameter and sanitize it
    $la_id = intval($_GET['la_id']);

    // Prepare and execute the delete query only if the ID is valid
    if ($la_id > 0) {
        // Write the DELETE query to delete the loan application record from the database
        $sql = "DELETE FROM loan_application WHERE la_id = ?";

        // Prepare the statement
        $stmt = $conn->prepare($sql);

        // Check if the statement was prepared successfully
        if ($stmt) {
            // Bind parameters
            $stmt->bind_param("i", $la_id);

            // Execute the query
            if ($stmt->execute()) {
                // Attendance record deleted successfully, redirect to appropriate page
                header("Location: ../admin/client_management.php");
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
        // Invalid loan application ID provided
        echo "Error: Invalid attendance ID.";
    }
} else {
    // Loan application ID not provided
    echo "Error: Loan application ID not provided.";
}

// Close connection
$conn->close();
?>
