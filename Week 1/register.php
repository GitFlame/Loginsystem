<?php
    include "connect.php";

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "INSERT INTO `details` (`SL_No.`, `Username`, `Email Id`, `Password`) VALUES ('$username', '$email', '$password')";
    $result=mysqli_query($conn,$sql);
    if($result){
        
        echo "Data inserted successfully";
    }else{
        die(mysqli_error($conn));
    }

?>


