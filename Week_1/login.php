<?php

include('connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['loginEmail'];
    $password = $_POST['loginPassword'];

    // echo "<pre>"; print_r($_POST); 
    // exit();

    // Query the database for the user's hashed password
    $sql = "SELECT password FROM details WHERE email_id='$username'";
   
    $result = $conn->query($sql);
    

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
         $storedPassword = $row['password'];


        $storedHashedPassword = md5($password);
        if ($storedPassword === $storedHashedPassword) {
            
            // Passwords match, user is authenticated
            header("Location: display.php");
            exit();
        } else {
            echo "Invalid username or password";
        }
    } else {
        echo "Invalid username or password";
    }
}

?>
