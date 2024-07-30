<?php
include("../settings/repaymentHeader.php");
include("../pop_up_messages/repayment_page_pop_up.php");
include("../action/client_page_action.php");
include '../settings/connection.php';


// Function to check for login
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Check if the user is logged in, else redirect to login page
if (!isLoggedIn()) {
    header("Location: ../login/login_view.php");
    die();
}

// Function to get the user's role ID
function getUserRoleID() {
    if (isset($_SESSION['role_id'])) {
        return $_SESSION['role_id'];
    } else {
        return false;
    }
}

// Check if there is an error message set in the session
if (isset($_SESSION['assign_error'])) {
    // Display the error message
    echo "<h2 style='color: red; text-align: center; font-family: Times New Roman,san-serif; font-size:18px;'>" . $_SESSION['assign_error'] . "</h2>";

    // Unset the session variable to clear the message
    unset($_SESSION['assign_error']);
}

function assign_error($error_message) {
    $_SESSION['assign_error'] = $error_message;
}

// Check user role
$userRoleID = getUserRoleID();
if ($userRoleID !== false) {
    // Check if the user is not a Standard user
    if ($userRoleID != 4) {
        $_SESSION['assign_error'] = "Repayment Page is only for users granted loan [clients]";
        // Redirect to login page for non-clients
        header("Location: ../login/login_view.php");
        die();
    }
} else {
    // Redirect to login page if user role is not available
    header("Location: ../login/login_view.php");
    die();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Repayment Page - Asmaan MicroFinance</title>
    <style>
        body {
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
        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px;
            text-decoration: none;
            color: black;
            background-color: orange;
            border-radius: 5px;
        }

	button {
    	    padding: 10px 20px;
    	    font-size: 16px;
    	    border: none;
    	    border-radius: 4px;
    	    cursor: pointer;
    	    background-color: #007bff;
    	    color: #fff;
	}

	button:hover {
            background-color: #0056b3;
	}
    </style>
</head>
<body>

</body>
</html>