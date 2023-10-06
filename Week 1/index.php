<?php

include('connect.php'); // Include the database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "<pre>";
    print_r($_POST);
    die();
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'login') {
            // Login handling
            $username = $_POST['username'];
            $password = $_POST['password'];

            $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // User found, redirect to dashboard or perform further actions
                header("Location: dashboard.html");
            } else {
                echo "Invalid username or password";
            }
        } elseif ($_POST['action'] == 'register') {
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login and Registration</title>
    <link rel="stylesheet" href="style.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="script.js"></script>
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
        <!-- Header content as before -->
    </header>

    <div class="wrapper">
        <span class="icon-close">
            <ion-icon name="close"></ion-icon>
        </span>

        <!--Login form creation-->


        <div class="form-box login">
            <h2>IntHub Login</h2>
            <form action="index.php" method="POST" id="loginForm">
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="mail"></ion-icon>
                    </span>
                    <input type="email" name="loginEmail" id="loginEmail" required>
                    <label>Email <span class="mandatory">*</span></label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="lock-closed"></ion-icon>
                    </span>
                    <input type="password" name="loginPassword" id="loginPassword" required>
                    <label>Password <span class="mandatory">*</span></label>
                </div>
                <div class="remember-forgot">
                    <label><input type="checkbox" required>
                        Remember me</label>
                    <a href="#">Forgot Password?</a>
                </div>
                <button type="submit" class="bth">Login</button>
                <div class="login-register">
                    <p>Don't have an account? <a href="#" class="register-link">Register</a></p>
                </div>
            </form>
        </div>


        <!--Register form creation-->

        <div class="form-box register">
            <h2>IntHub Registration</h2>
            <form action="register.php" method="post" id="registrationForm">
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="person"></ion-icon>
                    </span>
                    <input type="text" name="username" id="username" autocomplete="off" required>
                    <label>Username <span class="mandatory">*</span></label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="mail"></ion-icon>
                    </span>
                    <input type="email" name="email" id="email" required>
                    <label>Email <span class="mandatory">*</span></label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="lock-closed"></ion-icon>
                    </span>
                    <input type="password" name="password" id="password" required>
                    <label>Password <span class="mandatory">*</span></label>

                    <div class="tooltip">
                        <ion-icon class="info-icon" name="information-circle"></ion-icon>
                        <span class="tooltiptext">Password must have at least 8 characters, one uppercase letter, one lowercase letter.</span>
                    </div>
                </div>
                
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="lock-closed"></ion-icon>
                    </span>
                    <input type="password" name="confirmPassword" id="confirmPassword" required>
                    <label>Confirm Password <span class="mandatory">*</span></label>
                    <div class="tooltip">
                        <ion-icon class="info-icon" name="information-circle"></ion-icon>
                        <span class="tooltiptext">Password must have at least 8 characters, one uppercase letter, one lowercase letter.</span>
                    </div>
                </div>
                <div class="remember-forgot">
                    <label><input type="checkbox" name="terms" id="terms" required>
                        I agree to the terms & conditions</label>
                </div>
                <button type="submit" class="bth">Register</button>
                <div class="login-register">
                    <p>Already have an account? <a href="#" class="login-link">Login</a></p>
                </div>
            </form>
        </div>
    </div>



    <!--Form Validation for Registration-->


    <script>
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

            $('#registrationForm').submit(function (event) {
                event.preventDefault();

                var email = $('#email').val().trim();
                var password = $('#password').val().trim();
                var confirmPassword = $('#confirmPassword').val().trim();
                var termsChecked = $('#terms').is(':checked');
                var username = $('#username').val().trim();


                var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                var usernameRegex = /^[a-zA-Z0-9]+$/;


                if (email === '' || password === '' || confirmPassword === '' || username === '') {
                    alert('All fields are required');
                    return false;
                }

                if (!emailRegex.test(email)) {
                    alert('Please enter a valid email address');
                    return false;
                }

                if (password.length < 8) {
                    alert('Password should be at least 8 characters long');
                    return false;
                }

                // The regular expression checks if the password contains at least one uppercase letter, one lowercase letter, one number, and one special character
                var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

                if (!passwordRegex.test(password)) {
                    alert('Password should contain at least one uppercase letter, one lowercase letter, one number, and one special character');
                    return false;
                }

                if (confirmPassword !== password) {
                    alert('Passwords do not match');
                    return false;
                }

                if (!termsChecked) {
                    alert('Please accept the terms and conditions');
                    return false;
                }

                if (!usernameRegex.test(username)) {
                    alert('Username should contain only letters and numbers');
                    return false;
                }

                // If all validations pass, you can proceed with form submission
                // Here you can add code to submit the form to the server

                alert('Form submitted successfully!');
                return true;
            });

            // <!--Form Validation for login-->

            $('#loginForm').submit(function (event) {    
                event.preventDefault();

                var loginEmail = $('#loginEmail').val();
                var loginPassword = $('#loginPassword').val();

                // Validate email and password here
                var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;


                if (loginEmail === '' || loginPassword === '') {
                    alert('All fields are required');
                    return false;
                }

                if (!emailRegex.test(loginEmail)) {
                    alert('Please enter a valid email address');
                    return false;
                }

                if (loginPassword.length < 8) {
                    alert('Password should be at least 8 characters long');
                    return false;
                }

                // The regular expression checks if the password contains at least one uppercase letter, one lowercase letter, one number, and one special character
                var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

                if (!passwordRegex.test(loginPassword)) {
                    alert('Password should contain at least one uppercase letter, one lowercase letter, one number, and one special character');
                    return false;
                }

                alert('Form submitted successfully!'); // This is a placeholder alert
                return true;
            });
        });

    </script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>