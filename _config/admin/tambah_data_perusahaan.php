<?php 
// memulai session
session_start();
// cek apakah sudah ada session atau belum
if (!isset($_SESSION["login_admin"])) {
  header("location: ../../login.php");
}
// menghubungkan ke file function.php
require '../../function/function.php';
// cek apakah tombol tambah sudah di tekan
if (isset($_POST["tambah"])) {
    // ambil data yang di inputkan di form 
    $nama_perusahaan = $_POST["nama_perusahaan"];
    $lokasi = $_POST["lokasi"];
    $jurusan_perusahaan = $_POST["jurusan_perusahaan"];
    $foto = $_POST["foto"];

    $query = "INSERT INTO perusahaan 
                VALUES
            ('', '$nama_perusahaan', '$lokasi', '$jurusan_perusahaan', '$foto')
            ";
    mysqli_query($conn, $query); 
    if (mysqli_affected_rows($conn) > 0) {
        echo "<script>
                alert('Data berhasil ditambahkan');
                document.location.href = '../../admin/perusahaan.php';
            </script>" ;
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
    <link rel="stylesheet" type="text/css" href="../../css/admin/tambah_data_perusahaan.css">
    <title>Hello, world!</title>
</head>
<body>
<div class="main">
    <!-- input -->
    <h1 class="text-center">Tambah Data Perusahaan</h1>
    <form action="" method="post">
        <div class="input-group mb-3">
            <table border="0">
                <tr>
                    <th>Nama</th>
                    <td>:</td>
                    <td><input type="text" class="form-control" placeholder="Nama" name="nama_perusahaan" required></td>
                </tr>
                <tr>
                    <th>Lokasi</th>
                    <td>:</td>
                    <td><input type="text" class="form-control" placeholder="Lokasi" name="lokasi" required></td>
                </tr>
                <tr>
                    <th>Jurusan</th>
                    <td>:</td>
                    <td><input type="checkbox" name="jurusan_perusahaan" value="mm"> Mm <br><input type="checkbox" name="jurusan_perusahaan" value="tkj"> Tkj <br><input type="checkbox" name="jurusan_perusahaan" value="rpl"> Rpl</td>
                </tr>
                <tr>
                    <th>Foto</th>
                    <td>:</td>
                    <td><input type="text" class="form-control" placeholder="Foto" name="foto"></td>
                </tr>
            </table>
        </div>
        <button type="submit" class="form-control btn btn-primary" name="tambah">TAMBAH DATA</button>
    </form>
    <!-- akhir input -->
    <div class="kembali">
        <a href="siswa.php" class="text-center">Kembali ke halaman siswa</a>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>
</html>