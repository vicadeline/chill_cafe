<?php
include 'config.php';

$uid   = $_SESSION['user']['id'];
$buyer = $_POST['buyer'];

/* AMBIL CART USER */
$cart = mysqli_query($conn, "
SELECT cart.*, menu.name 
FROM cart 
JOIN menu ON cart.menu_id = menu.id
WHERE cart.user_id = $uid
");

$items = [];
$grand_total = 0;

/* SIMPAN KE ORDERS + SIMPAN UNTUK NOTA */
while ($c = mysqli_fetch_assoc($cart)) {

    $menu_name = $c['name'];
    $qty  = $c['qty'];
    $price = $c['price'];
    $temp = $c['temperature'];
    $total = $qty * $price;

    mysqli_query($conn, "
        INSERT INTO orders 
        (user_id, buyer_name, menu_name, qty, price, temperature, total)
        VALUES 
        ($uid, '$buyer', '$menu_name', $qty, $price, '$temp', $total)
    ");

    $items[] = [
        'menu' => $menu_name,
        'qty' => $qty,
        'price' => $price,
        'temp' => $temp,
        'total' => $total
    ];

    $grand_total += $total;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Nota Pembelian</title>
    <link rel="stylesheet" href="style.css?v=2">
</head>
<body class="center">

<div class="box box-checkout">
    <h2>🧾 Nota Pembelian</h2>

    <p><b>Nama Pembeli:</b> <?= $buyer ?></p>
    <p><b>Waktu Pesan:</b> <?= date("d-m-Y H:i") ?></p>

    <table>
        <tr>
            <th>Menu</th>
            <th>Jumlah</th>
            <th>Suhu</th>
            <th>Harga</th>
            <th>Subtotal</th>
        </tr>

        <?php foreach ($items as $i) { ?>
        <tr>
            <td><?= $i['menu'] ?></td>
            <td><?= $i['qty'] ?></td>
            <td><?= $i['temp'] ?></td>
            <td>Rp <?= number_format($i['price']) ?></td>
            <td>Rp <?= number_format($i['total']) ?></td>
        </tr>
        <?php } ?>

        <tr>
            <th colspan="4">Total</th>
            <th>Rp <?= number_format($grand_total) ?></th>
        </tr>
    </table>

    <p style="margin-top:40px;">
        Terima kasih sudah memesan di <b>Chill Kafe</b><br>
        Pesanan kamu sedang kami siapkan 🤍
    </p>

    <a href="index.php" class="back">Kembali ke Menu</a>
</div>

<?php
/* KOSONGKAN CART SETELAH NOTA TAMPIL */
mysqli_query($conn, "DELETE FROM cart WHERE user_id = $uid");
?>

</body>
</html>
