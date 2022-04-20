<?php 
// memulai session
session_start();
// menghubungkan ke file function
require '../function/function.php';
// cek apakah sudah ada session atau belum
if (!isset($_SESSION["login_siswa"])) {
  header("location: ../login.php");
}
// mengambil id_siswa yang di kirim melalui $_SESSION
$id_siswa = $_SESSION['login_siswa'];
// melakukan query data berdasarkan di_siswa yang ada di variabel $id_siswa
$result_siswa = mysqli_query($conn, "SELECT * FROM siswa WHERE id_siswa = '$id_siswa'");
// memasukkan data table siswa ke dalam variabel $data_siswa
$data_siswa = mysqli_fetch_assoc($result_siswa);
// mengambil jurusan siswa untuk memilih perusahaan yang memiliki jurusan yang sama dengan siswa
$jurusan_siswa = $data_siswa['jurusan_siswa'];
// memakai function query yang ada di file function untuk mengambil data perusahaan berdasarkan jurusan siswa
$result_perusahaan = mysqli_query($conn, "SELECT * FROM perusahaan WHERE jurusan_perusahaan = '$jurusan_siswa'");
// cek apakah tombol pilih sudah di tekan
if (isset($_POST['submit'])) {
  // mengambil id_perusahaan yang ada di radio button
  $id_perusahaan = $_POST['id_perusahaan'];
  // mengupdate id_perusahaan di dalam table siswa, dan menimpanya dengan id_perusahaan yang di pilih
  mysqli_query($conn, "UPDATE siswa SET id_perusahaan = '$id_perusahaan' WHERE id_siswa = '$id_siswa'");
  if (mysqli_affected_rows($conn) > 0) {
    echo "
      <script>
        alert('Berhasil Memilih');
        document.location.href = 'profile.php';
      </script>
    ";
  } else {
    echo "
      <script>
        alert('Gagal Memilih');
      </script>
    ";
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">  
    <link rel="stylesheet" type="text/css" href="../css/siswa/perusahaan_fixed.css">

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
            <a class="nav-link active" href="perusahaan.php">PERUSAHAAN<span class="sr-only"></span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="profile.php">PROFILE <span class="sr-only"></span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="login" href="logout.php">LOGOUT <span class="sr-only"></span></a>
          </li>
      </ul>
      </div>
    </nav>

    <!-- akhir navbar -->

    <!-- card -->
    <div class="container" id="perusahaan">
    <!-- judul -->
    <h2 class="text-center p-4">Perusahaan Untuk Rekayasa Perangkat Lunak</h2>
    <!-- akhir judul -->

    <!-- penjelasan -->
    <div class="peraturan">
        <h2>Peraturan</h2>
        <ul>
          <li>> Pilihlah satu perusahaan</li>
          <li>> Pilihanmu merupakan pilihan sementara,karena pilihan akhir akan di tentukan sekolah</li>
        </ul>
    </div>
    <!-- akhir penjelasan -->

    <!-- card -->
        <form action="" method="post">
            <div class="row p-3">
              <?php $angka = 1; ?>
              <?php while( $data_perusahaan = mysqli_fetch_assoc($result_perusahaan) ) : ?>
                <div class="col-lg-4">
                    <div class="card shadow bg-white rounded">
                      <img src="../img/jumbotron.jpg" class="card-img-top">
                      <div class="card-body">
                        <h5 class="card-title"><?= $data_perusahaan['nama_perusahaan']; ?></h5>
                        <p class="card-text">
                          <table border="0">
                            <tr>
                              <th>Lokasi</th>
                              <td>:</td>
                              <td><?= $data_perusahaan['lokasi']; ?></td>
                            </tr>
                          </table>
                        </p>
                        <input type="radio" name="id_perusahaan" id="pilih<?php echo $angka; ?>" class="pilih" value="<?= $data_perusahaan['id_perusahaan']; ?>">
                        <label class="tombol-pilih" for="pilih<?php echo $angka; ?>">PILIH</label>
                        <a href=""></a>
                      </div>
                    </div>
                </div>
                <?php $angka++; ?>
                <?php endwhile; ?>
              </div>
          <div class="kirim">
            <button type="submit" class="btn btn-primary" name="submit">KIRIM PILIHAN</button>
          </div>
        </form>
    <!-- akhir card -->
</div>    
    <!-- footer -->

    <footer>
        <p>&copy; copyright 2021 made with <i class="fas fa-heart"></i> by FrandIvo.</p>
    </footer>

    <!-- akhir footer -->












    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
  </body>
</html>