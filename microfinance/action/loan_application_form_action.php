<?php
session_start();

// Include the connection file
include '../settings/connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Collect form data and assign each to a variable
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $gender = $_POST['gender'];
    $amount = $_POST['amount'];
    $purpose = $_POST['pur'];
    $address = $_POST['stadd'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT); // hash passwords to encrypt the password

    // Check if phone number already exists
    $check_phone_query = "SELECT * FROM loan_application WHERE phone = ?";
    $check_phone_stmt = $conn->prepare($check_phone_query);
    $check_phone_stmt->bind_param("s", $phone);
    $check_phone_stmt->execute();
    $check_phone_stmt->store_result();
    $phone_count = $check_phone_stmt->num_rows;
    $check_phone_stmt->close();

    if ($phone_count > 0) {
        // Phone number already exists, redirect to duplicate alert page
        header("Location: ../pop_up_messages/display_duplicate_loan_phone_alert.php");
        exit();
    }

    // Check if email already exists
    $check_email_query = "SELECT * FROM loan_application WHERE email = ?";
    $check_email_stmt = $conn->prepare($check_email_query);
    $check_email_stmt->bind_param("s", $email);
    $check_email_stmt->execute();
    $check_email_stmt->store_result();
    $email_count = $check_email_stmt->num_rows;
    $check_email_stmt->close();
    
    if ($email_count > 0) {
        // Email already exists, redirect to duplicate alert page
        header("Location: ../pop_up_messages/display_duplicate_loan_email_alert.php");
        exit();
    } 

    // Set default value for rid for standard users
    $rid = 3;

    // Write your INSERT query using the variables above
    $sql = "INSERT INTO loan_application (rid, fname, lname, email, phone, address, amount, purpose, gender, passwd) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    // Prepare the statement
    $stmt = $conn->prepare($sql);
    
    // Bind parameters
    $stmt->bind_param("isssssisss", $rid, $fname, $lname, $email, $phone, $address, $amount, $purpose, $gender, $hashed_password);

    // Execute the query
    if ($stmt->execute()) {
        // Get the last inserted id from loan_application table
        $loan_application_id = $stmt->insert_id;

        // Update rid in the people table for the user who submitted the form
        // Assuming user_id is stored in the session and that it refers to the correct user in the people table
        $user_id = $_SESSION['user_id']; // Assuming user_id is stored in the session
        $update_rid_query = "UPDATE people SET rid = 5 WHERE pid = ?";
        $update_rid_stmt = $conn->prepare($update_rid_query);
        $update_rid_stmt->bind_param("i", $user_id);
        $update_rid_stmt->execute();
        $update_rid_stmt->close();

        // Registration successful, display the popup message
        echo "<!DOCTYPE html>
        <html>
        <head> 
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Pop-up Message - Asmaan MicroFinance</title>
            <style>
                body{
                    font-family: Times New Roman, sans-serif;
                    text-align: center;
                    background-image: url('../img/m7.jpg'); 
                    background-size: cover;
                    background-attachment: fixed;
                    background-position: bottom;
                    background-repeat: no-repeat;
                    margin: 0;
                    padding: 0;
                }

                .containerrr{ 
                    width: 50%;
                    height: 30vh;
                    display: flex;
                    align-items: center;
                    justify-content:center;
                }

                .btnnn{
                    padding: 10px 60px;
                    background: #fff;
                    border: 0;
                    outline: none;
                    cursor: pointer;
                    font-size: 22px;
                    font-weight: 500;
                    border-radius: 30px;
                }

                .popup {
                    width: 400px;
                    background: #fff;
                    border-radius: 6px;
                    position: absolute;
                    top: 0;
                    left: 50%;
                    transform: translate(-50%, -50%) scale(0.1);
                    text-align: center;
                    padding: 0 30px 30px;
                    color: #333;
                    visibility: hidden;
                    transition: transform 0.4s, top 0.4s;
                }

                .open-popup{
                    visibility: visible;
                    top: 50%;
                    transform: translate(-50%, -50%) scale(1);
                }

                .popup img{
                    width: 100px;   
                    margin-top: -50px;
                    border-radius: 50%;
                    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
                }

                .popup h2{
                    font-size: 38px;
                    font-weight: 500;
                    margin: 30px 0 10px;
                }
                
                .popup button{
                    width: 100%;
                    margin-top: 50px;
                    padding: 10px 0;
                    background: #6fd649;
                    color: #fff;
                    border: 0;
                    outline: none;
                    font-size: 18px;
                    cursor: pointer;
                    box-shadow: 0 5px 5px rgba(0,0,0,0.2);
                }
            </style>
        </head>
        <body>
            <div class='container'>
                <div class='popup' id='popup'>
                    <img src='../img/reg1b.png'>
                    <h1>!Congratulations</h1>
                    <p style='font-size:21px'>Your loan application was submitted successfully</p>
                    <button type='button' onclick='redirect()'>OK</button>
                </div>
            </div>

        <script>
        let popup = document.getElementById('popup');

        // Automatically open the popup
        window.onload = function() {
            popup.classList.add('open-popup');
        }

        // Redirect function
        function redirect() {
            // Redirect to the client view
            window.location.href = '../view/home_view_both.php';
        }
        </script>
        </body>
        </html>";
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
