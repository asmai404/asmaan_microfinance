<?php
include("../settings/header.php");
include '../settings/core.php';
include '../settings/connection.php';
include '../functions/loanee_fxn.php';

// Check user role
$userRoleID = getUserRoleID();
if ($userRoleID !== false) {
    // Check if the user is not an admin or super admin
    if ($userRoleID != 2 && $userRoleID != 1) {
        // Redirect to the user page
        header("Location: ../view/home_view.php");
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
    <title>Loan Applicants - Asmaan MicroFinance</title>
    <link rel="stylesheet" href="#">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
	body{
	    font: Times New Roman;
	}
        table {
            width: 100%;
            margin-top: 20px;
            margin-left: auto; 
            margin-right: auto; 
        }

        th {
            padding: 5px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th:first-child {
            width: 19%; 
        }

        th:nth-child(2) {
            width: 19%;
        }

        th:nth-child(3) {
            width: 19%; 
        }

	th:nth-child(4) {
            width: 19%; 
        }

	th:nth-child(5) {
            width: 19%; 
        }	

        th:last-child {
            width: 5%; 
        }

    </style>
    
<div class="panel panel-default">
    <div class="container p-5 my-5 bg-dark text-white">
        <div class="row justify-content-between">
            <div class="col-auto">
                <a class="btn btn-success" href="admin_dashboard.php" style="color:White">Back</a>
            </div>
            <div class="col-auto">
                <a class="btn btn-info" href="approved_clients.php" style="color:blue-black">Clients</a>
            </div>
        </div>
    </div>
</div>
</head>


<body>
    <h1 style="font-family:Times New Roman, san-serif; font-size:30px; text-align:center; text-decoration: underline;">List of Loan Applicants</h1>
    <div class="container p-2 my-2 border">
    <table style="font-family:Times New Roman, san-serif;">
        <thead>
            
        </thead>
        <tbody>
	    <!-- Call the function to display all loan applicants -->
	    <?php display_all_names(); ?>
            
        </tbody>
    </table>
</div>

</body>

</html>


