<?php
include("../settings/header.php");
include ("../settings/core.php");
include ("../settings/connection.php");
include ("../functions/client_fxn.php");

// Check user role
$userRoleID = getUserRoleID();
if ($userRoleID !== false) {
    if ($userRoleID != 1) {
        $_SESSION['assign_error'] = "Loan Management: Only super admin can access";
        header("Location: admin_dashboard.php");
        die();
    }
} else {
    header("Location: ../login/login_view.php");
    die();
}

function assign_error($error_message) {
    $_SESSION['assign_error'] = $error_message;
}

$flag = 0;
if(isset($_POST['submit'])) {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $loan_amount = $_POST['loan-amount'] ?? '';
    $loan_interest_rate = $_POST['loan-interest-rate'] ?? '';
    $repayment_method = $_POST['repayment-method'] ?? '';
    $loan_dateAssigned = date('Y-m-d');
    $loan_dd = $_POST['loan-dd'] ?? '';

    if(empty($name) || empty($loan_amount) || empty($loan_interest_rate) || empty($repayment_method) || empty($loan_dd)) {
        assign_error("Please fill out all fields.");
        header("Location: loan_management.php");
        exit();
    }

    $currentDate = date('Y-m-d');
    if ($loan_dd <= $currentDate) {
        $_SESSION['assign_error'] = "Due date must be in the future.";
        header("Location: loan_management.php?error=prepare");
        exit();
    }

    $full_name = get_full_name_from_la_id($name);
    $email = get_email_from_la_id($email);

    if($full_name ) {
	// Check if the client name already exists in the loan_application table
        $check_name_query = "SELECT * FROM clients WHERE client_name = ? AND email = ?";
        $check_name_stmt = $conn->prepare($check_name_query);
        $check_name_stmt->bind_param("ss", $full_name, $email);
        $check_name_stmt->execute();
        $check_name_stmt->store_result();
        $count_name = $check_name_stmt->num_rows;
        $check_name_stmt->close();

        if($count_name > 0) {
            assign_error("This client has already been granted a loan");
            header("Location: loan_management.php");
            exit();
        }

        // Update loan_application table when a loan applicant becomes a client
        $update_loan_application_query = "UPDATE loan_application SET rid = 4 WHERE CONCAT(fname, ' ', lname) = ?";
        $update_stmt = $conn->prepare($update_loan_application_query);
        $update_stmt->bind_param("s", $full_name);
        $update_result = $update_stmt->execute();
        $update_stmt->close();

        if ($update_result) {
            // Insert into clients table
            $insert_clients_query = "INSERT INTO clients (rid, client_name, email, amount_loaned_to, interest_rate, repayment_method, date_granted_loan, due_date) VALUES (4, ?, ?, ?, ?, ?, ?, ?)";
            $insert_stmt = $conn->prepare($insert_clients_query);
            $insert_stmt->bind_param("ssidsss", $full_name, $email, $loan_amount, $loan_interest_rate, $repayment_method, $loan_dateAssigned, $loan_dd);
            $insert_result = $insert_stmt->execute();
            $insert_stmt->close();

            if($insert_result) {
		$_SESSION['client_name'] = $full_name;
                $flag = 1;
            } else {
                assign_error("Error inserting data into the database");
                header("Location: loan_management.php");
                exit();
            }
        } else {
            assign_error("Error updating loan application");
            header("Location: loan_management.php");
            exit();
        }
    } else {
        assign_error("Error fetching full name from database");
        header("Location: loan_management.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Management - Asmaan MicroFinance</title>
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
            width: 16%; 
        }

        th:nth-child(2) {
            width: 16%; 
        }

        th:nth-child(3) {
            width: 14%;
        }

        th:nth-child(4) {
            width: 18%; 
        }

	th:nth-child(5) {
            width: 14.5%; 
        }

        th:nth-child(6) {
            width: 14.5%; 
        }

        th:last-child {
            width: 7%; 
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
	     <?php if($flag && isset($_SESSION['client_name'])) { ?>
                <div class="alert alert-success">
                    <strong>Success!  </strong> <?php echo $_SESSION['client_name']; ?> successfully added to loan scheme.
                </div>
                <?php unset($_SESSION['client_name']); ?>
            <?php } ?>
            <div class="row justify-content-between">
                <div class="col-auto">
                    <a class="btn btn-success" href="admin_dashboard.php" style="color:White">Back</a>
                </div>
                <div class="col-auto">
                    <a class="btn btn-info" href="transaction_management.php" style="color:blue-black">Transaction Management</a>
                </div>
            </div>
        </div>
    </div>

    <h1>Loan Management</h1>
    <div id="loan-list">
    </div>
    <h2 style="text-align:center; font-weight: bold;">Add Clients To Loan Scheme</h2>
        <form id="add-loan-form" action="loan_management.php" method="POST">
        <label for="loan-client">Name:</label>
        <select name="name" id="name" required style="display: inline-block; width: 100%;">
            <?php
                $standardUsers = get_standard_users(); 
                if(!empty($standardUsers)) {
                    foreach($standardUsers as $user) {
                        echo "<option value='".$user['la_id']."'>".$user['fname']." ".$user['lname']."  [".$user['email']."]". "</option>";
                    }
                }
            ?>
        </select> 

	<label for="loan-email">Email:</label>
	<select name="email" id="email" required style="display: inline-block; width: 100%;">
            <?php
                $standardUsers = get_standard_users(); 
                if(!empty($standardUsers)) {
                    foreach($standardUsers as $user) {
                        echo "<option value='".$user['la_id']."'>".$user['email']."</option>";
                    }
                }
            ?>
        </select>

        <label for="loan-amount">Amount:</label>
        <input type="number" id="loan-amount" name="loan-amount" required min="100" max="10000" title="Please enter a valid amount between 100 and 10000 GHS.">

	<label for="loan-interest-rate">Interest Rate:</label>
	<input style="width:100%; padding:10px;" type="text" id="loan-interest-rate" name="loan-interest-rate" pattern="^(10(\.0{1,2})?|^[1-4]\d(\.\d{1,2})?|^50(\.0{1,2})?)$" title="Please enter a valid interest rate between 10 and 50 (optionally in 1 or 2 decimal places)" required min="10" max="50">
	
        <div class="repayment-method-box" required>
            <label for="repayment-method"><b>Repayment Method:</b></label>
            <div>
                <input type="radio" name="repayment-method" id="MOMO" value="MOMO"> MOMO
            </div>
            <div>
                <input type="radio" name="repayment-method" id="Bank-Account" value="Bank-Account"> Bank-Account
            </div>
            <div>
                <input type="radio" name="repayment-method" id="In-person" value="In-person"> In person
            </div>
        </div>

        <br>
        <label for="loan-dd">Due Date:</label>
        <input type="date" id="loan-dd" name="loan-dd" style="color:green" required>

        <br><br>
        <button type="submit" name="submit" value="Submit" class="btn btn-primary">Add Client</button>
    </form>
    <br><br>
    <h1 style="font-family:Times New Roman, san-serif; font-size:30px; text-align:center; text-decoration: underline;">List of Clients Granted Loan</h1>
    <div class="container p-2 my-2 border">
    <table style="font-family:Times New Roman, san-serif;">
        <thead>

        </thead>
        <tbody>
	    <!-- Call the function to display all clients -->
	    <?php display_all_clients(); ?>
        </tbody>
    </table>
    </div>
</body>
</html>