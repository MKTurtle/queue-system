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
        <h1>Generate QR Code</h1>

        <?php
        // Check connection
        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }

        $sql = "SELECT * FROM items";
        $result = $mysqli->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "title: " . $row["title"] . " - description: " . $row["description"] . "<br>";
            }
        } else {
            echo "0 results";
        }
        $mysqli->close();
        echo getcwd();
        ?>

        <form method="POST" action="generateQR.php" enctype="multipart/form-data">
            <button type="submit" name="Submit" class="btn btn-success">Generate QR Code</button>
        </form>
    </div>

</body>

</html>