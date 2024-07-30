<?php
include '../settings/connection.php';
include ("../settings/core.php");
include_once '../functions/all_transaction_fxn.php';

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
    $t_id = intval($_POST['t_id']);
    $outstanding_balance = floatval($_POST['amount_loaned_to']);
        
    // Write UPDATE query to update outstanding balance in the database
    $sql = "UPDATE transaction_mgt SET outstanding_balance = ? WHERE t_id = ?";
    
    // Prepare the statement
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        // Bind parameters
        $stmt->bind_param("di", $outstanding_balance, $t_id);
        
        // Execute the query
        if ($stmt->execute()) {
            header("Location: ../pop_up_messages/display_update_successful.php");
            exit();
        } else {
            // Error executing query
            echo "Error: Unable to update the outstanding_balance.";
        }
        
        // Close statement
        $stmt->close();
    } else {
        // Error preparing statement
        echo "Error: Unable to prepare the update statement.";
    }
} else {
    // Form not submitted, redirect back to transaction management page
    header("Location: ../admin/transaction management.php");
    exit();
}

// Close connection
$conn->close();

?>

