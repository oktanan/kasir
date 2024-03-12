<?php

session_start();

if (!isset($_SESSION["ssLoginPOS"])) {
    header("location: ../auth/login.php");
    exit();
}

require "../config/config.php";
require "../config/function.php";
require "../module/mode-barang.php";

$title  = "Form Barang - Codingline POS";
require "../template/header.php";
require "../template/navbar.php";
require "../template/sidebar.php";

if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
    $id  = $_GET['id'];
    $sqlEdit = "SELECT * FROM tbl_barang WHERE id_barang = '$id'";
    $barang  = getData($sqlEdit)[0];
} else {
    $msg = "";
}

$alert = '';

if (isset($_POST['simpan'])) {
    if ($msg != '') {
        if (update($_POST)) {
            echo "
                <script>document.location.href = 'index.php?msg=updated';</script>
            "; 
        } else {
            echo "
                <script>document.location.href = 'index.php';</script>
            "; 
        }
    } else {
        if (insert($_POST)) {
            $alert = '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-check"></i> Alert!</h5>
            Barang berhasil ditambahkan..
            </div>';
        }
    }
    
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
                        <li class="breadcrumb-item"><a href="<?= $main_url ?>barang">Barang</a></li>
                        <li class="breadcrumb-item active"><?= $msg != '' ? 'Edit Barang' : 'Add Barang' ?></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <form action="" method="post" enctype="multipart/form-data">
                    <?php if ($alert != '') {
                        echo $alert;
                    } ?>
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-pen fa-sm"></i>
                            <?= $msg != '' ? 'Edit Barang' : 'Input Barang' ?></h3>
                        <button type="submit" name="simpan" class="btn btn-primary btn-sm float-right"> <i class="fas fa-save"></i> Simpan </button>
                        <button type="reset" class="btn btn-danger btn-sm float-right mr-1"><i class="fas fa-times"></i> Reset</button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-8 mb-3 pr-3">
                                <div class="form-group">
                                    <label for="kode">Kode Barang</label>
                                    <input type="text" name="kode" class="form-control" id="kode" value="<?= $msg != '' ? $barang['id_barang'] : generateId() ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="barcode">Barcode *</label>
                                    <input type="text" name="barcode" class="form-control" id="barcode" value="<?= $msg != '' ? $barang['barcode'] : null ?>" placeholder="barcode" autocomplete="off" autofocus required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Nama *</label>
                                    <input type="text" name="name" class="form-control" id="name" placeholder="nama barang" value="<?= $msg != '' ? $barang['nama_barang'] : null ?>" autocomplete="off" autofocus required>
                                </div>
                                <div class="form-group">
                                    <label for="satuan">Satuan *</label>
                                    <select name="satuan" id="satuan" class="form-control" required>
                                        <?php
                                            if ($msg != "") {
                                                $satuan = ["piece", "botol", "kaleng", "pouch"];
                                                foreach ($satuan as $sat) {
                                                    if ($barang['satuan'] == $sat) { ?>
                                                        <option value="<?= $sat ?>" selected><?= $sat ?></option>
                                                    <?php } else { ?>
                                                        <option value="<?= $sat ?>"><?= $sat ?></option>
                                                    <?php
                                                    }
                                                }
                                            } else { ?>
                                                <option value="">--Satuan Barang--</option>
                                                <option value="piece">piece</option>
                                                <option value="botol">botol</option>
                                                <option value="kaleng">kaleng</option>
                                                <option value="pouch">pouch</option>
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="harga_beli">Harga Beli *</label>
                                    <input type="number" name="harga_beli" class="form-control" id="harga_beli" value="<?= $msg != '' ? $barang['harga_beli'] : null ?>" placeholder="Rp 0" autocomplete="off" required>
                                </div>
                                <div class="form-group">
                                    <label for="harga_jual">Harga Jual *</label>
                                    <input type="number" name="harga_jual" class="form-control" id="harga_jual" value="<?= $msg != '' ? $barang['harga_jual'] : null ?>" placeholder="Rp 0" autocomplete="off" required>
                                </div>
                                <div class="form-group">
                                    <label for="stock_minimal">Stock Minimal *</label>
                                    <input type="number" name="stock_minimal" class="form-control" id="stock_minimal" value="<?= $msg != '' ? $barang['stock_minimal'] : null ?>" placeholder="0" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="col-lg-4 text-center px-3">
                                <input type="hidden" name="oldImg" value="<?= $msg != '' ? $barang['gambar'] : null ?>">
                                <img src="<?= $main_url ?>asset/image/<?= $msg != '' ? $barang['gambar'] : 'default-brg.jpeg' ?>" class="profile-user-img mb-3 mt-4" alt="">
                                <input type="file" class="form-control" name="image">
                                <span class="text-sm">Type file gambar JPG | PNG | JPEG | GIF</span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <?php

    require "../template/footer.php";

    ?>