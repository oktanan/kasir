<?php

session_start();

if (!isset($_SESSION["ssLoginPOS"])) {
    header("location: ../auth/login.php");
    exit();
}

require "../config/config.php";
require "../config/function.php";
require "../module/mode-barang.php";

$title  = "Barang - Codingline POS";
require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";

if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
} else {
    $msg = '';
}

$alert = '';
// jalankan fungsi hapus barang
if ($msg == 'deleted') {
    $id = $_GET['id'];
    $gbr = $_GET['gbr'];
    delete($id, $gbr);
    $alert = "<script>
                    $(document).ready(function(){
                        $(document).Toasts('create',{
                            title : 'Sukses',
                            body  : 'Data barang berhasil dihapus dari database..',
                            class : 'bg-success',
                            icon  : 'fas fa-check-circle',
                        })
                    });
            </script>";
}

if ($msg == 'updated') {

    $alert = "<script>
                    $(document).ready(function(){
                        $(document).Toasts('create',{
                            title : 'Sukses',
                            body  : 'Data barang berhasil diperbarui..',
                            class : 'bg-success',
                            icon  : 'fas fa-check-circle',
                            position: 'bottomRight',
                            autohide: true,
                            delay : 5000,
                        })
                    });
            </script>";
}

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Barang</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= $main_url ?>dashboard.php">Home</a></li>
                        <li class="breadcrumb-item active">Add Barang</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <?php if ($alert != '') {
                    echo $alert;
                } ?>
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-list fa-sm"></i>
                        Data Barang</h3>
                    <a href="<?= $main_url ?>barang/form-barang.php" class="mr-2 btn btn-sm btn-primary float-right"><i class="fas fa-plus fa-sm"></i>Add Barang</a>
                </div>
                <div class="card-body table-responsive p-3">
                    <table class="table table-hover text-nowrap" id="tblData">
                        <thead>
                            <tr>
                                <th>Gambar</th>
                                <th>ID Barang</th>
                                <th>Nama Barang</th>
                                <th>Harga Beli</th>
                                <th>Harga Jual</th>
                                <th style="width: 10%;" class="text-center">Operasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $barang = getData("SELECT * FROM tbl_barang");
                            foreach ($barang as $brg) { ?>
                                <tr>
                                    <td>
                                        <img src="../asset/image/<?= $brg['gambar'] ?>" alt="gambar barang" class="rounded-circle" width="60px">
                                    </td>
                                    <td><?= $brg['id_barang'] ?></td>
                                    <td><?= $brg['nama_barang'] ?></td>
                                    <td class="text-center"><?= number_format($brg['harga_beli'], 0, ',', '.') ?></td>
                                    <td class="text-center"><?= number_format($brg['harga_jual'], 0, ',', '.') ?></td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-secondary" id="btnCetakBarcode" data-barcode="<?= $brg['barcode'] ?>" data-nama="<?= $brg['nama_barang'] ?>" title="cetak barcode"><i class="fas fa-barcode"></i></button>
                                        <a href="form-barang.php?id=<?= $brg['id_barang'] ?>&msg=editing" class="btn btn-warning btn-sm" title="edit barang"><i class="fas fa-pen"></i></a>
                                        <a href="?id=<?= $brg['id_barang'] ?>&gbr=<?= $brg['gambar'] ?>&msg=deleted" class="btn btn-danger btn-sm" title="hapus barang" onclick="return confirm('Anda yakin akan menghapus barang ini ?')"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="mdlCetakBarcode">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Cetak Barcode</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="nmBrg" class="col-sm-3 col-form-label">Nama Barang</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nmBrg" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="barcode" class="col-sm-3 col-form-label">Barcode</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="barcode" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jmlCetak" class="col-sm-3 col-form-label">Jumlah Cetak</label>
                        <div class="col-sm-9">
                            <input type="number" min="1" max="10" value="1" title="maximal 10" id="jmlCetak" class="form-control" id="barcode">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="preview"><i class="fas fa-print"></i> Cetak</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <script>
        $(document).ready(function(){
            $(document).on("click", "#btnCetakBarcode", function(){     // #btnCetakBarcode diambil dari id line 117
                $('#mdlCetakBarcode').modal('show');                      // jquery carikan elemen yg id nya mdlCetakBarcode
                let barcode = $(this).data('barcode'); 
                let nama    = $(this).data('nama'); 
                $('#nmBrg').val(nama);
                $('#barcode').val(barcode);
            }) 

            $(document).on("click", "#preview", function(){     // #preview diambil dari tombol cetak
                let barcode = $('#barcode').val(); 
                let jmlCetak = $('#jmlCetak').val(); 
                if (jmlCetak > 0 && jmlCetak <= 10) {
                    window.open("../report/r-barcode.php?barcode=" + barcode + "&jmlCetak=" + jmlCetak)
                }
            }) 
        })
    </script>

    <?php

    require "../template/footer.php";

    ?>