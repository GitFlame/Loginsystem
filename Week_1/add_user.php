<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['username'];
    $lastName = $_POST['lastname'];
    $email = $_POST['email'];
    $password =md5($_POST['password']); // Use md5 for secure password

    $sql = "INSERT INTO `details` (`username`, `lastname`, `email_id`, `password`) 
            VALUES ('$firstName','$lastName', '$email','$password')";

    if (mysqli_query($conn, $sql)) {
        header("Location: display.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    // echo "Invalid request.";
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/update_style.css">


    <title>Add User Details</title>

    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            /* background-color: #1BECE2; */
        }

        .container {
            flex-grow: 1;
        }

        footer {
            text-align: center;
        }
    </style>

</head>

</head>


<body>
    <div class="form-box register">
        <h2>Add Your User Details!</h2>
        <form action="add_user.php" method="post" onsubmit="return validateForm()">
            <div class="input-box">
                <span class="icon">
                    <ion-icon name="person"></ion-icon>
                </span>
                <input id="username" name="username" type="text" autocomplete="off"  >
                <label>First Name <span class="mandatory">*</span></label>
            </div>
            <div class="input-box">
                <span class="icon">
                    <ion-icon name="person"></ion-icon>
                </span>
                <input id="lastname" name="lastname" type="text" autocomplete="off"  >
                <label>Last Name <span class="mandatory">*</span></label>
            </div>
            <div class="input-box">
                <span class="icon">
                    <ion-icon name="mail"></ion-icon>
                </span>
                <input id="email" name="email" type="email" autocomplete="off" >
                <label>Email <span class="mandatory">*</span></label>
            </div>
            <div class="input-box">
                <span class="icon">
                    <ion-icon name="eye" id="togglePassword"></ion-icon>
                </span>
                <input id="password" name="password" type="password" autocomplete="off" >
                <label>Password <span class="mandatory">*</span></label>
                <div class="tooltip">
                    <ion-icon class="info-icon" name="information-circle"></ion-icon>
                    <span class="tooltiptext">Password must have at least 8 characters, one uppercase letter, one
                        lowercase letter,one special character.</span>
                </div>
            </div>
            <div class="input-box">
                <span class="icon">
                    <ion-icon name="eye" id="toggleConfirmPassword"></ion-icon>
                </span>
                <input id="confirmPassword" name="confirmPassword" type="password" autocomplete="off" >
                <label>Confirm Password <span class="mandatory">*</span></label>
                <div class="tooltip">
                    <ion-icon class="info-icon" name="information-circle"></ion-icon>
                    <span class="tooltiptext">Password must have at least 8 characters, one uppercase letter, one
                        lowercase letter,one special character.</span>
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
    </div>
    </div>
    </form>
    </div>
<script>
function validateForm() {

var username = $('username').val().trim();
var lastname = $('lastname').val().trim();
var email = $('email').val().trim();
var password = $('password').val().trim();
var confirmPassword = $('confirmPassword').val().trim();
var termsChecked = $('terms').is(':checked');

var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
var usernameRegex = /^[a-zA-Z0-9]+$/;
var lastnameRegex = /^[a-zA-Z0-9]+$/;
var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

if (username === '' && lastname==='') {

    alert('Please provide full  name');
    return false;

}
else if (!usernameRegex.test(username)) {
    alert('Username should contain only letters and numbers');
    return false;
}
else if (!lastnameRegex.test(lastname)) {
    alert('lastname should contain only letters and numbers');
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


</script>



<script>
    document.getElementById('togglePassword').addEventListener('click', function () {
    var passwordField = document.getElementById('password');
    var icon = document.getElementById('togglePassword');

    if (passwordField.type === 'password') {
        passwordField.type = 'text';  // Change to text to show the password
        icon.setAttribute('name', 'eye-off'); // Change to eye-off icon when showing password
    } else {
        passwordField.type = 'password';
        icon.setAttribute('name', 'eye'); // Change back to eye icon when hiding password
    }
});

document.getElementById('toggleConfirmPassword').addEventListener('click', function () {
    var confirmPasswordField = document.getElementById('confirmPassword');
    var icon = document.getElementById('toggleConfirmPassword');

    if (confirmPasswordField.type === 'password') {
        confirmPasswordField.type = 'text';  // Change to text to show the password
        icon.setAttribute('name', 'eye-off'); // Change to eye-off icon when showing password
    } else {
        confirmPasswordField.type = 'password';
        icon.setAttribute('name', 'eye'); // Change back to eye icon when hiding password
    }
});


<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</script>


</body>

</html>