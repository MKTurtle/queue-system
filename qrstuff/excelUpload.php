<?php
require('library/php-excel-reader/excel_reader2.php');
require('library/SpreadsheetReader.php');

$dbHost = "localhost";
$dbDatabase = "insert_data_from_excel";
$dbPasswrod = "mikmik23";
$dbUser = "root";
$mysqli = new mysqli($dbHost, $dbUser, $dbPasswrod, $dbDatabase);

print_r($_FILES);
if (isset($_POST['Submit'])) {
    $mimes = array('application/vnd.ms-excel', 'text/xls', 'text/xlsx', 'application/vnd.oasis.opendocument.spreadsheet', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    if (in_array($_FILES["file"]["type"], $mimes)) {
        $uploadFilePath = 'uploads/' . basename($_FILES['file']['name']);

        $Reader = new SpreadsheetReader($uploadFilePath);

        $totalSheet = count($Reader->sheets());
        echo "You have total " . $totalSheet . " sheets";

        /* For Loop for all sheets */
        for ($i = 0; $i < $totalSheet; $i++) {
            $Reader->ChangeSheet($i);
            foreach ($Reader as $Row) {
                $title = isset($Row[0]) ? $Row[0] : ''; //To be changed to Student ID
                $description = isset($Row[1]) ? $Row[1] : ''; //To be changed to Student Name

                $result = $mysqli->query("SELECT * FROM insert_data_from_excel.items WHERE title = '$title';");
                if ($result->num_rows == 0) { //check if there is a duplicated PK
                    $query = "insert into items(title,description) values('" . $title . "','" . $description . "')";
                    $mysqli->query($query);
                    $noDuplicate = "Data is uploaded."; //file name to be changed
                } else {
                    $noDuplicate = "No data is uploaded."; //description to be changed - no duplicate etc
                }
            }
        }
        echo "<br /> $noDuplicate";
    } else {
        die("<br/>Sorry, File type is not allowed. Only Excel file.");
    }
}
?>