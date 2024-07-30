<?php
include("../settings/contactusHeaderBoth.php");?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact us - Asmaan MicroFinance</title>
    <link rel="stylesheet" href="../css/contactus.css">
    <style>
	body {
	    font-family: Times New Roman, san-serif;
	}
    </style>
</head>
<body>
    <section class="hero">
        <div class="container">
            <h2>Contact Us!</h2>
            <p style="text-align: center;">Get in touch with us for any inquiries or assistance.</p>

            <img src="../img/about.jpg" alt="Contact Image" style="width: 100%; max-height: 300px; max-width: 100%; object-fit: cover;">
        </div>
    </section>

    <section class="contact-info">
        <div style="text-align:center;" class="container">
            <h3>Contact Us</h3>
            <p>For customer support or assistance, please contact us using the information below:</p>
            <p>Email: info@microfinance.com</p>
            <p>Phone: +1 (123) 456-7890</p>    
        </div>
    </section>    
    <section class="social-icons">
        <div class="container">
            <a href="#" class="social-icon"><img src="../img/x.png" alt="Twitter"></a>
            <a href="#" class="social-icon"><img src="../img/instagram.png" alt="Instagram"></a>
            <a href="#" class="social-icon"><img src="../img/linkedIn.png" alt="LinkedIn"></a>       
        </div>
    </section>
    <section class="contact-form">
        <div class="container">
            <h3 style="text-align: center;">Contact Form</h3>
            <form id="contact-form" action="../action/contact_us_action_both.php" method="post" onsubmit="return validateForm()">
                <div class="form-group">
                    <label for="fname">First Name</label>
                    <input type="text" id="fname" name="fname" required>
                </div>
	        <div class="form-group">
                    <label for="lname">Last Name</label>
                    <input type="text" id="lname" name="lname" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="message">How can we help?</label>
                    <textarea id="message" name="message" required></textarea>
                </div>
                <button type="submit" name="submit">Send a message</button>
            </form>
        </div>
    </section>
    <section class="faqs">
        <div style="text-align: center;" class="container">
            <h3>Frequently Asked Questions</h3>
            <div class="faq">
                <h4>How do I apply for a loan?</h4>
                <p>To apply for a loan, you can fill out our online loan application form on our website.</p>
            </div>
            <div class="faq">
                <h4>What are the requirements for loan eligibility?</h4>
                <p>The requirements for loan eligibility vary depending on the type of loan and the lender's policies. Generally, you need to provide proof of income, identification, and other relevant documents.</p>
            </div>
            <div class="faq">
                <h4>How do I get a loan?</h4>
                <p>To get a loan, you need to submit a loan application form on our website.</p>
            </div>
        </div>
    </section>
    <footer>
        <div class="container">
            <p style="text-align: center;">&copy; 2024 Asmaan Microfinance. All rights reserved.</p>
        </div>
    </footer>
        <script>
        function validateForm() {
            const firstName = document.getElementById('fname').value;
            const lastName = document.getElementById('lname').value;
            const email = document.getElementById('email').value;
            const message = document.getElementById('message').value;

	    const nameRegex = /^[A-Z][a-zA-Z]*$/;
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
	    const messageRegex = /^[a-zA-Z][a-zA-Z0-9\s.,!@#%^&*()_+\-=\[\]{}|\\\/:;'"<>?~`]{0,499}$/;


            if (!nameRegex.test(firstName)) {
                alert('Please enter a valid First Name. Start with an Upper case.');
                return false;
            }

            if (!nameRegex.test(lastName)) {
                alert('Please enter a valid Last Name. Start with an Upper case.');
                return false;
            }

            if (!emailRegex.test(email)) {
                alert('Please enter a valid email address.');
                return false;
            }

	    if (!messageRegex.test(message)) {
                alert('Please complete your message appropriately. Start with an Upper case or a lower case. Do not use $');
                return false;
            }

            return true;
        }
    </script>
</body>
</html>
