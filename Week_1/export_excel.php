<?php
include 'connect.php';

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="downloadable_userlist.xls"');

// Fetch user data from the database
$sql = "SELECT * FROM `details`";
$result = mysqli_query($conn, $sql);

if ($result) {
    echo "ID\tName\tEmail\n"; // Excel header row

    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id'];
        $name = $row['username'] . ' ' . $row['lastname'];
        $email = $row['email_id'];

        echo "$id\t$name\t$email\n";
    }
}

exit();
?>
