<?php 
// memulai session
session_start();
// cek apakah sudah ada session atau belum
if (!isset($_SESSION["login_siswa"])) {
  header("location: ../login.php");
}

// megnhubungkan ke file function
require '../function/function.php';

$id_siswa = $_SESSION['login_siswa'];
$result_siswa = mysqli_query($conn, "SELECT * FROM siswa WHERE id_siswa = '$id_siswa'");
$result_perusahaan = mysqli_query($conn, "SELECT * FROM perusahaan");


$data_siswa = mysqli_fetch_assoc($result_siswa);
$data_perusahaan = mysqli_fetch_assoc($result_perusahaan);

$id_perusahaan_tb_siswa = $data_siswa['id_perusahaan'];

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
    <link rel="stylesheet" type="text/css" href="../css/siswa/profile_fix.css">

    <title>Hello, world!</title>
  </head>
  <body>
    

<div class="main">
    <!-- navbar -->
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
      <a class="navbar-brand">Welcome! <?= $data_siswa['nama_siswa']; ?> <i class="fas fa-smile-beam"></i></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php">HOME<span class="sr-only"></span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="perusahaan.php">PERUSAHAAN<span class="sr-only"></span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="profile.php">PROFILE <span class="sr-only"></span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="login" href="logout.php">LOGOUT <span class="sr-only"></span></a>
          </li>
      </ul>
      </div>
    </nav>

    <!-- akhir navbar -->

   <!-- profile -->

    <div class="data">
   <div class="container">
    <div class="judul">
      <h1 class="text-center mt-4">PROFILE</h1>
    </div>
    <div class="profile text-center">
      <div class="foto">
        <?php if ($data_siswa['foto'] == "NULL" ) : ?>
          <img src="../img/default/user.png">
        <?php else : ?>
          <img src="../img/siswa/<?= $data_siswa['foto']; ?>">
        <?php endif; ?>
          

      </div>
    </div>
        <table border="0">
          <tr>
            <th>Nama</th>
            <td>:</td>
            <td><?= $data_siswa['nama_siswa']; ?></td>
          </tr>
          <tr>
            <th>Umur</th>
            <td>:</td>
            <td><?= $data_siswa['umur']; ?></td>
          </tr>
          <tr>
            <th>Jurusan</th>
            <td>:</td>
            <td><?= $data_siswa['jurusan_siswa']; ?></td>
          </tr>
          <tr>
            <th>Perusahaan</th>
            <td>:</td>
            <td>
              <?php if( $data_siswa['id_perusahaan'] == "" ) {
                echo "<p>Belum ada pilihan</p>";
              } else {
                 $result_nama_perusahaan = mysqli_query($conn, "SELECT * FROM perusahaan WHERE id_perusahaan = '$id_perusahaan_tb_siswa'");
                 $nama_perusahaan = mysqli_fetch_assoc($result_nama_perusahaan);
                 echo $nama_perusahaan['nama_perusahaan'];

              } ?>
            </td>
          </tr>
        </table>
    </div>
   </div>

   <!-- akhir perusahaan -->


    <!-- footer -->

    <footer>
        <p>&copy; copyright 2021 made with <i class="fas fa-heart"></i> by FrandIvo.</p>
    </footer>

    <!-- akhir footer -->

</div>    












    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
  </body>
</html>