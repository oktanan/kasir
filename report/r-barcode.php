<?php

session_start();

if (!isset($_SESSION["ssLoginPOS"])) {
    header("location: ../auth/login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Barcode</title>
</head>

<body>
    <?php

    $jmlCetak = $_GET['jmlCetak'];
    for ($i = 1; $i <= $jmlCetak; $i++) { ?>
        <div style="text-align: center; width: 210px; float: left; margin-right: 30px; margin-bottom: 30px;">
            <?php


            $barcode = $_GET['barcode'];

            require '../asset/barcodeGenerator/vendor/autoload.php';


            $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
            echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($barcode, $generator::TYPE_CODE_128)) . '"width="200px;">';
            ?>
            <div><?= $barcode ?></div>
        </div>
    <?php
    }
    ?>

    <script>
        window.print();
    </script>
</body>

</html>