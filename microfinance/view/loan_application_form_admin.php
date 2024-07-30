<?php
include("../settings/header.php"); 

// Include core.php
include '../settings/core.php';

include '../settings/connection.php';

function assign_error($error_message) {
    $_SESSION['assign_error'] = $error_message;
}

// Check if there is an error message set in the session
if(isset($_SESSION['assign_error'])) {
    // Display the error message
    echo "<h2 style='color: red; text-align: center; font-family: Times New Roman,san-serif; font-size:18px;'>".$_SESSION['assign_error']."</h2>";

    // Unset the session variable to clear the message
    unset($_SESSION['assign_error']);
}

// Check user role
$userRoleID = getUserRoleID();
if ($userRoleID !== false) {
    // Check if the user is not a Standard user
    if ($userRoleID != 3) {
	$_SESSION['assign_error'] = "Only standard users can apply for loan";
        // Redirect to main dashboard|user homepage for non-admin users
        header("Location: home_view_admin.php");
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
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Loan Application Form - Asmaan MicroFinance</title>
    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/metisMenu.min.css" rel="stylesheet">
    <link href="../css/sb-admin-2.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Times New Roman, sans-serif;;
        }

        .row {
            display: flex;
            align-items: center;
        }
        
        .row .gender-radio {
            width: 50%;
        }

        .row .gender-radio {
            padding: 5px;
        }

        .row .gender-radio {
            margin-right: 10px; 
        }

        .row > * {
            margin-right: 10px; 
        }

        .row {
            display: flex;
            align-items: center;
        }

        .gender-radio {
            margin-right: 10px; 
            display: inline-block;
            vertical-align: middle;
        }

        .gender-radio input[type="radio"] {
            margin-right: 5px; 
        }
    </style>
</head>
<body style="background:#CCCCCC">
    <div class="container" >
        <div class="row" style="margin-top:20px">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please fill the form to apply for loan</h3>
                    </div>
                    <div class="panel-body">
                        <form action="../action/loan_application_form_action.php" method="post" onsubmit="return validateForm()">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" type="text" id="fname" name="fname" placeholder="First name" required>
                                </div>

                                <div class="form-group">
                                    <input class="form-control" type="text" id="lname" name="lname" placeholder="Last name" required>
                                </div>

                                <div class="form-group">
                                    <input class="form-control" name="email" type="email" id="email" placeholder="E-mail" required>
                                </div>

                                <div class="form-group">
                                    <input class="form-control" type="text" id="phone" name="phone" placeholder="Phone" required>
                                </div>

                                <div class="form-group">
                                    <input class="form-control" type="text" id="stadd" name="stadd" placeholder="Street Address" required>
                                </div>

                                <div class="form-group">
                                    <input class="form-control" type="text" id="amount" name="amount" placeholder="Amount (GHS)" required>
                                </div>

                                <div class="form-group">
                                    <input class="form-control" type="text" id="pur" name="pur" placeholder="Purpose" required>
                                </div>                

                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="pass" id="pass" type="password" required>
                                </div> 

                                <div class="form-group">
                                    <input class="form-control" type="password" id="repass" name="repass" placeholder="Confirm Password" required>
                                </div>
                        
                                <div class="form-group">
                                    <label for="gender" class="form-label">Gender:</label>
                                    <div class="form-control">
                                        <input class="form-check-input" type="radio" name="gender" id="male" value="male" required>
                                        <label class="form-check-label" for="male"> Male </label>
                                    </div>
                                    <div class="form-control">
                                        <input class="form-check-input" type="radio" name="gender" id="female" value="female" required>
                                        <label class="form-check-label" for="female"> Female </label>
                                    </div> 
                                </div>
            
                                <div class="form-group">
                                    <p style="text-align: center; font-family: Times New Roman, sans-serif;">
                                        <button class="btn btn-md btn-success btn-block" type="submit" name="submit" id="btn">Apply for Loan</button>
                                    </p>
                                </div>
                            </fieldset>
                        </form>
                        <p class="form-group" style="text-align: center; color:red; text-decoration: underline; font-size:18px;">
                            <a href="home_view_admin.php">Back <i class='bx bx-log-out'></i></a>
                        </p>            
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function validateForm() {
            const firstName = document.getElementById('fname').value;
            const lastName = document.getElementById('lname').value;
            const email = document.getElementById('email').value;
            const phone = document.getElementById('phone').value;
            const stadd = document.getElementById('stadd').value;
            const pur = document.getElementById('pur').value;
            const amount = document.getElementById('amount').value;
            const pass = document.getElementById('pass').value;
            const repass = document.getElementById('repass').value;
            const genderMale = document.getElementById('male').checked;
            const genderFemale = document.getElementById('female').checked;

            const nameRegex = /^[A-Z][a-zA-Z]*$/;
	    const addressRegex = /^[A-Z][a-zA-Z0-9\s,'.-]*$/;
	    const purposeRegex = /^[a-zA-Z][a-zA-Z0-9\s.,!@#%^&*()_+\-=\[\]{}<>?:;|\\\/~`'""]*$/;
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            const phoneRegex = /^\d{10}$/;
	    const amountRegex = /^(100|[1-9]\d{2}|[1-9]\d{3}|10000)$/;
            const passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[^\s]{8,}$/;

            if (!nameRegex.test(firstName)) {
                alert('Please enter a valid First Name. Start with an Upper case.');
                return false;
            }

            if (!nameRegex.test(lastName)) {
                alert('Please enter a valid Last Name. Start with an Upper case.');
                return false;
            }

            if (!addressRegex.test(stadd)) {
                alert('Please enter a valid Street Address. Start with an Upper case.');
                return false;
            }

            if (!purposeRegex.test(pur)) {
                alert('Please complete your purpose.');
                return false;
            }

            if (!emailRegex.test(email)) {
                alert('Please enter a valid email address.');
                return false;
            }

            if (!phoneRegex.test(phone)) {
                alert('Please enter a valid 10-digit phone number.');
                return false;
            }

            if (!amountRegex.test(amount)) {
                alert('Please enter a valid amount between 100 and 10000 GHS.');
                return false;
            }

            if (!passwordRegex.test(pass)) {
                alert('Please enter a valid password. The password must contain at least 8 characters, including at least one uppercase letter, one lowercase letter, one number, and one symbol or punctuation mark.');
                return false;
            }

            if (pass !== repass) {
                alert('Passwords do not match.');
                return false;
            }

            if (!genderMale && !genderFemale) { 
                alert('Please select your Gender');
                return false;
            }
            return true;
        }
    </script>
</body>
</html>
