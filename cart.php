<?php
include 'config.php';
$uid = $_SESSION['user']['id'];

$data = mysqli_query($conn,"
SELECT cart.*, menu.name
FROM cart
JOIN menu ON cart.menu_id = menu.id
WHERE cart.user_id = $uid
");
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
<title>Keranjang</title>
</head>
<body>

<h2>Keranjang Belanja</h2>

<!-- TOMBOL KEMBALI -->
<a href="index.php" style="
display:inline-block;
margin-bottom:15px;
background:#4b2e1e;
color:white;
padding:8px 14px;
border-radius:6px;
text-decoration:none;
">
⬅ Kembali ke Menu
</a>

<form method="post" action="checkout.php">
<input type="text" name="buyer" placeholder="Nama Pembeli" required>

<table border="1" cellpadding="8" cellspacing="0">
<tr>
    <th>Menu</th>
    <th>Qty</th>
    <th>Temp</th>
    <th>Harga</th>
    <th>Subtotal</th>
    <th>Aksi</th>
</tr>

<?php
$total = 0;
while ($d = mysqli_fetch_assoc($data)) {
    $subtotal = $d['price'] * $d['qty'];
    $total += $subtotal;
?>
<tr>
    <td><?= $d['name'] ?></td>
    <td><?= $d['qty'] ?></td>
    <td><?= $d['temperature'] ?></td>
    <td>Rp <?= number_format($d['price']) ?></td>
    <td>Rp <?= number_format($subtotal) ?></td>
    <td>
        <a href="remove_cart.php?id=<?= $d['id'] ?>">❌</a>
    </td>
</tr>
<?php } ?>

</table>

<h3>Total: Rp <?= number_format($total) ?></h3>
<button>Pesan Sekarang</button>
</form>

</body>
</html>
