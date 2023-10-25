<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    // Toggle the is_active status
    $sql = "UPDATE details SET is_active = NOT is_active WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo json_encode(array('success' => true, 'is_active' => $result));
    } else {
        echo json_encode(array('success' => false, 'message' => 'Failed to toggle active status'));
    }
} else {
    echo json_encode(array('success' => false, 'message' => 'Invalid request method'));
}
?>
