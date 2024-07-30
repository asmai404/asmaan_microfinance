<?php

$_POST['c_id'];

include '../settings/connection.php';

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Retrieve form data
    $c_id = $_POST['c_id'];
    $repayment_method = $_POST['repayment_method'];
    
    // Write UPDATE query to update client details in the database
    $sql = "UPDATE clients SET repayment_method = ? WHERE c_id = ?";
    
    // Prepare the statement
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        // Bind parameters
        $stmt->bind_param("si", $repayment_method, $c_id);
        
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
