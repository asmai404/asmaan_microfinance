<?php
session_start();

include '../settings/core.php';
include '../settings/connection.php';

function assign_error($error_message) {
    $_SESSION['assign_error'] = $error_message;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $amount = $_POST['amount'];
    $pin = $_POST['pin'];

    if (isset($_SESSION['email'])) {
        $userEmail = $_SESSION['email'];

        // Sanitize user input to prevent SQL injection attacks
        $userEmail = mysqli_real_escape_string($conn, $userEmail);

        // Retrieve user's balance and PIN from momo_account
        $query = "SELECT * FROM momo_account WHERE email = '$userEmail'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $currentBalance = $row['balance'];
            $fname = $row['fname'];
            $lname = $row['lname'];
            $pinStored = $row['pin']; 

            // Check if PIN matches
            if ($pin === $pinStored) {
                // Check if sufficient balance
                if ($currentBalance >= $amount) {
                    // Proceed with transaction
                    $newBalance = $currentBalance - $amount;

                    // Update momo_account table
                    $updateQuery = "UPDATE momo_account SET balance = $newBalance WHERE email = '$userEmail'";
                    mysqli_query($conn, $updateQuery);

                    // Insert or update transaction_mgt table
                    $checkTransactionSql = "SELECT amount_repaid, outstanding_balance, total_amount_repaid FROM transaction_mgt WHERE email = '$userEmail'";
                    $checkTransactionResult = mysqli_query($conn, $checkTransactionSql);

                    if (mysqli_num_rows($checkTransactionResult) > 0) {
                        $transactionRow = mysqli_fetch_assoc($checkTransactionResult);
                        $outstandingBalance = $transactionRow['outstanding_balance'];
                        $totalAmountRepaid = $transactionRow['total_amount_repaid'];

                        $newOutstandingBalance = $outstandingBalance - $amount;
                        $newTotalAmountRepaid = $totalAmountRepaid + $amount;

                        $updateTransactionQuery = "UPDATE transaction_mgt 
                                                   SET amount_repaid = $amount, 
                                                       outstanding_balance = $newOutstandingBalance, 
                                                       total_amount_repaid = $newTotalAmountRepaid,
                                                       transaction_date = NOW(), 
                                                       transaction_method = 'MOMO',
                                                       sid = 1 
                                                   WHERE email = '$userEmail'";
                        mysqli_query($conn, $updateTransactionQuery);
                    } else {
                        // Get the initial outstanding balance
                        $initialOutstandingBalanceQuery = "SELECT outstanding_balance FROM transaction_mgt WHERE email = '$userEmail'";
                        $initialOutstandingBalanceResult = mysqli_query($conn, $initialOutstandingBalanceQuery);
                        $initialOutstandingBalanceRow = mysqli_fetch_assoc($initialOutstandingBalanceResult);
                        $initialOutstandingBalance = $initialOutstandingBalanceRow['outstanding_balance'] - $amount;

                        $insertTransactionQuery = "INSERT INTO transaction_mgt (email, sid, amount_repaid, outstanding_balance, total_amount_repaid, transaction_date, transaction_method)
                                                   VALUES ('$userEmail', 1, $amount, $initialOutstandingBalance, $amount, NOW(), 'MOMO')";
                        mysqli_query($conn, $insertTransactionQuery);
                    }

                    // Redirect or display success message
                    header("Location: ../pop_up_messages/display_successful_transaction.php");
                    exit();
                } else {
                    assign_error("Insufficient balance in your MOMO account.");
                    header("Location: ../view/momo.php");
                    exit();
                }
            } else {
                // Display the error message including the wrong PIN entered
                assign_error("Please re-enter PIN. You entered a Wrong PIN: [" . htmlspecialchars($pin)."]");
                header("Location: ../view/momo.php");
                exit();
            }
        } else {
            assign_error("User not found.");
            header("Location: ../view/momo.php");
            exit();
        }
    } else {
        assign_error("Session expired or client not logged in.");
        header("Location: ../view/momo.php");
        exit();
    }
}
?>
