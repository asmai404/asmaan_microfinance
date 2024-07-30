<?php
// Start session
session_start();

// Include the connection file
include '../settings/connection.php';

// Check if login button was clicked
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Collect form data and store in variables
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Write a query to SELECT a record from the people table using the email
    $sql = "SELECT pid, password, rid FROM people WHERE email = ?";
    
    // Prepare the statement
    $stmt = $conn->prepare($sql);
    
    // Bind parameters
    $stmt->bind_param("s", $email);
    
    // Execute the query
    $stmt->execute();
    
    // Store the result
    $stmt->store_result();
    
    // Check if any row was returned
    if ($stmt->num_rows == 1) {
        // Bind the result variables
        $stmt->bind_result($pid, $hashed_password, $rid);
        
        // Fetch the record
        $stmt->fetch();
        
        // Verify password user provided against database record using password_verify
        if (password_verify($password, $hashed_password)) {
            // Password is correct, create session for user id and role id
            $_SESSION['user_id'] = $pid;
            $_SESSION['role_id'] = $rid;

	    // Redirect based on role ID
            if ($rid == 1 || $rid == 2) {
                // Redirect to admin page
                header("Location: ../admin/admin_dashboard.php");
            } elseif ($rid == 3) {
                // Redirect users to home view
                header("Location: ../view/home_view.php");
            } elseif ($rid == 5) {
                // Redirect users to home view for loan applicants
                header("Location: ../view/home_view_client.php");
            }
            exit();
        } else {
            // Incorrect password, provide appropriate response
            header("Location: ../pop_up_messages/incorrect_login_password.php");
            exit();
        }
    } else {
        // No record found (Incorrect email), provide appropriate response
        header("Location: ../pop_up_messages/incorrect_login_email.php");
        exit();
    }
    
    // Close statement
    $stmt->close();
    
    // Close connection
    $conn->close();
} else {
    // Stop processing and provide appropriate message or direction
    echo "Login button not clicked";
}
?>
