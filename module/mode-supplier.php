<?php

if (userLogin()['level'] == 3) {
    header("location:" . $main_url . "error-page.php");
    exit();
}

function insert($data){
    global $koneksi;

    $nama    = mysqli_real_escape_string($koneksi, $data['nama']);
    $telepon = mysqli_real_escape_string($koneksi, $data['telepon']);
    $alamat  = mysqli_real_escape_string($koneksi, $data['alamat']);
    $ketr    = mysqli_real_escape_string($koneksi, $data['ketr']);

    $sqlSupplier    = "INSERT INTO tbl_supplier VALUES (NULL, '$nama','$telepon','$ketr','$alamat')";
    mysqli_query($koneksi, $sqlSupplier);

    return mysqli_affected_rows($koneksi);
}


function delete($id){
    global $koneksi;

    $sqlDelete = "DELETE FROM tbl_supplier WHERE id_supplier = $id";
    mysqli_query($koneksi, $sqlDelete);
    
    return mysqli_affected_rows($koneksi);
}


function update($data){
    global $koneksi;


    $id      = mysqli_real_escape_string($koneksi, $data['id']);
    $nama    = mysqli_real_escape_string($koneksi, $data['nama']);
    $telepon = mysqli_real_escape_string($koneksi, $data['telepon']);
    $alamat  = mysqli_real_escape_string($koneksi, $data['alamat']);
    $ketr    = mysqli_real_escape_string($koneksi, $data['ketr']);

    $sqlSupplier    = "UPDATE tbl_supplier SET
                        nama       = '$nama',
                        telepon    = '$telepon',
                        deskripsi  = '$ketr',
                        alamat     = '$alamat'
                        WHERE id_supplier = $id
                        ";
    mysqli_query($koneksi, $sqlSupplier);

    return mysqli_affected_rows($koneksi);
}
?>