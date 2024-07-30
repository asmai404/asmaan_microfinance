<?php
include ("../settings/client_header.php"); 
include ("../settings/core.php");
include '../settings/connection.php';
include '../action/get_a_loanee_name_action.php';

echo '<link rel="stylesheet" type="text/css" href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css">';

// Check user role
$userRoleID = getUserRoleID();
if ($userRoleID !== false) {
    if ($userRoleID != 1) {
        $_SESSION['assign_error'] = "Client Loan Update Page: Only super admin can access";
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

// Check if client ID is provided in the URL
if (isset($_GET['c_id'])) {
    // Retrieve client ID from URL
    $c_id = $_GET['c_id'];

    // Call the function to get the client by ID
    $names = get_names_by_id($c_id);

    // Check if client is found
    if ($names) {
        // Display the form for editing the client
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Edit Amount Status - Asmaan MicroFinance</title>
            <link href="../css/bootstrap.min.css" rel="stylesheet">
            <style>
                body {
                    max-width: 100%;
                    font-family: Times New Roman, sans-serif;
                    background-color: beige;
                    display: flex;
                    flex-direction: column;
                    min-height: 100vh;
                }

                h1 {
                    color: blue;
                }

                form {
                    margin-bottom: 20px;
                }

                label {
                    display: block;
                    margin-bottom: 5px;
                }

                input[type="text"], input[type="date"], select {
                    width: 300px;
                    padding: 8px;
                    font-size: 16px;
                    border: 1px solid #ccc;
                    border-radius: 4px;
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

                .container {
                    flex: 1;
                }

                footer {
                    background-color: #333;
                    color: #fff;
                    text-align: center;
                    padding: 20px;
                }

                p {
                    color: cyan;
                }
            </style>
        </head>
        <body>
            <div class="container p-2 my-2 border">
                <h2 style="color:#007bff">Edit Loan Amount</h2>
                <form action="../action/edit_amount_action.php" method="POST">
                    <input type="hidden" name="c_id" value="<?php echo $names['c_id']; ?>">
                    <label for="amount_loaned_to">Principal Amount:</label>
                    <input type="text" id="amount_loaned_to" name="amount_loaned_to" value="<?php echo $names['amount_loaned_to']; ?>" required title="Please enter an amount between 100 and 10000, optionally ending with .0 or .00" pattern="^(10000(\.0{1,2})?|[1-9][0-9]{2,3}(\.0{1,2})?)$">
<br><br>
                    <button type="submit" name="submit">Update Principal_Amount</button>
                </form>
                <br><br>
                <h2 style="color:#007bff">Edit Repayment Method</h2>
                <form action="../action/edit_repayment_action.php" method="POST">
                    <input type="hidden" name="c_id" value="<?php echo $names['c_id']; ?>">
                    <label for="repayment_method">Repayment Method:</label>
                    <select id="repayment_method" name="repayment_method" required>
                        <option value=""></option>
                        <option value="MOMO" <?php echo $names['repayment_method'] == 'MOMO' ? 'selected' : ''; ?>>MOMO</option>
                        <option value="Bank-Account" <?php echo $names['repayment_method'] == 'Bank-Account' ? 'selected' : ''; ?>>Bank transfer</option>
                        <option value="In-person" <?php echo $names['repayment_method'] == 'In-person' ? 'selected' : ''; ?>>In person</option>
                    </select>
                    <button type="submit" name="submit">Update Repayment_Method</button>
                </form>
                <br><br>
                <h2 style="color:#007bff">Edit Due Date</h2>
                <form action="../action/edit_due_date_action.php" method="POST">
                    <input type="hidden" name="c_id" value="<?php echo $names['c_id']; ?>">
                    <label for="due_date">Due Date:</label>
                    <input type="date" id="due_date" name="due_date" value="<?php echo $names['due_date']; ?>" required style="display: inline-block; width: 10%; color:green;"><br><br>
                    <button type="submit" name="submit">Update Due_Date</button>
                </form>
            </div>
            <footer>
                <p style="color:gold">&copy; 2024 Asmaan Microfinance. All rights reserved.</p>
            </footer>
        </body>
        </html>
        <?php
    } else {
        // Client not found
        header("Location: loan_management.php");
        exit();
    }
} else {
    echo "Error: client ID not provided.";
    exit();
}
?>
