<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>microFinance/loginPage</title>
    <link rel="stylesheet" href="../css/login_view.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
	body {
	    font-family: Times New Roman, sans-serif;
	}
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form id="login-form" action="../action/login_user_action.php" method="post">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" placeholder="Email" id="email" name="email" required>
		<span class="fas fa-user"></span>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" placeholder="Password" id="password" name="password" required>
                <span class="fas fa-lock"></span>
            </div>
            <p style="text-align: center; font-family: Times New Roman, sans-serif;"><button type="submit" name="login" id="btn" onclick="return validateLogin()">Login</button></p>
        </form>
        <p class="register-link">Don't have an account? <a href="register_view.php">Register</a> | <a href="../index.php" style="color:green; text-decoration: underline; font-size:18px;">Back <i class='bx bx-log-out'></i></a></p>
    </div>

    <script src="../js/login_view.js"></script>
</body>
</html>
