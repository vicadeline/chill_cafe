<?php
include 'config.php';

$uid  = $_SESSION['user']['id'];
$mid  = $_POST['menu_id'];
$qty  = $_POST['qty'];
$temp = $_POST['temperature'] ?? '-';

/* AMBIL HARGA MENU */
$q = mysqli_query($conn, "SELECT price FROM menu WHERE id=$mid");
$menu = mysqli_fetch_assoc($q);
$price = $menu['price'];

/* SIMPAN KE CART + HARGA */
mysqli_query($conn, "
INSERT INTO cart (user_id, menu_id, qty, price, temperature, buyer_name)
VALUES ($uid, $mid, $qty, $price, '$temp', '')
");

header("Location: cart.php");
