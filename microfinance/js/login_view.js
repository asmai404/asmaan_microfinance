        function validateLogin() {
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            const passwordRegex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[^\s]{8,}$/;
        
            if (!emailRegex.test(email)) {
                alert('Please enter a valid email address');
                return false;
            }
        
            if (!passwordRegex.test(password)) {
                alert('Please enter a valid password. Password must contain at least 8 characters');
                return false;
            }
            return true;
        }