<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login and Registration</title>
    <link rel="stylesheet" href="css/style.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/script.js"></script>
</head>


<body>
    <header>
        <h2 class="logo">IndusNet Technologies</h2>
        <nav class="navigation">
            <a href="#">Home</a>
            <a href="#">About</a>
            <a href="#">Services</a>
            <a href="#">Contact</a>
            <button class="bthLogin-popup">Login</button> <!-- click on the login button to show the login form -->
        </nav>
    </header>

    <div class="wrapper">
        <span class="icon-close">
            <ion-icon name="close"></ion-icon>
        </span>

        <!--Login form creation-->


        <div class="form-box login">
            <h2>IntHub Login</h2>
            <form action="submit.php" id="loginForm" method="POST" onsubmit="return validateLogin()">

                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="mail"></ion-icon>
                    </span>
                    <input id="loginEmail" name="loginEmail" type="email" autocomplete="off">
                    <label>Email <span class="mandatory">*</span></label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="lock-closed"></ion-icon>
                    </span>
                    <input id="loginPassword" name="loginPassword" type="password" autocomplete="off">
                    <label>Password <span class="mandatory">*</span></label>
                    <div class="tooltip">
                        <ion-icon class="info-icon" name="information-circle"></ion-icon>
                        <span class="tooltiptext">Password must have at least 8 characters, one uppercase letter, one
                            lowercase letter,one special character.</span>
                    </div>
                </div>
                <div class="remember-forgot">
                    <label><input type="checkbox">
                        Remember me</label>
                    <a href="#">Forgot Password?</a>
                </div>
                <button class="bth" type="submit">Login</button>
                <div class="login-register">
                    <p>Don't have an account? <a href="#" class="register-link">Register</a></p>
                </div>
            </form>
        </div>


        <!--Register form creation-->

        <div class="form-box register">
            <h2>IntHub Registration</h2>
            <form action="register.php" id="registrationForm" method="post" onsubmit="return validateForm()">
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="person"></ion-icon>
                    </span>
                    <input id="username" name="username" type="text" autocomplete="off">
                    <label>Username <span class="mandatory">*</span></label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="mail"></ion-icon>
                    </span>
                    <input id="email" name="email" type="email" autocomplete="off">
                    <label>Email <span class="mandatory">*</span></label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="lock-closed"></ion-icon>
                    </span>
                    <input id="password" name="password" type="password" autocomplete="off">
                    <label>Password <span class="mandatory">*</span></label>
                    <div class="tooltip">
                        <ion-icon class="info-icon" name="information-circle"></ion-icon>
                        <span class="tooltiptext">Password must have at least 8 characters, one uppercase letter, one
                            lowercase letter,one special character.</span>
                    </div>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="lock-closed"></ion-icon>
                    </span>
                    <input id="confirmPassword" name="confirmPassword" type="password" autocomplete="off">
                    <label>Confirm Password <span class="mandatory">*</span></label>
                    <div class="tooltip">
                        <ion-icon class="info-icon" name="information-circle"></ion-icon>
                        <span class="tooltiptext">Password must have at least 8 characters, one uppercase letter, one
                            lowercase letter,one special character.</span>
                    </div>
                </div>
                <div class="remember-forgot">
                    <label><input type="checkbox" name="terms" id="terms">
                        I agree to the terms & conditions</label>
                </div>
                <input type="hidden" name="action" value="register">
                <button class="bth" type="submit">Register</button>
                <div class="login-register">
                    <p>Already have an account? <a href="#" class="login-link">Login</a></p>
                </div>
            </form>
        </div>
    </div>



    <!--Form Validation for Registration page-->


    <script>

        function validateForm() {

            var username = $('#username').val().trim();
            var email = $('#email').val().trim();
            var password = $('#password').val().trim();
            var confirmPassword = $('#confirmPassword').val().trim();
            var termsChecked = $('#terms').is(':checked');

            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            var usernameRegex = /^[a-zA-Z0-9]+$/;
            var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

            if (username === '') {

                alert('Please provide user name');
                return false;

            }
            else if (!usernameRegex.test(username)) {
                alert('Username should contain only letters and numbers');
                return false;
            }
            else if (!emailRegex.test(email)) {
                alert('Please enter a valid email address');
                return false;
            }
            else if (password.length < 8) {
                alert('Password should be at least 8 characters long');
                return false;
            }
            else if (!passwordRegex.test(password)) {
                alert('Password should contain at least one uppercase letter, one lowercase letter, one number, and one special character');
                return false;
            }
            else if (confirmPassword !== password) {
                alert('Passwords do not match');
                return false;
            }
            else if (!termsChecked) {
                alert('Please accept the terms and conditions');
                return false;
            }
            else {
                return true;
            }

        }

            // <!--Form Validation for login-->

            function validateLogin() {

                var loginEmail = $('#loginEmail').val().trim();
                var loginPassword = $('#loginPassword').val().trim();
                var termsChecked = $('#terms').is(':checked');

                // Validate email and password here
                var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;


                if (loginEmail === '' ){
                    alert('All fields are required');
                    return false;

                }
                else if (!emailRegex.test(loginEmail)){
                    alert('Please enter a valid email address');
                    return false;
                }
                else if(loginPassword.length < 8) {
                    alert('Password should be at least 8 characters long');
                    return false;
                }
                else if (!passwordRegex.test(loginPassword)) {
                    alert('Password should contain at least one uppercase letter, one lowercase letter, one number, and one special character');
                    return false;
                }
            
            //     else if (!termsChecked) {
            //     alert('Please accept the terms and conditions');
            //     return false;
            // }
            else {
                return true;
            }
            }


            $(document).ready(function () {
            const wrapper = $('.wrapper');
            const loginLink = $('.login-link');
            const registerLink = $('.register-link');
            const bthPopup = $('.bthLogin-popup');
            const iconClose = $('.icon-close');

            registerLink.click(function () {
                wrapper.addClass('active');
            });

            loginLink.click(function () {
                wrapper.removeClass('active');
            });

            bthPopup.click(function () {
                wrapper.addClass('active-popup');
            });

            iconClose.click(function () {
                wrapper.removeClass('active-popup');
            });
            
        });



    </script>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>