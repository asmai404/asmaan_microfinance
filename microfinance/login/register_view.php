<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>microFinance/registerPage</title>
    <link rel="stylesheet" href="../css/register_view.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <style>
	body {
	    font-family: Times New Roman, sans-serif;
	}
    </style>
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <form id="register-form" action="../action/register_user_action.php" method="post">
            <div class="form-group">
                <label for="fname">First name</label>
                <input type="text" id="fname" name="fname" required>
            </div>
            <div class="form-group">
                <label for="lname">Last name</label>
                <input type="text" id="lname" name="lname" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="telephone">Phone</label>
                <input type="text" id="phone" name="phone" required>
            </div>
	    <div>
	    <label for="gender"><b>Date of Birth</b></label>
	    <input type="date" name="dob" id="dob" required>
	    <br><br>
	    <div class="row" required>
		<label for="gender"><b>Gender:</b></label>
                <div class="gender-radio">
                    <input type="radio" name="gender" id="male" value="male"> Male
		</div>
                <div class="gender-radio">
                    <input type="radio" name="gender" id="female" value="female"> Female
		</div> 
            </div>
	    </div> 
	    <br>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirm-password">Confirm Password</label>
                <input type="password" id="confirm-password" name="confirm-password" required>
            </div>
            <p style="text-align: center; font-family: Times New Roman, sans-serif;"><button type="submit" name="submit" id="btn" onclick="return validateRegistration()">Register</button></p>
        </form>
	<p class="register-link">Already have an account? <a href="login_view.php">Login</a> | <a href="../index.php" style="color:green; text-decoration: underline; font-size:18px;">Back <i class='bx bx-log-out'></i></a></p>

    </div>

    <script>
            function validateRegistration() {
            const firstName = document.getElementById('fname').value;
            const lastName = document.getElementById('lname').value;
            const email = document.getElementById('email').value;
            const phone = document.getElementById('phone').value;
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm-password').value;
            const genderMale = document.getElementById('male').checked;
            const genderFemale = document.getElementById('female').checked;
            const dob = document.getElementById('dob').value;

            
            const nameRegex1 = /^[A-Z][a-zA-Z]*$/;
	    const nameRegex2 = /^[A-Z][a-zA-Z]*$/;
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            const phoneRegex = /^\d{10}$/;
            const passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[^\s]{8,}$/;
            const dobRegex = /^(19|20)\d{2}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01])$/;
            

            if (!nameRegex1.test(firstName)) {
                alert('Please enter a valid First Name. Start with an Upper case');
                return false;
            }

	    if (!nameRegex2.test(lastName)) {
                alert('Please enter a valid Last Name. Start with an Uspper case');
                return false;
            }

            if (!emailRegex.test(email)) {
                alert('Please enter a valid email address');
                return false;
            }

            if (!phoneRegex.test(phone)) {
                alert('Please enter a valid 10-digit phone number');
                return false;
            }

            if (!passwordRegex.test(password)) {
                alert('Please enter a valid password. Hint: The password must contain at least 8 characters, including at least one uppercase letter, one lowercase letter, one number and one symbol or punctuation mark.');
                return false;
            }

            if (password !== confirmPassword) {
                alert('Passwords do not match');
                return false;
            }

            if (!genderMale && !genderFemale) { 
                alert('Please select your Gender');
                return false;
            }

            if (!dobRegex.test(dob)) {
                alert('Please enter a valid date of birth');
                return false;
            }

            const dobDate = new Date(dob);
            const currentDate = new Date();
            if (dobDate >= currentDate) {
                alert('Date of birth should be in the past');
                return false;
            }

            return true;
        }
    </script>
</body>
</html>
