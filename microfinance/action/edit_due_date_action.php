<?php

$_POST['c_id'];
include '../settings/core.php';
include '../settings/connection.php';

function assign_error($error_message) {
    $_SESSION['assign_error'] = $error_message;
}

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Retrieve form data
    $c_id = $_POST['c_id'];
    $due_date = $_POST['due_date'];

    // Ensure the due date is in the future
    $currentDate = date('Y-m-d');
    if ($due_date <= $currentDate) {
        $_SESSION['assign_error'] = "Loan due date must be in the future";
        header("Location: ../admin/loan_management.php?error=prepare");
        exit();
    }
    
    // Write UPDATE query to update client details in the database
    $sql = "UPDATE clients SET due_date = ? WHERE c_id = ?";
    
    // Prepare the statement
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        // Bind parameters
        $stmt->bind_param("si", $due_date, $c_id);
        
        // Execute the query
        if ($stmt->execute()) {
            // Client loan status updated successfully
            header("Location: ../pop_up_messages/display_successful_edit_client_details.php");
            exit();
        } else {
            // Error executing query
            echo "Error: Unable to update the client loan status.";
        }
        
        // Close statement
        $stmt->close();
    } else {
        // Error preparing statement
        echo "Error: Unable to prepare the update statement.";
    }
} else {
    // Form not submitted
    header("Location: edit_amount_dashboard.php");
    exit();
}
?>
