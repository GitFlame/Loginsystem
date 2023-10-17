<?php
include 'connect.php';
if(isset($_GET['delete_id'])){
    $id=$_GET['delete_id'];
    echo "<script>
            var confirmed = confirm('Are you sure you want to delete this record?');
            if(confirmed) {
                window.location.href='delete.php?confirmed=true&delete_id=$id';
            } else {
                window.location.href='display.php';
            }
          </script>";
}

if(isset($_GET['confirmed']) && $_GET['confirmed'] === 'true'){
    $id=$_GET['delete_id'];

    $sql="Delete from `details` where id=$id";
    $result=mysqli_query($conn,$sql);
    if($result){
        echo "<script>alert('Record Deleted');</script>";
        echo "<script>setTimeout(function(){window.location.href='display.php'}, 2000);</script>";
        exit();
    } else {
        die(mysqli_error($con));
    }
}
?>
