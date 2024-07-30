<?php
include("../settings/outstandingBalanceHeader.php");
include ("../settings/connection.php");
include '../settings/core.php';

// Check user role
$userRoleID = getUserRoleID();
if ($userRoleID !== false) {
    if ($userRoleID != 1) {
        $_SESSION['assign_error'] = "Update Outstanding Balance Page: Only super admin can access";
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

// Check if t_id is provided in the URL
if(isset($_GET['t_id'])) {
    // Retrieve t_id from the URL query parameters
    $t_id = $_GET['t_id'];

    // Fetch transaction_mgt details from the database
    $query = "SELECT * FROM transaction_mgt WHERE t_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $t_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if assignment exists
    if($result->num_rows == 1) {
        $name = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Outstanding Balance - Asmaan MicroFinance</title>
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <style>
        html, body {
            height: 100%;
            margin: 0;
            font-family: "Times New Roman", serif;
            background-color: beige;   
            display: flex;
            flex-direction: column;
        }
        
        body {
            max-width: 100%;
        }

        main {
            flex: 1;
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

        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 20px;
        }
    </style>            
</head>
<body>
    <main>
        <br><br><br>
        <h1 style="color:gray;">Update Transaction Status</h1>
        <form action="../action/update_payment_verification_status_action.php" method="POST">
            <input type="hidden" name="t_id" value="<?php echo $name['t_id']; ?>">
            <label for="status" style="font-size:22px;">Update Status:</label>
            <select name="status" id="status" required style="display: inline-block; width: 10%; padding:15px;">
                <option value="2">Pending</option>
                <option value="3">Confirmed</option>
            </select>
            <button type="submit" name="updateStatusBtn">Update</button>
        </form>
    </main>
    <footer>
        <p style="color:gold">&copy; 2024 Asmaan Microfinance. All rights reserved.</p>
    </footer>
</body>
</html>


<?php
    } else {
        // Transaction details not found, display an error message
        echo "Transaction details not found.";
    }
} else {
    // t_id not provided in the URL, redirect back to the assignment view page
    header("Location: ../admin/transaction_mgt.php");
    exit();
}
?>
