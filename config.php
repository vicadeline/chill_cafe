<?php
session_start();
date_default_timezone_set("Asia/Jakarta");
$conn = mysqli_connect("localhost", "root", "", "chill_kafe");
if (!$conn) {
    die("Koneksi gagal");
}
?>
