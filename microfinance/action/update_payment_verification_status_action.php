<?php
include '../settings/core.php';
include '../settings/connection.php';

function assign_error($error_message) {
    $_SESSION['assign_error'] = $error_message;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if t_id and status are provided
    if (isset($_POST['t_id']) && isset($_POST['status'])) {
        // Sanitize the input
        $t_id = mysqli_real_escape_string($conn, $_POST['t_id']);
        $new_status = mysqli_real_escape_string($conn, $_POST['status']);

        // Fetch the current status of the transaction
        $query = "SELECT sid FROM transaction_mgt WHERE t_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $t_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $current_status = $result->fetch_assoc()['sid'];

            // Check if the current status is confirmed (sid = 3)
            if ($current_status == 3) {
                // Prevent update and display error message
                assign_error("The transaction status is already confirmed and cannot be reversed.");
                header("Location: ../admin/update_payment_verification_status.php?t_id=" . $t_id);
                exit();
            } else {
                // Update the status of the transaction_mgt in the database
                $update_query = "UPDATE transaction_mgt SET sid = ? WHERE t_id = ?";
                $update_stmt = $conn->prepare($update_query);
                $update_stmt->bind_param("ii", $new_status, $t_id);

                // Execute the update query
                if ($update_stmt->execute()) {
                    // Redirect to the success page
                    header("Location: ../pop_up_messages/display_update_successful.php");
                    exit();
                } else {
                    // Error updating status, display error message
                    echo "Error updating status: " . $conn->error;
                }
                
                // Close statement
                $update_stmt->close();
            }
        } else {
            // If t_id not found, handle the error appropriately
            assign_error("Transaction not found.");
            header("Location: ../admin/update_payment_verification_status.php?t_id=" . $t_id);
            exit();
        }
        
        // Close statement
        $stmt->close();
    } else {
        // If t_id or status is not provided, handle the error appropriately
        assign_error("Transaction ID or status is missing.");
        header("Location: ../admin/update_payment_verification_status.php");
        exit();
    }
} else {
    // If the form is not submitted via POST method, redirect back to the transaction management page
    header("Location: ../admin/transaction_management.php");
    exit();
}

// Close connection
$conn->close();
?>
