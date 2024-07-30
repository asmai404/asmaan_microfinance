<?php
include("../settings/header.php");
include '../settings/core.php';
include '../settings/connection.php';
include '../functions/cm_all_transaction_fxn.php';

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
    <title>Transaction Management - Asmaan MicroFinance</title>
    <style>
        body {
            font-family: Times New Roman, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-top: 20px;
        }

        #loan-list {
            margin: 20px;
            padding: 15px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #555;
            margin-top: 20px;
        }

        form {
            margin: 20px;
            padding: 15px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        select, input[type="number"], input[type="date"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 8px 20px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
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
            width: 15%; 
        }

        th:nth-child(2) {
            width: 15%; 
        }

        th:nth-child(3) {
            width: 12%;
        }

        th:nth-child(4) {
            width: 12%; 
        }

	th:nth-child(5) {
            width: 12%; 
        }

        th:nth-child(6) {
            width: 12%; 
        }

        th:last-child(7) {
            width: 12%; 
        }

	th:last-child {
            width: 10%; 
        }

        .full-screen-container {
            width: 100vw; 
            height: 10vh; 
            padding: 5rem; 
            margin: 0; 
            box-sizing: border-box; 
        }

        .repayment-method-box {
            border: 1px solid #ccc;
            padding: 15px;
            margin-top: 20px;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .repayment-method-box label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .repayment-method-box div {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="panel panel-default">
        <div class="full-screen-container bg-dark text-white">
            <div class="row justify-content-between">
                <div class="col-auto">
                    <a class="btn btn-success" href="admin_dashboard.php" style="color:White">Back</a>
                </div>
                <div class="col-auto">
                    <a class="btn btn-info" href="approved_clients.php" style="color:blue-black">Clients||Transactions</a>
                </div>
            </div>
        </div>
    </div>

    <h1>Transaction Management</h1>
    <div id="loan-list">
    </div>
    <h2 style="text-align:center; font-weight: bold; font-family:Times New Roman, san-serif; text-decoration: underline;">All Transactions</h2>
    <div class="container p-2 my-2 border">
    <table style="font-family:Times New Roman, san-serif;">
        <thead>

        </thead>
        <tbody>
	    <!-- Call the function to display all transactions -->
	    <?php display_all_transactions(); ?>
        </tbody>
    </table>
    </div>
</body>
</html>


