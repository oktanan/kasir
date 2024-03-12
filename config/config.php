<?php 
date_default_timezone_set('Asia/Jakarta');
 
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'kasir';

$koneksi = mysqli_connect($host, $user, $pass, $dbname);

//if(mysqli_connect_errno()){
//    echo "gagal koneksi ke database";
//    exit();
//}else{
//    echo "berhasil koneksi ke database";
//}


$main_url = 'http://localhost/kasir-viaamart/';
?>