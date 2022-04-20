<?php 
// memulai session
session_start();
// cek apakah sudah ada session atau belum
if (!isset($_SESSION["login_admin"])) {
  header("location: ../login.php");
}
// menghubungkan ke file function.php
require '../../function/function.php';
// cek apakah tombol tambah sudah di tekan
if (isset($_POST["tambah"])) {

    if (tambah_siswa($_POST) > 0) {
        echo "<script>
        alert('Data berhasil ditambahkan');
        document.location.href = '../../admin/siswa.php';
        </script>" ;
        exit;
    } else {
        echo "<script>
        alert('Data gagal ditambahkan');
        document.location.href = '../../admin/siswa.php';
        </script>" ;
        exit;
    }
}


?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css"> 
    <!-- my css -->
    <link rel="stylesheet" type="text/css" href="../../css/admin/tambah_data_siswa.css">
    <title>Hello, world!</title>
</head>
<body>
    <!-- navigation -->
<nav class="navbar navbar-expand-lg navbar-dark">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
<div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <ul class="navbar-nav me-auto nav flex-column">
          <li class="nav-item">
            <h2><a class="nav-link active" href="#">ADMIN <i class="fas fa-user-cog"></i></a></h2>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../../admin/index.php">DASHBOARD <i class="fas fa-tachometer-alt"></i><span class="sr-only"></span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="../../admin/siswa.php">SISWA <i class="fas fa-user-graduate"></i><span class="sr-only"></span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../../admin/perusahaan.php">PERUSAHAAN <i class="fas fa-building"></i><span class="sr-only"></span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../../admin/humas.php">HUMAS <i class="fas fa-user"></i><span class="sr-only"></span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout <i class="fas fa-sign-out-alt"></i></a>
        </li>
    </ul>
</div>
</nav>
<div class="main">
    <!-- input -->
    <div class="judul">
      <i class="fab fa-user"></i><h2>Siswa</h2>
    </div>
    <!-- tambah data siswa input -->
    <div class="tambah-button">
      <a href="" class="btn btn-primary mr-2">Tambah Siswa <i class="fas fa-user-plus"></i></a>
      <!-- tambah data siswa excel -->
      <a href="excel_siswa.php" class="btn btn-success">Import Excel <i class="fas fa-file-excel"></i></a>
      <!-- search -->
      <div class="search ml-auto"> 
        <a href="../../admin/siswa.php" class="btn btn-success"><i class="fas fa-chevron-left"></i> Kembali ke halaman siswa</a>
      </div>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" placeholder="Nama" id="nama" name="nama_siswa" autocomplete="off" required>
        </div>
        <div class="form-group">
            <label for="umur">Umur</label>
            <input type="text" class="form-control" placeholder="Umur" id="umur" name="umur" autocomplete="off" required>
        </div>
        <select class="custom-select" name="jurusan_siswa">
          <option selected>-- Jurusan --</option>
          <option value="mm">Multimedia</option>
          <option value="rpl">Rekayasa Perangkat Lunak</option>
          <option value="tkj">Teknik Komputer Jaringan</option>
      </select>
      <div class="form-group">
          <label for="username">Username</label>
          <input type="text" class="form-control" placeholder="Username" id="username" name="username" autocomplete="off" required>
      </div>
      <div class="form-group">
          <label for="password">Password</label>
          <input type="text" class="form-control" placeholder="Password" value="123" id="password" name="password" autocomplete="off" required>
      </div>
      <div class="form-group">
          <label for="foto">Masukkan Foto..</label>
          <input type="file" class="form-control" placeholder="Foto" id="foto" name="foto">
      </div>
      <button type="submit" class="form-control btn btn-primary" name="tambah">TAMBAH DATA</button>
  </form>
</div>
<!-- akhir input -->
<!-- footer -->
<footer>
   <p>&copy; copyright 2021 made with <i class="fas fa-heart"></i> by FrandIvo.</p>
</footer>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>
</html>