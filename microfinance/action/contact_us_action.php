<?php
// Include the connection file
include '../settings/connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Collect form data and assign each to a variable
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $message = $_POST['message'];


    // Check if email already exists
    $check_email_query = "SELECT * FROM contact_us WHERE email = ?";
    $check_email_stmt = $conn->prepare($check_email_query);
    $check_email_stmt->bind_param("s", $email);
    $check_email_stmt->execute();
    $check_email_stmt->store_result();
    $email_count = $check_email_stmt->num_rows;
    $check_email_stmt->close();
    
    if ($email_count > 0) {
        // Registration successful, redirect to registration success page
        header("Location: ../pop_up_messages/display_duplicate_contact_us_email_alert.php");
        exit();
    } 

    // Set default value for rid for standard users
    $rid = 3;
    
    // Write your INSERT query using the variables above
    $sql = "INSERT INTO contact_us ( rid, fname, lname, email, message) VALUES ( ?, ?, ?, ?, ?)";
    
    // Prepare the statement
    $stmt = $conn->prepare($sql);
    
    // Bind parameters
    $stmt->bind_param("issss", $rid, $fname, $lname, $email, $message );

    // Execute the query
    if ($stmt->execute()) {
        // Registration successful, redirect to registration success page
        header("Location: ../pop_up_messages/display_successful_contact_us_form_submission.php");
        exit();
    } else {
        // Registration failed, display error on register_view page
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    // Close statement
    $stmt->close();
    
    // Close connection
    $conn->close();
}
?>