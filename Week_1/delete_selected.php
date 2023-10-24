<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedIds = isset($_POST['selectedIds']) ? $_POST['selectedIds'] : [];

    if (empty($selectedIds)) {
        $response = ['success' => false, 'message' => 'No records selected for deletion'];
    } else {
        $selectedIds = array_map('intval', $selectedIds); // Ensure that the IDs are integers

        $placeholders = implode(',', array_fill(0, count($selectedIds), '?'));
        $query = "DELETE FROM `details` WHERE id IN ($placeholders)";

        // Prepare and bind the parameters
        $stmt = $conn->prepare($query);
        if ($stmt) {
            $stmt->bind_param(str_repeat('i', count($selectedIds)), ...$selectedIds);

            if ($stmt->execute()) {
                $response = ['success' => true, 'message' => 'Selected records deleted successfully'];
            } else {
                $response = ['success' => false, 'message' => 'Failed to delete selected records'];
            }

            $stmt->close();
        } else {
            $response = ['success' => false, 'message' => 'Failed to prepare the delete statement'];
        }
    }
} else {
    $response = ['success' => false, 'message' => 'Invalid request method'];
}

header('Content-Type: application/json');
echo json_encode($response);
exit();
?>
