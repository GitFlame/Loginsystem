<?php
include 'connect.php';

header('Content-Type: application/json'); // Set the response content type to JSON

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['userId']) && isset($_POST['newStatus'])) {
    $userId = $_POST['userId'];
    $newStatus = $_POST['newStatus'];

    // Check if the user ID is valid and exists in the database
    $checkUserQuery = "SELECT * FROM `details` WHERE id = $userId";
    $checkUserResult = mysqli_query($conn, $checkUserQuery);

    if (mysqli_num_rows($checkUserResult) > 0) {
        // Update the user's status in the database
        $updateStatusQuery = "UPDATE `details` SET is_active = $newStatus WHERE id = $userId";
        $updateStatusResult = mysqli_query($conn, $updateStatusQuery);

        if ($updateStatusResult) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to update status: ' . mysqli_error($conn)]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'User not found']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
?>
