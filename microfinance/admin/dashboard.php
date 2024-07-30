<?php

include '../settings/connection.php';
include '../functions/dashboard_fxn.php';

// Initialize admin_info with default values
$admin_info = ['name' => 'N/A'];

// Fetch client details from the loan_application table
$user_id = $_SESSION['user_id'];
$sql = "SELECT fname, lname FROM people WHERE pid = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($fname, $lname);
if ($stmt->fetch()) {
    $admin_info['name'] = $fname . ' ' . $lname;
}
$stmt->close();

?>

<div><h1 style="text-align:center; font-weight: bold; font-size:30px;">@dmin: <b style="color:#0056b3"><?php echo $admin_info['name'];?></b></h1></div>
<h1 class="page-header"></h1><br>

<div class="row placeholders">
  <div class="col-xs-6 col-sm-3 placeholder">
    <img src="../img/groupficn.png" width="150" height="150" class="img-responsive"
      alt="Generic placeholder thumbnail">
    <p style="font-weight:bold; font-family: Goudy Old Style; font-size:19px;">Loan Applicants:<strong style="color:#0056b3; font-weight:bold;"> <?php display_loan_applicants(); ?></strong></p>
  </div>

  <div class="col-xs-6 col-sm-3 placeholder">
    <img src="../img/womenficn.png" width="150" height="150" class="img-responsive"
      alt="Generic placeholder thumbnail">
    <p style="font-weight:bold; font-family: Goudy Old Style; font-size:20px;">Female Clients:<strong style="color:#0056b3; font-weight:bold;"> <?php display_female_clients(); ?></strong></p>
  </div>

    <div class="col-xs-6 col-sm-3 placeholder">
    <img src="../img/menficn.png" width="150" height="150" class="img-responsive"
      alt="Generic placeholder thumbnail">
    <p style="font-weight:bold; font-family: Goudy Old Style; font-size:20px;">Male Clients:<strong style="color:#0056b3; font-weight:bold;"> <?php display_male_clients(); ?></strong></p>
  </div>

</div>
<br><br>
<div class="row placeholders">
    <div class="col-xs-6 col-sm-3 placeholder">
    <img src="../img/memberficn.png" width="150" height="150" class="img-responsive"
      alt="Generic placeholder thumbnail">
    <p style="font-weight:bold; font-family: Goudy Old Style; font-size:20px;">All Clients:<strong style="color:#0056b3; font-weight:bold;"> <?php display_clients(); ?></strong></p>
  </div>

  <div class="col-xs-6 col-sm-3 placeholder">
    <img src="../img/paidficn.png" width="150" height="150" class="img-round" alt="Generic placeholder thumbnail"><br><br>
    <p style="font-weight:bold; font-family: Goudy Old Style; font-size:20px;">Transactions:<strong style="color:#0056b3; font-weight:bold;"> <?php display_transactions(); ?></strong></p>
  </div>

  <div class="col-xs-6 col-sm-3 placeholder">
    <img src="../img/mean.jpg" width="150" height="150" class="img-round" alt="Generic placeholder thumbnail"><br><br>
    <p style="font-weight:bold; font-family: Goudy Old Style; font-size:20px;">Average:<strong style="color:#0056b3; font-weight:bold;"> <?php display_mean(); ?></strong></p>
  </div>



</div>

</div>

<?php
$conn->close();
?>
