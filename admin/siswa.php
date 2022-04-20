<?php
// memulai session
session_start();
// cek apakah sudah ada session atau belum
if (!isset($_SESSION["login_admin"])) {
  header("location: ../login.php");
  exit;
}
// menghubungkan ke file function
require '../function/function.php';

// konfigurasi pagination
$jumlah_data_perhalaman = 20;
$jumlah_seluruh_data = count(query("SELECT * FROM siswa"));
$jumlah_halaman = ceil($jumlah_seluruh_data / $jumlah_data_perhalaman);
$halaman_aktif = ( isset($_GET['halaman']) ) ? $_GET['halaman'] : 1;
$awal_data = ($jumlah_data_perhalaman * $halaman_aktif) - $jumlah_data_perhalaman;

// query data table siswa
$data_siswa = query("SELECT * FROM siswa LIMIT $awal_data, $jumlah_data_perhalaman"); 

// cek apakah tombol cari sudah di klik atau belum
if (isset($_POST['cari'])) {
  $data_siswa = cari($_POST['keyword']);
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
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css"> 
  <link rel="stylesheet" type="text/css" href="../css/admin/siswa.css">
  <!-- title -->
  <title>Table Data Siswa</title>
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
          <a class="nav-link active" href="siswa.php">SISWA <i class="fas fa-user-graduate"></i><span class="sr-only"></span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="perusahaan.php">PERUSAHAAN <i class="fas fa-building"></i><span class="sr-only"></span></a>
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
  <div class="data">
  <!-- judul -->
    <div class="judul">
      <i class="fab fa-user"></i><h2>Siswa</h2>
    </div>
    <!-- tambah data siswa input -->
    <div class="tambah-button">
      <a href="../_config/admin/tambah_data_siswa.php" class="btn btn-primary mr-2">Tambah Siswa <i class="fas fa-user-plus"></i></a>
      <!-- tambah data siswa excel -->
      <a href="../_config/admin/excel_siswa.php" class="btn btn-success">Import Excel <i class="fas fa-file-excel"></i></a>
      <!-- search -->
      <div class="search ml-auto">
        <form action="" method="post" class="form-inline me-auto">
          <div class="form-group mx-sm-3 mb-2">
            <label for="search" class="sr-only">Search</label>
            <input type="text" class="form-control" id="search" placeholder="Search" name="keyword" autocomplete="off">
          </div>
          <button type="submit" class="btn btn-primary mb-2" name="cari"><i class="fas fa-search"></i></button>
        </form>
      </div>
      </div>

    <!-- form -->

    <!-- table -->
    <div class="table-responsive">
      <table class="table table-bordered">
        <thead class="thead-dark">
          <tr>
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">Umur</th>
            <th scope="col">Jurusan</th>
            <th scope="col">Perusahaan</th>
            <th scope="col">Username</th>
            <th scope="col">Foto</th>
            <th scope="col">Edit</th>
          </tr>
        </thead>
        <?php if (isset($data_siswa)) : ?>
          <?php $nomor_siswa = 1; ?>
          <?php foreach ( $data_siswa as $ssw ) : ?>
            <tbody>
              <tr>
                <th scope="row"><?= $nomor_siswa; $nomor_siswa++; ?></th>
                <td><?= $ssw["nama_siswa"] ?></td>
                <td><?= $ssw["umur"] ?></td>
                <td><?= $ssw["jurusan_siswa"] ?></td>
                <td><?php
                      // query data table perusahaan
                $id_perusahaan_siswa = $ssw['id_perusahaan'];
                $data_perusahaan = mysqli_query($conn, "SELECT * FROM perusahaan WHERE id_perusahaan = '$id_perusahaan_siswa'");
                $id_perusahaan = mysqli_fetch_assoc($data_perusahaan);
                if (!isset($ssw['id_perusahaan'])) {
                  ?>
                  <p style="color: red;">Belum memilih</p>
                <?php } else {
                  echo $id_perusahaan['nama_perusahaan'];
                }
                ?></td>
                <td><?= $ssw["username"] ?></td>
                <td><img width="100px" height="100px" src="../img/siswa/<?= $ssw['foto'] ?>"></td>
                <td><a href="../_config/admin/edit_data_siswa.php?id_siswa=<?= $ssw['id_siswa']; ?>" class="btn btn-success">EDIT</a><br><a href="../_config/admin/delete_siswa.php?id_siswa=<?= $ssw['id_siswa']; ?>" class="btn btn-danger">HAPUS</a></td>
              </tr>
            </tbody>
          <?php endforeach; ?>
        <?php endif; ?>
        <?php if(!isset($data_siswa)) {
          echo "<tr>
          <td colspan='8' align='center'><b>TIDAK ADA DATA</b></td>
          </tr>";
        } ?>
      </table>
    </div>
    <!-- akhir table -->
    <!-- navigation pagination -->
    <nav aria-label="Page navigation example">
      <ul class="pagination">
        <?php if( $halaman_aktif > 1 ) : ?>
          <li class="page-item"><a class="page-link" href="?halaman=<?= $halaman_aktif - 1; ?>">Previous</a></li>
          <?php else : ?>
            <li class="page-item"><a class="page-link" href="">Previous</a></li>
          <?php endif; ?>
          <?php for( $i = 1; $i <= $jumlah_halaman; $i++ ) : ?>
            <?php if($i == $halaman_aktif) : ?>
              <li class="page-item active"><a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a></li>
              <?php else : ?>
                <li class="page-item"><a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a></li>
              <?php endif; ?>
            <?php endfor; ?>
            <?php if( $halaman_aktif < $jumlah_halaman ) : ?>
              <li class="page-item"><a class="page-link" href="?halaman=<?= $halaman_aktif + 1; ?>">Next</a></li>
              <?php else : ?>
                <li class="page-item"><a class="page-link" href="">Next</a></li>
              <?php endif; ?>

            </ul>
          </nav>
        </div>

        <!-- footer -->
        <footer>
         <p>&copy; copyright 2021 made with <i class="fas fa-heart"></i> by FrandIvo.</p>
       </footer>




       <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

     </body>
     </html>