<?php 
// memulai session
session_start();
// cek apakah sudah ada session atau belum
if (!isset($_SESSION["login_admin"])) {
  header("location: ../login.php");
}
// menghubungkan ke file function.php
require '../../function/function.php';
// ambil data di URL
$id_siswa_url = $_GET['id_siswa'];
// query data berdasarkan id
$siswa = query("SELECT * FROM siswa WHERE id_siswa = $id_siswa_url")[0];
// cek apakah tombol edit sudah di tekan
if (isset($_POST["edit"])) {

    if (edit_data_siswa($_POST) > 0) {
        echo "<script>
                alert('Data berhasil di ubah');
                document.location.href = '../../admin/siswa.php';
            </script>" ;
            exit;
    } else {
        echo "<script>
                alert('Data gagal di ubah');
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
    <link rel="stylesheet" type="text/css" href="../../css/admin/edit_data_siswa.css">
    <title>Hello, world!</title>
</head>
<body>
    <!-- navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <ul class="navbar-nav ml-auto nav flex-column">
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
    <div class="header">
        <h2 class="judul">Edit Data Siswa</h2>
        <a href="../../admin/siswa.php" class="btn btn-success"><i class="fas fa-chevron-left"></i> Kembali ke halaman siswa</a>
    </div>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_siswa" value="<?= $siswa['id_siswa']; ?>">
        <input type="hidden" name="foto_lama" value="<?= $siswa['foto']; ?>">
        <div class="input-group mb-3">
            <table border="0">
                <tr>
                    <th>Nama</th>
                    <td>:</td>
                    <td><input type="text" class="form-control" placeholder="Nama" name="nama_siswa" value="<?= $siswa['nama_siswa']; ?>" required></td>
                </tr>
                <tr>
                    <th>Umur</th>
                    <td>:</td>
                    <td><input type="text" class="form-control" placeholder="Umur" name="umur" value="<?= $siswa['umur']; ?>" required></td>
                </tr>
                <tr>
                    <th>Jurusan</th>
                    <td>:</td>
                    <td>
                    <!-- kondisi checked jurusan mm -->
                    <?php if ($siswa['jurusan_siswa'] == 'mm'): ?>
                        <input type="radio" name="jurusan_siswa" value="mm" checked> Mm <br>
                    <?php else : ?>
                        <input type="radio" name="jurusan_siswa" value="mm"> Mm <br>
                    <?php endif ?>
                    <!-- kondisi checked jurusan tkj -->
                    <?php if ($siswa['jurusan_siswa'] == 'tkj'): ?>
                        <input type="radio" name="jurusan_siswa" value="tkj" checked> tkj <br>
                    <?php else : ?>
                        <input type="radio" name="jurusan_siswa" value="tkj"> tkj <br>
                    <?php endif ?>
                    <!-- kondisi checked jurusan rpl -->
                    <?php if ($siswa['jurusan_siswa'] == 'rpl'): ?>
                        <input type="radio" name="jurusan_siswa" value="rpl" checked> rpl <br>
                    <?php else : ?>
                        <input type="radio" name="jurusan_siswa" value="rpl"> rpl <br>
                    <?php endif ?>
                        
                    </td>
                </tr>
                <tr>
                    <th>Username</th>
                    <td>:</td>
                    <td><input type="text" class="form-control" placeholder="Username" name="username" value="<?= $siswa['username']; ?>" required></td>
                </tr>
                <tr>
                    <th>Password</th>
                    <td>:</td>
                    <td><input type="text" class="form-control" placeholder="Password" value="123" name="password" value="<?= $siswa['password']; ?>" required></td>
                </tr>
                <tr>
                    <th>Foto</th>
                    <td>:</td>
                    <td>
                    <img src="../../img/siswa/<?= $siswa['foto']; ?>" width="100">
                    <input type="file" class="form-control" placeholder="Foto" name="foto"></td>
                </tr>
            </table>
        </div>
        <button type="submit" class="form-control btn btn-primary" name="edit">EDIT DATA</button>
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