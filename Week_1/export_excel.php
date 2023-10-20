<?php
include 'connect.php';
require 'vendor/autoload.php'; // Include PhpSpreadsheet

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Fetch data from database
$sql = "SELECT * FROM details";
$result = mysqli_query($conn, $sql);

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$sheet->setCellValue('A1', 'ID');
$sheet->setCellValue('B1', 'Name');
$sheet->setCellValue('C1', 'Email');

$row = 2;

while ($row_data = mysqli_fetch_assoc($result)) {
    $sheet->setCellValue('A' . $row, $row_data['id']);
    $sheet->setCellValue('B' . $row, $row_data['username'] . ' ' . $row_data['lastname']);
    $sheet->setCellValue('C' . $row, $row_data['email_id']);

    $row++;
}

$writer = new Xlsx($spreadsheet);
$filename = 'userlist.xlsx';
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename=' . $filename);
$writer->save('php://output');
?>


<script>
document.getElementById('exportExcel').addEventListener('click', function () {
  window.location.href = 'export_excel.php';
});
</script>
