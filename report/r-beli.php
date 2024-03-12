<?php

session_start();

if (!isset($_SESSION["ssLoginPOS"])) {
    header("location: ../auth/login.php");
    exit();
}

require "../config/config.php";
require "../config/function.php";

$tgl1 = $_GET['tgl1'];
$tgl2 = $_GET['tgl2'];
$dataBeli = getData("SELECT * FROM tbl_beli_head WHERE tgl_beli BETWEEN '$tgl1' AND '$tgl2'");

$totalBeli = 0;
foreach ($dataBeli as $data) {
    $totalBeli += $data['total'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pembelian</title>
</head>

<body>

    <div style="text-align: center;">
        <h2 style="margin-bottom: -15px;">Rekap Laporan Pembelian</h2>
        <h2 style="margin-bottom: 15px;">VIAA MART</h2>
    </div>

    <table>
        <thead>
            <tr>
                <td colspan="5" style="height: 5px;">
                    <hr style="margin-bottom: 2px; margin-left: -5px;" , size="3" color="grey">
                </td>
            </tr>
            <tr>
                <th>No</th>
                <th style="width: 120px;">Tgl Pembelian</th>
                <th style="width: 120px;">ID Pembelian</th>
                <th style="width: 300px;">Supplier</th>
                <th>Total Harga</th>
            </tr>
            <tr>
                <td colspan="5" style="height: 5px;">
                    <hr style="margin-bottom: 2px; margin-left: -5px; margin-top: 1px;" , size="3" color="grey">
                </td>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($dataBeli as $data) { ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td align="center"><?= in_date($data['tgl_beli']) ?></td>
                    <td align="center"><?= $data['no_beli'] ?></td>
                    <td align="center"><?= $data['supplier'] ?></td>
                    <td align="right"><?= number_format($data['total'], 0, ',', '.') ?></td>
                </tr>
            <?php
            }
            ?>
            <tr>
                <td colspan="5" style="height: 5px;">
                    <hr style="margin-bottom: 2px; margin-left: -5px; margin-top: 1px;" , size="3" color="grey">
                </td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" align="right"><strong>Total Pembelian:</strong></td>
                <td align="right"><?= number_format($totalBeli, 0, ',', '.') ?></td>
            </tr>
        </tfoot>
    </table>

    <script>
        window.print();
    </script>

</body>

</html>