<?php
include("../settings/header.php"); 

// Include core.php
include '../settings/core.php';

include '../settings/connection.php';

function assign_error($error_message) {
    $_SESSION['assign_error'] = $error_message;
}

// Check if there is an error message set in the session
if(isset($_SESSION['assign_error'])) {
    // Display the error message
    echo "<h2 style='color: red; text-align: center; font-family: Times New Roman,san-serif; font-size:18px;'>".$_SESSION['assign_error']."</h2>";

    // Unset the session variable to clear the message
    unset($_SESSION['assign_error']);
}

// Check user role
$userRoleID = getUserRoleID();
if ($userRoleID !== false) {
    // Check if the user is not a Standard user
    if ($userRoleID != 3 && $userRoleID != 5) {
	$_SESSION['assign_error'] = "Client Page: only for standard users who have applied for a loan.";
        // Redirect to main dashboard|user homepage for admin users
        header("Location: home_view_admin.php");
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Page Login- Asmaan MicroFinance</title>
    <link rel="stylesheet" href="../css/client_login_view.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
	body {
	    font-family: Times New Roman, sans-serif;
	}
    </style>
</head>
<body>
    <div class="container">
        <h2>Log into Client Page</h2>
        <form id="login-form" action="../action/client_page_action.php" method="post">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" placeholder="Email" id="email" name="email" required>
		<span class="fas fa-user"></span>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" placeholder="Password" id="password" name="password" required>
                <span class="fas fa-lock"></span>
            </div>
            <p style="text-align: center; font-family: Times New Roman, sans-serif; text-decoration: underline; font-size:21px;">
		<button type="submit" name="login" id="btn" onclick="return validateClient()" style="text-align: center; font-family: Times New Roman, sans-serif;">My Page</button>
	    </p>
        </form>
        <p class="register-link"><span style="color: red; font-family: Times New Roman, sans-serif;">Only our clients are eligible to client page</span> | <a href="home_view_admin.php" style="color:green; text-decoration: underline; font-size:18px;">Back <i class='bx bx-log-out'></i></a></p>
    </div>

    <script>
	    function validateClient() {
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            const passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[^\s]{8,}$/;
        
            if (!emailRegex.test(email)) {
                alert('Please enter a valid email address');
                return false;
            }
        
            if (!passwordRegex.test(password)) {
                alert('Please enter a valid password. Password must contain at least 8 characters');
                return false;
            }
            return true;
        }
    </script>
</body>
</html>
