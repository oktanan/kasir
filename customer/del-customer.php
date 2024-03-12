<?php

session_start();

if (!isset($_SESSION["ssLoginPOS"])) {
    header("location: ../auth/login.php");
    exit();
}

require "../config/config.php";
require "../config/function.php";
require "../module/mode-customer.php";

$id = $_GET['id'];

if (delete($id)) {
    echo "
            <script>document.location.href = 'data-customer.php?msg=deleted';</script>
    ";
}else {
    echo "
            <script>document.location.href = 'data-customer.php?msg=aborted';</script>
    ";
}
?>