<?php 
// memulai session
session_start();
// cek apakah sudah ada session atau belum
if (!isset($_SESSION["login_admin"])) {
  header("location: ../login.php");
}
// menghubungkan ke file function.php
require '../../function/function.php';
// memanggil library excel reader
require_once '../../excel/vendor/autoload.php';


// cek apakah tombol tambah sudah di tekan
if (isset($_POST["import"])) {
    
// proses

  $nama_file = $_FILES['excel']['name'];
  $error = $_FILES['excel']['error'];
  $tmp_name = $_FILES['excel']['tmp_name'];

  // menentukan ekstensi file
  $ekstensi_file_valid = ['xlsx','xlx'];
  // mengambil ekstensi file
  $ekstensi_file = explode('.', $nama_file);
  $ekstensi_file = strtolower(end($ekstensi_file));

  // cek file yang di masukkan
  if ($error === 4) {
    echo "<script>
                alert('Tidak ada file yang di upload');
                document.location.href = '../../admin/siswa.php';
            </script>" ;
        return false;
  }
  if ( !in_array($ekstensi_file, $ekstensi_file_valid)) {
    echo "<script>
                alert('Yang anda upload bukan file Excel!');
                document.location.href = '../../admin/siswa.php';
            </script>" ;
        return false;
  }

  // generate nama file baru
  $nama_file_baru = "excel-";
  $nama_file_baru .= uniqid();
  $nama_file_baru .= ".";
  $nama_file_baru .= $ekstensi_file;

  // memindahkan file yang di upload ke direktori yang di inginkan
  move_uploaded_file($tmp_name, '../../excel/siswa/'.$nama_file_baru);

  $obj = PHPExcel_IOFactory::load('../../excel/siswa/'.$nama_file_baru);
  $all_data = $obj->getActiveSheet()->toArray(null, true, true, true);

  $query = "INSERT INTO siswa (id_siswa, nama_siswa, umur, jurusan_siswa, username, password, foto) VALUES";
  for ($i=3; $i < count($all_data); $i++) { 
    $nama_siswa = $all_data[$i]['A'];
    $umur = $all_data[$i]['B'];
    $jurusan_siswa = $all_data[$i]['C'];
    $username = $all_data[$i]['D'];
    $password = $all_data[$i]['E'];
    $query .= " ('', '$nama_siswa', '$umur', '$jurusan_siswa', '$username', '$password', NULL),";
  }
  $query = substr($query, 0, -1);

  mysqli_query($conn, $query);

  unlink('../../excel/siswa/'.$nama_file_baru);


    if ( mysqli_affected_rows($conn) > 0) {
        echo "<script>
                alert('File berhasil di import');
                document.location.href = '../../admin/siswa.php';
            </script>" ;
            exit;
    } else {
        echo "<script>
                alert('File gagal di import');
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
    <link rel="stylesheet" type="text/css" href="../../css/admin/excel_siswa.css">
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
            <a class="nav-link" href="../../admin/index.php">DASHBOARD <i class="fas fa-tachometer-alt"></i><span class="sr-only"></span>
        <li class="nav-item"></a>
        </li>
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
    <!-- judul -->
    <div class="judul">
      <i class="fab fa-user"></i><h2>Siswa</h2>
    </div>
    <!-- tambah data siswa input -->
    <div class="tambah-button">
      <a href="tambah_data_siswa.php" class="btn btn-primary mr-2">Tambah Siswa <i class="fas fa-user-plus"></i></a>
      <!-- tambah data siswa excel -->
      <a href="excel_siswa.php" class="btn btn-success">Import Excel <i class="fas fa-file-excel"></i></a>
      <!-- search -->
      <div class="search ml-auto"> 
        <a href="../../admin/siswa.php" class="btn btn-success"><i class="fas fa-chevron-left"></i> Kembali ke halaman siswa</a>
      </div>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group mb-3">
                    <label for="excel">Excel</label>
                    <input type="file" class="form-control" placeholder="Excel" id="excel" name="excel">
        </div>
        <button type="submit" class="form-control btn btn-primary" name="import">IMPORT</button>
    </form>
    <!-- akhir input -->
</div>
    <!-- footer -->
    <footer class="fixed-bottom">
           <p>&copy; copyright 2021 made with <i class="fas fa-heart"></i> by FrandIvo.</p>
    </footer>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>
</html>
