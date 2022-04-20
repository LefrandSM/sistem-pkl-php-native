<?php 
// memulai session
session_start();
// cek apakah session sudah ada atau belum
if (isset($_SESSION["login_admin"])) {
	header("location: admin/index.php");
} else if (isset($_SESSION["login_siswa"])) {
	header("location: admin/index.php");
}
// menghubungkan ke function.php
require 'function/function.php';
// cek apakah tombol sudah di tekan
if (isset($_POST['login'])) {	
	// masukkan data yang di input user ke dalam variable
	$username = $_POST['username'];
	$password = $_POST['password'];
	// ambil data yang sama dengan form di table admin
	$admin = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$username' and password = '$password'");
	$data_admin = mysqli_fetch_assoc($admin);
	// ambil data yang sama dengan form di table siswa
	$siswa = mysqli_query($conn, "SELECT * FROM siswa WHERE username = '$username' and password = '$password'");
	$data_siswa = mysqli_fetch_assoc($siswa);
	// ambil data yang sama dengan form di table humas
	$humas = mysqli_query($conn, "SELECT * FROM humas WHERE username = '$username' and password = '$password'");
	$data_humas = mysqli_fetch_assoc($humas);
	// cek apakah data yang di inputkan user sama dengan data di tabel admin
	if ($data_admin['username'] === $username) {
		// cek password
		if ($data_admin['password'] === $password) {
			// set $_SESSION
			$_SESSION["login_admin"] = true;
			header('location: admin/index.php');
			exit;
		}
	}
	// cek apakah data yang di inputkan user sama dengan data di tabel siswa
	else if ($data_siswa['username'] === $username) {
		// cek password
		if ($data_siswa['password'] === $password) {
			// set $_SESSION
			$id_siswa = $data_siswa['id_siswa'];
			$_SESSION["login_siswa"] = $id_siswa;
			header('location: siswa/index.php');
			exit;
		}
	}
	// cek apakah data yang di inputkan user sama dengan data di tabel humas
	else if ($data_humas['username'] === $username) {
		// cek password
		if ($data_humas['password'] === $password) {
			// set $_SESSION
			$id_siswa = $data_humas['id_humas'];
			$_SESSION["login_humas"] = $id_humas;

			header('location: humas/index.php');
			exit;
		}
	}
	$error = true;
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Halaman Login</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">  
	<link rel="stylesheet" type="text/css" href="css/login_fix.css">
</head>
<body>
	<div class="background">
		<img src="img/login.jpg">
	</div>
	<div class="container">
		<div class="logo">
			<p><i class="fas fa-user"></i></p>
		</div>
		<h1>Login</h1>
		<form action="" method="post">
			<label for="username">Username</label><br>
			<input type="text" id="username" name="username" required><br>
			<label for="password">Password</label><br>
			<input type="password" id="password" name="password" required><br>
			<input type="checkbox" name="remember" id="remember">
			<label for="remember">
				Remember Me
			</label>
			<p style="color: white; margin-bottom: 10px;">Account di siapkan oleh admin</p>
			<button type="submit" name="login">Log in</button>
			<?php if (isset($error)) : ?>
				<p style="color: red; text-align: center;">Username / password salah!</p>
			<?php endif; ?>
		</form>
	</div>
	<div class="homepage">
		<a href="index.php">Kembali ke Home Page</a>
	</div>
	<footer>
		<p>&copy; copyright 2021 made with <i class="fas fa-heart"></i> by FrandIvo.</p>
	</footer>
</body>
</html>