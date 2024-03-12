<?php
session_start();

if (!isset($_SESSION["ssLoginPOS"])) {
    header("location: ../auth/login.php");
    exit();
}

require "../config/config.php";
require "../config/function.php";

$nota = $_GET['nota'];
$dataJual = getData("SELECT * FROM tbl_jual_head WHERE no_jual = '$nota'")[0];
$itemJual = getData("SELECT * FROM tbl_jual_detail WHERE no_jual = '$nota'");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Belanja</title>
</head>
<body>
    <table style="border-bottom: solid 2px; 
    text-align:center; font-size: 14px;width: 240px;">
        <tr>
            <td><b>VIAA MART</b></td>
        </tr>
        <tr>
            <td><?= 'No Nota : ' . $nota ?></td>
        </tr>
        <tr>
            <td><?= date('d-m-Y H:i:s') ?></td>
        </tr>
        <tr>
            <td><?= userLogin()['username'] ?></td>
        </tr>
    </table>

    <table style="border-bottom: dotted 2px; font-size: 14px;width: 240px;">
        <?php
        foreach ($itemJual as $item) {
        ?>
            <tr>
                <td colspan="6"><?= $item['nama_brg'] ?></td>
            </tr>
            <tr>
                <td colspan="2" style="width: 70px;">Qty :</td>
                <td style="width: 10px; text-align:right;"><?= $item['qty'] ?></td>
                <td style="width: 70px; text-align:right;">x 
                <?= number_format($item['harga_jual'], 0, ',', '.') ?></td>
                <td style="width: 70px; text-align:right;" colspan="2">
                <?= number_format($item['jml_harga'], 0, ',', '.') ?></td>
            </tr>

        <?php } ?>
    </table>

    <table style="border-bottom: dotted 2px; font-size: 14px;width: 240px;">
        <tr>
            <td colspan="3" style="width: 100px;"></td>
            <td style="width: 50px; text-align:right">Total</td>
            <td style="width: 70px; text-align:right" colspan="2">
            <b><?= number_format($dataJual['total'], 0, ',', '.') ?></b></td>
        </tr>
        <tr>
            <td colspan="3" style="width: 100px;"></td>
            <td style="width: 50px; text-align:right">Bayar</td>
            <td style="width: 70px; text-align:right" colspan="2">
            <b><?= number_format($dataJual['jml_bayar'], 0, ',', '.') ?></b></td>
        </tr>
    </table>

    <table style="border-bottom: solid 2px; font-size: 14px;width: 240px;">
        <tr>
            <td colspan="3" style="width: 100px;"></td>
            <td style="width: 50px; text-align:right">Kembali</td>
            <td style="width: 70px; text-align:right" colspan="2">
            <b><?= number_format($dataJual['kembalian'], 0, ',', '.') ?></b></td>
        </tr>
    </table>

    <table style="text-align:center; margin-top: 5px; font-size: 14px;width: 240px;">
        <tr>
            <td>Terimakasih sudah berberlanja</td>
        </tr>
    </table>

    <script>
        setTimeout(function() {
            window.print()
        }, 3000);
    </script>

</body>

</html>