<?php
include 'config.php';
if (isset($_POST['login'])) {
    $u = $_POST['username'];
    $p = md5($_POST['password']);
    $q = mysqli_query($conn, "SELECT * FROM users WHERE username='$u' AND password='$p'");
    if (mysqli_num_rows($q) > 0) {
        $_SESSION['user'] = mysqli_fetch_assoc($q);
        header("Location: index.php");
    }
}
?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" href="style.css">
<body class="center">
<form method="post" class="box">
<h2>Login Chill Kafe</h2>
<input type="text" name="username" placeholder="Username" required>
<input type="password" name="password" placeholder="Password" required>
<button name="login">Login</button>
<a href="register.php">Daftar</a>
</form>
</body>
</html>
