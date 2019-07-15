<?php
    $dbHost = "localhost";
    $dbDatabase = "insert_data_from_excel";
    $dbPasswrod = "mikmik23";
    $dbUser = "root";
    $mysqli = new mysqli($dbHost, $dbUser, $dbPasswrod, $dbDatabase);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Excel Uploading PHP</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1>Excel Upload</h1>

	<form method="POST" action="excelUpload.php" enctype="multipart/form-data">
        <div class="form-group">
            <label>Upload Excel File</label>
            <input type="file" name="file" class="form-control">
        </div>
        <div class="form-group">
            <button type="submit" name="Submit" class="btn btn-success">Upload</button>
        </div>
    </form>

    <form method="POST" action="excelUpload.php" enctype="multipart/form-data">
        <button type="submit" name="Submit" class="btn btn-success">Generate QR Code</button>
    </form>
</div>
</body>
</html>