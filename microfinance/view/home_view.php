<?php
include("../settings/homeHeader.php"); 

// Include core.php
include '../settings/core.php';

include '../settings/connection.php';

// Check user role
$userRoleID = getUserRoleID();
if ($userRoleID !== false) {
    // Check if the user is not logged in.
    if ($userRoleID != 3) {
        // Redirect to login page if user is not logged in
        header("Location: ../login/login_view.php");
        die();
    }
} 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homeview - Asmaan MicroFinance</title>
    <link rel="stylesheet" href="../css/home_view.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <nav>
        <ul style="text-align:center;">
            <li><a href="about_us.php" style="color:#0056b3; text-decoration: underline; font-size:21px;">About Us</a></li>
            <li><a href="contact_us.php" style="color:#0056b3; text-decoration: underline; font-size:21px;">Contact Us</a></li>
	    <li><a href="../login/logout_view.php" style="color:red; text-decoration: underline; font-size:21px;">Logout <i class='bx bx-exit'></i></a></li>        
        </ul>
    </nav>
    <section class="hero">
        <div class="container">
            <h3 style="color:white">We are your <b style="color:lightgreen">reliable</b> partner in <b style="color:orange">financial empowerment</b></h3>
	    <br><br>
            <a href="loan_application_form.php" class="btn">Apply Now</a>
        </div>
    </section>

<div class="container p-3 my-5 bg-dark text-white">
    <img src="../img/m1.webp" alt="Login Image" style="width: 70%; max-width: 400px; height: auto;">
    <ol style="font-size:30px; font-family:Times New Roman, sans-serif;">
        <li>
            <h3><b>Easy Application Process</b></h3> 
            <p style="color:green">Apply for a loan in minutes with our simple online application</p>
	    <p style="color:cyan">We issue loans from 100 GHS - 10000 GHS</p>
	    <p style="color:cyan">Our interest rate ranges from 10% - 50% of the principal amount</p>
        </li>
        <li> 
            <h3><b>Quick Approval</b></h3>  
            <p style="color:gold">Get approved for your loan quickly with our streamlined process</p>
        </li>
        <li> 
            <h3>Flexible Repayment Options</h3>  
            <p style="color:#0056b3">Choose from a variety of repayment terms that fit your budget</p>
        </li>
    </ol>
</div>


    <footer>
        <div class="container">
            <p style="color:gold"><b> &copy; 2024 Asmaan Microfinance. All rights reserved </b></p>
        </div>
    </footer>


</body>
</html>
