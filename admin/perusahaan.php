<?php
// memulai session
session_start();
// cek apakah sudah ada session atau belum
if (!isset($_SESSION["login_admin"])) {
  header("location: ../login.php");
}
// menghubungkan ke halaman function
require '../function/function.php';

$perusahaan = query("SELECT * FROM perusahaan");


?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css"> 
    <link rel="stylesheet" type="text/css" href="../css/admin/perusahaan.css">

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
            <a class="nav-link" href="index.php">DASHBOARD <i class="fas fa-tachometer-alt"></i><span class="sr-only"></span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="siswa.php">SISWA <i class="fas fa-user-graduate"></i><span class="sr-only"></span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="perusahaan.php">PERUSAHAAN <i class="fas fa-building"></i><span class="sr-only"></span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="humas.php">HUMAS <i class="fas fa-user"></i><span class="sr-only"></span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../_config/admin/logout.php">Logout <i class="fas fa-sign-out-alt"></i></a>
          </li>
        </ul>
       </div>
    </nav>

    <!-- judul -->
    <div class="data">
      <div class="judul">
        <i class="fab fa-user"></i><h2>Perusahaan</h2>
      </div>

      <!-- akhir judul -->

      <!-- form -->

        <!-- tambah data siswa input -->
      <div class="tambah-button">
        <a href="../_config/admin/tambah_data_siswa.php" class="btn btn-primary mr-2">Tambah Perusahaan <i class="fas fa-building"></i></a>
        <!-- tambah data siswa excel -->
        <a href="../_config/admin/tambah_data_siswa.php" class="btn btn-success">Tambah Excel <i class="fas fa-file-excel"></i></a>
      <!-- search -->
        <div class="search ml-auto">
          <form class="form-inline me-auto">
            <div class="form-group mx-sm-3 mb-2">
              <label for="search" class="sr-only">Search</label>
              <input type="text" class="form-control" id="search" placeholder="Search">
            </div>
            <button type="submit" class="btn btn-primary mb-2"><i class="fas fa-search"></i></button>
          </form>
        </div>
      </div>

      <!-- form -->

      <!-- table -->
      <table class="table table-bordered">
        <thead class="thead-dark">
          <tr>
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">Lokasi</th>
            <th scope="col">Jurusan</th>
            <th scope="col">Foto</th>
            <th scope="col">Edit</th>
          </tr>
        </thead>
        <!-- pengulangan data -->
        <?php $nomor_perusahaan = 1; ?>
        <?php foreach ($perusahaan as $prsh) : ?>
        <tbody>
          <tr>
            <th scope="row"><?= $nomor_perusahaan; $nomor_perusahaan++; ?></th>
            <td><?= $prsh["nama_perusahaan"] ?></td>
            <td><?= $prsh["lokasi"] ?></td>
            <td><?= $prsh["jurusan_perusahaan"] ?></td>
            <td><img src="../img/perusahaan/<?= $prsh["foto"] ?>"></td>
            <td><a href="#" class="btn btn-success">EDIT</a><a href="#" class="btn btn-danger">HAPUS</a></td>
          </tr>
          </tbody>
        <?php endforeach; ?>
      </table>
    </div>

    <!-- akhir table -->

    <!-- footer -->
    <footer>
           <p>&copy; copyright 2021 made with <i class="fas fa-heart"></i> by FrandIvo.</p>
    </footer>




    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

  </body>
</html>