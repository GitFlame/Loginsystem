<?php
include 'connect.php';
$id=$_GET['update_id'];
$sql="select * from `details` where id=$id";
$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($result);
$name=$row['username'];
$email=$row['email_id']; 
$password=$row['password'];

if(isset($_POST['submit'])){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $sql="update `details` set id=$id , username='$name' , email_id='$email', password='$password' where id=$id";
    $result=mysqli_query($conn,$sql);
    if($result){
       echo "Updated successfully";
       //header('location:display.php');
    }else{
        die (mysqli_error($conn));
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->

    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" >
    <link rel="stylesheet" href="css/style.css">


    <title>Update Centre</title>
</head>


<body>
<div class="form-box register">
            <h2>Update Your Details here!</h2>
            <form action="update.php" method="post" onsubmit="return validateForm()">
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="person"></ion-icon>
                    </span>
                    <input id="username" name="username" type="text"  autocomplete="off" value=<?php echo $name;?>>
                    <label>Username <span class="mandatory">*</span></label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="mail"></ion-icon>
                    </span>
                    <input id="email" name="email" type="email" autocomplete="off" value=<?php echo $email;?>>
                    <label>Email <span class="mandatory">*</span></label>
                </div>
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="lock-closed"></ion-icon>
                    </span>
                    <input id="password" name="password" type="password" autocomplete="off" value=<?php echo $password;?>>
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
                    <input id="confirmPassword" name="confirmPassword" type="password" autocomplete="off" value=<?php echo $password;?>>
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
                <button type="submit" class="btn btn-primary" name="update">Update</button>
            </form>
        </div>
    </div>

            
        </form>


    </div>

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
            else if (password.length <script 8) {
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






</body>

</html>