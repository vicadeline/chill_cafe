<?php
include 'config.php';
if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit;
}
$menu = mysqli_query($conn,"SELECT * FROM menu");
?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" href="style.css">
<body>

<header>
<h2>☕ Chill Kafe</h2>
<div>
<a href="cart.php">🛒 Keranjang</a>
<a href="logout.php" onclick="return confirm('Apakah kamu yakin ingin logout? 👋🙂')">
    Logout
</a>
</div>
</header>

<div class="hero"></div>

<div class="menu">
<?php while($m=mysqli_fetch_assoc($menu)){ ?>
<div class="card">
<img src="images/<?= $m['image'] ?>">
<h3><?= $m['name'] ?></h3>
<p><?= $m['description'] ?></p>
<p>Rp <?= number_format($m['price']) ?></p>

<form method="post" action="add_to_cart.php">
<input type="hidden" name="menu_id" value="<?= $m['id'] ?>">
<input type="number" name="qty" value="1" min="1">

<?php if($m['has_temp']){ ?>
<select name="temperature">
<option>Hot</option>
<option>Cold</option>
</select>
<?php } ?>

<button>Tambah</button>
</form>
</div>
<?php } ?>
</div>

</body>
</html>
