<?php
require 'vendor/autoload.php';
include "auth.php";
include "db_connect.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Csv;

if(isset($_POST['export-btn'])){
    $ext = $_POST['export_file'];
    $filename = "appointment-sheet-" . time();

    $sql = "SELECT u.Name, f.Name AS faculty_name, a.subject, a.Timing,a.sTime,a.Status,a.attendance,a.app_id, u.email AS student_roll
                FROM user_registration u
                JOIN appointment a ON u.email = a.email
                JOIN faculty f ON a.Faculty_Id = f.Id
                WHERE f.Email = '" . $_SESSION['email'] . "';";
    $result = mysqli_query($db_connection, $sql);

    if(mysqli_num_rows($result) > 0){
        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();

        $activeWorksheet->setCellValue('A1', 'Student Name');
        $activeWorksheet->setCellValue('B1', 'Faculty Name');
        $activeWorksheet->setCellValue('C1', 'Date');
        $activeWorksheet->setCellValue('D1', 'Subject');
        $activeWorksheet->setCellValue('E1', 'Email');
        $activeWorksheet->setCellValue('F1', 'Time');
        $activeWorksheet->setCellValue('G1', 'Status');
        $activeWorksheet->setCellValue('H1', 'Attendance');

        $rowCount=2;
        foreach($result as $row)
        {
            $activeWorksheet->setCellValue('A' .$rowCount, $row['Name']);
            $activeWorksheet->setCellValue('B' .$rowCount, $row['faculty_name']);
            $activeWorksheet->setCellValue('C' .$rowCount, $row['Timing']);
            $activeWorksheet->setCellValue('D' .$rowCount, $row['subject']);
            $activeWorksheet->setCellValue('E' .$rowCount, $row['student_roll']);
            $activeWorksheet->setCellValue('F' .$rowCount, $row['sTime']);
            $activeWorksheet->setCellValue('G' .$rowCount, $row['Status']);
            $activeWorksheet->setCellValue('H' .$rowCount, $row['attendance']);
            $rowCount++;
        }

        if($ext == 'xlsx')
        {
            $writer = new Xlsx($spreadsheet);
            $finalname=$filename. '.xlsx';
            
        }
        else if($ext == 'csv')
        {
            $writer = new Csv($spreadsheet);
            $finalname=$filename. '.csv';
            
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . urldecode($finalname) . '"');

        $writer->save('php://output');
        exit; 
    }
    else{
        echo '<script>';
        echo 'alert("No records Found");';
        echo 'window.location="panel.php";';
        echo '</script>';
    }
}
?>
