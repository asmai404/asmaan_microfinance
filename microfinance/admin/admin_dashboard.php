<?php
// Include core.php
include '../settings/core.php';

include '../settings/connection.php';

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
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Admin Dashboard - Asmaan MicroFinance</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/dashboard.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
	body {
	    font-family: Times New Roman, san-serif;
	}
    </style>
  </head>
  <body>
    <nav class="navbar navbar-inverse navbar-fixed-top" style="background:#f5f5f5;border-bottom:1px solid #eee;">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="../view/home_view_admin.php" style="color:#0056b3; text-decoration: underline; font-size:20px;">Client Page<i class='bx bx-user-pin'></i></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="../login/logout_view.php" style="color:red; text-decoration: underline; font-size:21px;">Logout<i class='bx bx-exit'></i></a></li> 
          </ul>
        </div>
      </div>
    </nav>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
        <ul class="nav nav-sidebar">
	<br><br>		
        <li><a href="#"><img style="border-radius:20px" src="../img/adminicon.jpg" width="100" height="100" alt="admin image"/></a></li><br><br>
        <li><a href="client_management.php" style="color:black; text-decoration: none; font-size:20px;"><span style="color:gray"><i class='bx bx-group'></span></i> Client Management</a></li><br>
	<li><a href="loan_management.php" style="color:black; text-decoration: none; font-size:20px;"><span style="color:#00cc00"><i class='bx bx-money'></span></i> Loan Management</a></li><br>
	<li><a href="transaction_management.php" style="color:black; text-decoration: none; font-size:18px;"><span style="color:#0056b3"><i class='bx bx-transfer'></span></i> Transaction Management</a></li> <br>
	<li><a href="customer_messages.php" style="color:black; text-decoration: none; font-size:19px;"><span style="color:crimson"><i class='bx bx-envelope'></span></i> Messages|Reports</a></li>  
        </ul>     
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <?php include('dashboard.php'); ?>
        </div>
      </div>
    </div>
  </body>
</html>
