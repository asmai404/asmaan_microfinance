<?php
include("../settings/bankHeader.php");
include '../settings/connection.php';
include '../settings/core.php';

function assign_error($error_message) {
    $_SESSION['assign_error'] = $error_message;
}

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    assign_error("Session expired or client not logged in.");
    header("Location: ../view/repayment.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank Transaction - Asmaan MicroFinance</title>
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Times New Roman, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-top: 20px;
        }

        #transaction-list {
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

        select, input[type="number"], input[type="text"], input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        button[type="submit"] {
            background-color: green;
            color: #fff;
            border: none;
            padding: 8px 20px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #00cc00;
	    color: black;
        }

        .container {
    	max-width: 100%;
    	padding: 0 20px;
	}

        footer {
    	background-color: #12619e;
    	color: #fff;
    	text-align: center;
    	padding: 20px 0;
	}

    </style>
</head>
<body>
    <h1><span style="color:#0056b3"><i class='bx bx-transfer'></span></i> Transaction Management</h1>

    <!-- Transaction List -->
    <div id="transaction-list">
        <!-- Transaction information will be displayed here -->
    </div>

    <!-- Add Transaction Form -->
    <h2>Bank Account</h2>
    <form id="add-transaction-form" action="../action/bank_action.php" method="post">
        <label for="transaction-type">Transaction Type:</label>
        <select id="type" name="type" required>
            <option value="repayment">Bank-Account</option>
        </select>
        <br><br>
        <label for="transaction-amount">Amount:</label>
        <input type="text" id="amount" name="amount" placeholder="Enter amount" pattern="^\d+(\.\d{1,2})?$" title="Please enter a valid amount (e.g., 100, 1000.00, 100.0)" required>
        <br><br>
        <label for="Pin">Pin:</label>
        <input type="text" id="pin" name="pin" placeholder="Enter pin" pattern="^\d{4}$" title="Please enter a 4-digit pin" style="display: inline-block; width: 12%; padding= 30px;" required>
        <button type="submit" style="font-family: Times New Roman, sans-serif;">SEND</button>
    </form>

<div>
    <footer>
        <div class="container">
            <p style="color:gold"><b> &copy; 2024 Asmaan Microfinance. All rights reserved </b></p>
        </div>
    </footer>
</div>

</body>
</html>
