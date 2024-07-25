<?php
include 'databaseConnection.php';
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$sheet->setCellValue('A1', 'S.no');
$sheet->setCellValue('B1', 'Username');
$sheet->setCellValue('C1', 'Email');
$sheet->setCellValue('D1', 'Password');

$sql = "SELECT id, username, email, password FROM userlogin";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $rowNum = 2;
    $sno = 1;
    while ($row = $result->fetch_assoc()) {
        $sheet->setCellValue('A' . $rowNum, $sno);
        $sheet->setCellValue('B' . $rowNum, $row['username']);
        $sheet->setCellValue('C' . $rowNum, $row['email']);
        $sheet->setCellValue('D' . $rowNum, $row['password']);
        $rowNum++;
        $sno++;
    }
}

$writer = new Xlsx($spreadsheet);
$filename = 'user_datas_list.xlsx';
$temp_file = tempnam(sys_get_temp_dir(), 'phpexcel');

$writer->save($temp_file);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'.$filename.'"');
header('Cache-Control: max-age=0');
header('Cache-Control: max-age=1');

readfile($temp_file);
unlink($temp_file);

$conn->close();
exit();
?>
