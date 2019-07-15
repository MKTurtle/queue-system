<?php
$dbHost = "localhost";
$dbDatabase = "insert_data_from_excel";
$dbPasswrod = "mikmik23";
$dbUser = "root";
$mysqli = new mysqli($dbHost, $dbUser, $dbPasswrod, $dbDatabase);

include("library/phpqrcode/qrlib.php");
?>
<!DOCTYPE html>
<html>

<head>
    <title>generateQR</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1>Generated</h1>

        <?php
        // Check connection
        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }

        $sql = "SELECT * FROM items";
        $result = $mysqli->query($sql);

        $tempDir = "./qrcodes/";
        $tryd = "qrcodes/try helloo.png";
        $logopath = "./qrcodes/bits.png";

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $codeContents = $row["title"];

                // QR code file name
                $fileName = 'try ' . $codeContents . '.png';
                $pngAbsoluteFilePath = $tempDir . $fileName;

                // generating
                if (!file_exists($pngAbsoluteFilePath)) {
                    QRcode::png($codeContents, $pngAbsoluteFilePath, QR_ECLEVEL_H, 18, 2, true);
                    echo 'File generated!';
                    echo '<hr />';

                    $QR = imagecreatefrompng($tryd);

                    // START TO DRAW THE IMAGE ON THE QR CODE
                    $logo = imagecreatefromstring(file_get_contents($logopath));
                    $QR_width = imagesx($QR);
                    $QR_height = imagesy($QR);
            
                    $logo_width = imagesx($logo);
                    $logo_height = imagesy($logo);
            
                    // Scale logo to fit in the QR Code
                    $logo_qr_width = $QR_width/5;
                    $scale = $logo_width/$logo_qr_width;
                    $logo_qr_height = $logo_height/$scale;

                    $out = imagecreatetruecolor($QR_width, $QR_width);

                    imagecopyresampled($out, $QR, 0, 0, 0, 0, $QR_width, $QR_height, $QR_width, $QR_height);
                    imagecopyresampled($out, $logo, $QR_width/2.5, $QR_height/2.5, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);
            
                    // Save QR code again, but with logo on it
                    imagepng($out,$tryd);

                } else {
                    echo 'File already generated! We can use this cached file to speed up site on common codes!';
                    echo '<hr />';
                }
                echo 'Server PNG File: ' . $pngAbsoluteFilePath;
            }
        } else {
            echo "0 results";
        }
        $mysqli->close();
        
        ?>

</body>

</html>