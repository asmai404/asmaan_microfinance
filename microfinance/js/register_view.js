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

            const nameRegex = /^[a-zA-Z\s]*$/;
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            const phoneRegex = /^\d{10}$/;
            const passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[^\s]{8,}$/;
            const dobRegex = /^(19|20)\d{2}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01])$/;

            if (!nameRegex.test(firstName) || !nameRegex.test(lastName)) {
                alert('Please enter a valid name');
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
                alert('Please enter a valid password. Hint: The password must contain at least 8 characters, including at least one uppercase letter, one lowercase letter one number and one symbol or punctuation mark.');
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