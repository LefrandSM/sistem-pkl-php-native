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
$data_siswa = query("SELECT * FROM siswa WHERE id_siswa = '$id_siswa'")[0];

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
  <link rel="stylesheet" type="text/css" href="../css/siswa/index.css">

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
            <a class="nav-link active" href="index.php">HOME<span class="sr-only"></span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="perusahaan.php">PERUSAHAAN<span class="sr-only"></span></a>
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

    <!-- slider --> 

   <div id="carouselExampleInterval" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active" data-interval="3000">
      <img src="../img/slider/1.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>SMK NEGERI 4 PAYAKUMBUH</h5>
        <p>Sekolah mencari kerja</p>
      </div>

    </div>
    <div class="carousel-item" data-interval="3000">
      <img src="../img/slider/2.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>DEVELOPER</h5>
        <p>Bagikan apa yang kamu punya</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="../img/slider/3.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>RANTI ERMINA SARI</h5>
        <p>Katakan SAYA BISA dan bertanggung jawab lah</p>
      </div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleInterval" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleInterval" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

    <!-- akhir slider -->

    <!-- isi -->


    <div class="row bagian-1">
      <div class="col-lg-4 text-center">
        <h4>APA ITU PKL ?</h4>
      </div>
      <div class="col-lg-8">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto provident a impedit vitae fugiat consequuntur officia quo, blanditiis eos molestiae atque debitis repellendus! Nostrum quod dolor dolorum perferendis rem, maxime voluptate beatae iure obcaecati excepturi, tempora molestiae laudantium quaerat quas praesentium minus. Ad non impedit quidem in ab enim suscipit illo. Aperiam dignissimos soluta odit vitae accusamus porro eligendi omnis, ex ratione at minima pariatur id nesciunt deserunt minus nihil eius aliquam cumque sapiente debitis ab. Facilis saepe cupiditate tempora animi molestias veritatis fugiat, voluptatum eveniet, aperiam omnis nulla excepturi aliquid sed possimus harum et suscipit. Repellendus corporis numquam voluptatem.</p>
      </div>
    </div>
    <div class="row bagian-2">
      <div class="col-lg-4 text-center">
        <h4>KAPAN SISWA PKL ?</h4>
      </div>
      <div class="col-lg-8">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
          tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
          quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
          consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
          cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
      </div>
    </div>
    <div class="row bagian-3">
      <div class="col-lg-4 text-center">
        <h5>KEMANA PKL ?</h5>
      </div>
      <div class="col-lg-8">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
          tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
          quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
          consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
          cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
      </div>
    </div>
    <!-- akhir isi -->




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