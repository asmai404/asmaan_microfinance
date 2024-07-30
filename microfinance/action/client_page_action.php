<?php
// Start session
session_start();

// Include the connection file
include '../settings/connection.php';

// Check if login button was clicked
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Collect form data and store in variables
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Write a query to SELECT a record from the loan_application table using the email
    $sql = "SELECT la_id, passwd, rid, fname, lname FROM loan_application WHERE email = ?";

    // Prepare the statement
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param("s", $email);

    // Execute the query
    $stmt->execute();

    // Store the result
    $stmt->store_result();

    // Check if any row was returned
    if ($stmt->num_rows == 1) {
        // Bind the result variables
        $stmt->bind_result($la_id, $hashed_password, $rid, $fname, $lname);

        // Fetch the record
        $stmt->fetch();

        // Verify password user provided against database record using password_verify
        if (password_verify($password, $hashed_password)) {
            // Password is correct, create session for user id, role id, and email
            $_SESSION['user_id'] = $la_id;
            $_SESSION['role_id'] = $rid;
            $_SESSION['email'] = $email;

            // Combine fname and lname to get full name
            $full_name = $fname . " " . $lname;

            // Check if the client already exists in the clients table
            $checkClientSql = "SELECT c_id, amount_loaned_to, interest_rate, date_granted_loan FROM clients WHERE client_name = ? AND email = ?";
            $checkClientStmt = $conn->prepare($checkClientSql);
            $checkClientStmt->bind_param("ss", $full_name, $email);
            $checkClientStmt->execute();
            $checkClientStmt->store_result();

            if ($checkClientStmt->num_rows == 1) {
                // Bind the result variables
                $checkClientStmt->bind_result($c_id, $amount_loaned_to, $interest_rate, $date_granted_loan);
                $checkClientStmt->fetch();

                // Calculate loan amount
                $interest_amount = ($amount_loaned_to * $interest_rate) / 100;
                $loan_amount = $amount_loaned_to + $interest_amount;

                // Check if the transaction already exists in the transaction_mgt table
                $checkTransactionSql = "SELECT t_id FROM transaction_mgt WHERE client_name = ? AND email = ?";
                $checkTransactionStmt = $conn->prepare($checkTransactionSql);
                $checkTransactionStmt->bind_param("ss", $full_name, $email);
                $checkTransactionStmt->execute();
                $checkTransactionStmt->store_result();

                if ($checkTransactionStmt->num_rows == 0) {
                    // Insert into transaction_mgt table
                    $insertTransactionSql = "INSERT INTO transaction_mgt (sid, client_name, email, principal_amount, interest_rate, date_granted_loan, loan_amount, outstanding_balance)
                                             VALUES (1, ?, ?, ?, ?, ?, ?, ?)";
                    $insertTransactionStmt = $conn->prepare($insertTransactionSql);
                    $insertTransactionStmt->bind_param("ssidsdd", $full_name, $email, $amount_loaned_to, $interest_rate, $date_granted_loan, $loan_amount, $loan_amount);
                    $insertTransactionStmt->execute();
                }

                // Close transaction statement
                $checkTransactionStmt->close();
            }

            // Close client statement
            $checkClientStmt->close();

            // Redirect based on role ID
            if ($rid == 4) {
                // Redirect to client page
                header("Location: ../view/my_page.php");
            } elseif ($rid == 3) {
                // Redirect to pending loan application page with a pop-up message
                header("Location: ../pop_up_messages/display_pending_loan_application.php");
            } elseif ($rid == 1 || $rid == 2) {
                // Redirect admins to home view
                header("Location: ../view/home_view.php");
            }
            exit();
        } else {
            // Incorrect password
            header("Location: ../pop_up_messages/incorrect_client_login_password.php");
            exit();
        }
    } else {
        // No record found, the loan application failed
        header("Location: ../pop_up_messages/display_failed_loan_application.php");
        exit();
    }

    // Close statement
    $stmt->close();

    // Close connection
    $conn->close();
}
?>
