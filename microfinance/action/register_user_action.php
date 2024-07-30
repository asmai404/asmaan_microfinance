<?php
// Include the connection file
include '../settings/connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Collect form data and assign each to a variable
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT); // hash passwords to encrypt the password

    // Check if phone number already exists
    $check_phone_query = "SELECT * FROM people WHERE phone = ?";
    $check_phone_stmt = $conn->prepare($check_phone_query);
    $check_phone_stmt->bind_param("s", $phone);
    $check_phone_stmt->execute();
    $check_phone_stmt->store_result();
    $phone_count = $check_phone_stmt->num_rows;
    $check_phone_stmt->close();

    if ($phone_count > 0) {
        // Registration successful, redirect to registration success page
        header("Location: ../pop_up_messages/display_duplicate_phone_alert.php");
        exit();
    }

    // Check if email already exists
    $check_email_query = "SELECT * FROM people WHERE email = ?";
    $check_email_stmt = $conn->prepare($check_email_query);
    $check_email_stmt->bind_param("s", $email);
    $check_email_stmt->execute();
    $check_email_stmt->store_result();
    $email_count = $check_email_stmt->num_rows;
    $check_email_stmt->close();
    
    if ($email_count > 0) {
        // Registration successful, redirect to registration success page
        header("Location: ../pop_up_messages/display_duplicate_email_alert.php");
        exit();
    } 

    // Set default value for rid for standard users
    $rid = 3;
    
    // Write your INSERT query using the variables above
    $sql = "INSERT INTO people ( fname, lname, gender, dob, phone, email, password, rid) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?)";
    
    // Prepare the statement
    $stmt = $conn->prepare($sql);
    
    // Bind parameters
    $stmt->bind_param("sssssssi", $fname, $lname, $gender, $dob, $phone, $email, $hashed_password, $rid);

    // Execute the query
    if ($stmt->execute()) {
        // Registration successful, redirect to registration success page
        header("Location: ../pop_up_messages/display_successful_registration.php");
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