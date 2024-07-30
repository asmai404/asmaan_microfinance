<?php
include ("../settings/editOutStandingHeader.php"); 
include ("../settings/core.php");
include '../settings/connection.php';
include '../action/get_an_outstanding_balance_action.php';

echo '<link rel="stylesheet" type="text/css" href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css">';

// Check user role
$userRoleID = getUserRoleID();
if ($userRoleID !== false) {
    if ($userRoleID != 1) {
        $_SESSION['assign_error'] = "Edit Oustanding Balance Page: Only super admin can access";
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
if (isset($_GET['t_id'])) {
    // Retrieve transaction ID from URL
    $t_id = $_GET['t_id'];

    // Call the function to get the client by ID
    $names = get_names_by_id($t_id);

    // Check if client is found
    if ($names) {
        // Display the form for editing the outstanding balance
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Edit Outstanding Status - Asmaan MicroFinance</title>
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
                <h2 style="color:#007bff">Edit Outstanding Balance</h2>
                <form action="../action/edit_outstanding_balance_action.php" method="POST">
                    <input type="hidden" name="t_id" value="<?php echo $names['t_id']; ?>">
                    <label for="amount_loaned_to">Outstanding Balance:</label>
                    <input type="text" id="amount_loaned_to" name="amount_loaned_to" value="<?php echo $names['outstanding_balance']; ?>" required title="Please enter a number" pattern="^\d+(\.\d{1,2})?$">
		    <br><br>
                    <button type="submit" name="submit">Update Outstanding-Balance</button>
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
        header("Location: transaction_management.php");
        exit();
    }
} else {
    echo "Error: transaction ID not provided.";
    exit();
}
?>
