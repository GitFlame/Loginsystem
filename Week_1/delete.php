<?php
include 'connect.php';

if(isset($_GET['delete_id'])){
    $id = $_GET['delete_id'];
    
    // Show a confirmation dialog before deleting
    echo "<script>
          var confirmDelete = confirm('Are you sure you want to delete this record?');
          if(confirmDelete) {
              window.location.href='delete.php?confirm_delete_id={$id}';
          } else {
              window.location.href='display.php';
          }
          </script>";
    exit();
}

if(isset($_GET['confirm_delete_id'])) {
    $id = $_GET['confirm_delete_id'];

    $sql = "DELETE FROM `details` WHERE id=$id";
    $result = mysqli_query($conn, $sql);

    if($result) {
        header('location: display.php?delete_status=success');
    } else {
        die(mysqli_error($conn));
    }
    exit();
}
?>
