<?php
include("../settings/myPageHeader.php");
include '../settings/connection.php';
include("../action/client_page_action.php");

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
    if ($userRoleID != 4) {
        $_SESSION['assign_error'] = "My_Page is only for users granted loan [clients]";
        // Redirect to login page for non-clients
        header("Location: ../view/home_view.php");
        die();
    }
} else {
    // Redirect to login page if user role is not available
    header("Location: ../login/login_view.php");
    die();
}


// Initialize client_info with default values
$client_info = [
    'name' => 'N/A',
    'email' => 'N/A',
    'principal_amount' => 'N/A',
    'interest_rate' => 'N/A',
    'loan_amount' => 'N/A',
    'date_granted_loan' => 'N/A',
    'due_date' => 'N/A',
    'repayment_method' => 'N/A',
    'outstanding_balance' => 'N/A',
    'transaction_date' => 'N/A',
    'transaction_method' => 'N/A',
    'amount_repaid' => 'N/A',
    'total_amount_repaid' => 'N/A'
];

// Fetch client details from the loan_application table
$user_id = $_SESSION['user_id'];
$sql = "SELECT fname, lname, email FROM loan_application WHERE la_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($fname, $lname, $email);
if ($stmt->fetch()) {
    $client_info['name'] = $fname . ' ' . $lname;
    $client_info['email'] = $email;
}
$stmt->close();

// Fetch loan details from the transaction_mgt table
$sql = "SELECT principal_amount, interest_rate, loan_amount, date_granted_loan, outstanding_balance, total_amount_repaid, amount_repaid, transaction_method, transaction_date FROM transaction_mgt WHERE client_name = ? AND email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $client_info['name'], $client_info['email']);
$stmt->execute();
$stmt->bind_result($principal_amount, $interest_rate, $loan_amount, $date_granted_loan, $outstanding_balance, $total_amount_repaid, $amount_repaid, $transaction_method, $transaction_date);
if ($stmt->fetch()) {
    $client_info['principal_amount'] = $principal_amount;
    $client_info['interest_rate'] = $interest_rate;
    $client_info['loan_amount'] = $loan_amount;
    $client_info['date_granted_loan'] = $date_granted_loan;
    $client_info['outstanding_balance'] = $outstanding_balance;
    $client_info['total_amount_repaid'] = $total_amount_repaid;
    $client_info['amount_repaid'] = $amount_repaid;
    $client_info['transaction_method'] = $transaction_method;
    $client_info['transaction_date'] = $transaction_date;
}
$stmt->close();

// Fetch suggested repayment method and due date from the clients table
$sql = "SELECT repayment_method, due_date FROM clients WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $client_info['email']);
$stmt->execute();
$stmt->bind_result($repayment_method, $due_date);
if ($stmt->fetch()) {
    $client_info['repayment_method'] = $repayment_method;
    $client_info['due_date'] = $due_date;
}
$stmt->close();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Dashboard - Asmaan MicroFinance</title>
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

        h2 {
            color: #555;
            margin-top: 20px;
        }

        div {
            background-color: #fff;
            margin: 20px;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f5f5f5;
        }

        strong {
            color: #007bff;
        }
    </style>
</head>
<body>
    <h1>Welcome, <b style="color:#0056b3"><?php echo $client_info['name'];?></b></h1>

    <!-- Client Information -->
    <div>
        <h2>My Information</h2>
        <p><strong>Name: </strong><?php echo $client_info['name'];?></p>
        <p><strong>Email: </strong><?php echo $client_info['email'];?></p>
        <p><strong>Outstanding Balance: </strong> GHS <?php echo $client_info['outstanding_balance'];?></p>
	<p><strong>Total Amount Repaid: </strong> GHS <?php echo $client_info['total_amount_repaid'];?></p>
    </div>

    <!-- Loans -->
    <div>
        <h2>My Loan</h2>
        <p><strong>Principal Amount: </strong>GHS <?php echo $client_info['principal_amount'];?></p>
        <p><strong>Interest Rate: </strong><?php echo $client_info['interest_rate'];?> %</p>
        <p><strong>Loan Amount: </strong>GHS <?php echo $client_info['loan_amount'];?></p>
        <p><strong>Loan Date: </strong><span style="color:green"><?php echo $client_info['date_granted_loan'];?></span></p>
	<p><strong>Due Date: </strong><span style="color:crimson"><?php echo $client_info['due_date'];?></span></p>
        <p><strong>Suggested Repayment method: </strong><span style="color:#00cc00"><?php echo $client_info['repayment_method'];?></span></p>

    </div>

    <div>
        <h2>Most Recent Transaction Log</h2>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Type</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><p><?php echo $client_info['transaction_date'];?></p></td>
                    <td><p><?php echo $client_info['transaction_method'];?></p></td>
                    <td><p>GHS <?php echo $client_info['amount_repaid'];?></p></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>


<?php
$conn->close();
?>
