<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $status = $_POST['status'];
    if ($status == 1) {
        $sql_update_status = "UPDATE details SET is_active = '0' WHERE id = $id";
        $result_update_status = mysqli_query($conn, $sql_update_status);
        if ($result_update_status) {
            echo json_encode(array('success' => true, 'is_active' => 0));
        } else {
            echo json_encode(array('success' => false, 'message' => 'Failed to update active status'));
        }  
    } else {
        $sql_update_status = "UPDATE details SET is_active = '1' WHERE id = $id";
        $result_update_status = mysqli_query($conn, $sql_update_status);
        if ($result_update_status) {
            echo json_encode(array('success' => true, 'is_active' => 1));
        } else {
            echo json_encode(array('success' => false, 'message' => 'Failed to update active status'));
        }
    }
} else {
    echo json_encode(array('success' => false, 'message' => 'Invalid request method'));
}
?>
