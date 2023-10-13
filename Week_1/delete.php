<?php
include 'connect.php';
if(isset($_GET['delete_id'])){
    $id=$_GET['delete_id'];

    $sql="Delete from `details` where id=$id";
    $result=mysqli_query($conn,$sql);
    if($result){
        echo "<script>alert('Record Deleted');</script>";
        echo "<script>setTimeout(function(){window.location.href='display.php'}, 2000);</script>";
        exit();
    }else{
        die(mysqli_error($con));
    }

}
?>
