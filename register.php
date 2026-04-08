<?php
include 'config.php';

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    // cek username sudah ada atau belum
    $cek = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
    if (mysqli_num_rows($cek) > 0) {
        $error = "Username sudah terdaftar!";
    } else {
        mysqli_query($conn, "INSERT INTO users VALUES(NULL,'$username','$password')");
        header("Location: login.php");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register - Chill Kafe</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="center">

<form method="post" class="box">
    <h2>Register Akun</h2>

    <?php if (isset($error)) { ?>
        <p style="color:red;"><?= $error ?></p>
    <?php } ?>

    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>

    <button name="register">Register</button>

    <p style="margin-top:15px;">
        Sudah punya akun?
        <a href="login.php" style="color:#4b2e1e;font-weight:bold;">
            Login di sini
        </a>
    </p>
</form>

</body>
</html>
