<?php

session_start();
if (!isset($_SESSION["admin"])) {
   header("Location: login.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="icon" type="image/x-icon" href="img/LOGO UNIMA.png" />

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css" />

  <!-- font awsome -->
  <link rel="stylesheet" href="css/fontawesome.css" />
  <link rel="stylesheet" href="css/brands.css" />
  <link rel="stylesheet" href="css/solid.css" />

  <link rel="stylesheet" href="css/gaya.css">

  <!-- google font -->
  <link href="https://fonts.googleapis.com/css?family=Lato:400,700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="css/datatables.css">

  <title>Data Training</title>
</head>
<body>

<nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light static-top">
    <div class="container">
      <a class="navbar-brand" href="indexadmin.php">
            <img src="img/LOGO UNIMA.png" alt="" width=60 height=60>
          </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="indexadmin.php">Hasil Prediksi</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="data_simulasi.php">Data Latih <span class="sr-only">(current)</span></a>
          </li>
          <a href="logout.php" class="btn btn-danger">Logout</a>
        </ul>
      </div>
    </div>
  </nav>

<div class="container" style='margin-top:90px'>
  <div class="row">
    <div class="col-12 mt-5">
      <h2 class="tebal">List Data Latih</h2><br>
      <p class="desc">Berikut ini adalah data latih yang digunakan untuk menghitung probabilitas kelulusan mahasiswa UNIMA menggunakan metode naive bayes. Data latih ini diambil dari Pusat Komputer Universitas Negeri Manado dengan menggunakan data mahasiswa yang lulus tahun ajaran 2022/2023.</p><br>

        <table id="dataLatih" class="display pt-3 mb-3">
          <thead>
            <tr>
              <th>No</th>
              <th>Jenis Kelamin</th>
              <th>Beasiswa</th>
              <th>IPS1</th>
              <th>IPS2</th>
              <th>IPS3</th>
              <th>IPS4</th>
              <th>IPS5</th>
              <th>IPS6</th>
              <th>IPS7</th>
              <th>IPS8</th>
              <th>IPK</th>
              <th>Status Kelulusan</th>
            </tr>
          </thead>
          <tbody>
          <?php
            $data = 'data.json';
            $json = file_get_contents($data);
            $hasil = json_decode($json,true);

            $no = 1;
            foreach ($hasil as $hasil) {

              if($hasil['status_kelulusan'] == 1){
                $stt = "Tepat waktu";
              }else{
                $stt = "Tidak tepat waktu";
              }

              if($hasil['jenis_kelamin'] == 1){
                $jk = "Laki-laki";
              }else{
                $jk = "Perempuan";
              }
              
              if($hasil['beasiswa'] == 1){
                $bea = "Ya";
              }else{
                $bea = "Tidak";
              }
          ?>

            <tr>
              <td><?php echo $no; ?></td>
              <td><?php echo $jk ?></td>
              <td><?php echo $bea; ?></td>
              <td><?php echo $hasil['ips_1']; ?></td>
              <td><?php echo $hasil['ips_2']; ?></td>
              <td><?php echo $hasil['ips_3']; ?></td>
              <td><?php echo $hasil['ips_4']; ?></td>
              <td><?php echo $hasil['ips_5']; ?></td>
              <td><?php echo $hasil['ips_6']; ?></td>
              <td><?php echo $hasil['ips_7']; ?></td>
              <td><?php echo $hasil['ips_8']; ?></td>
              <td><?php echo $hasil['ip_kumulatif']; ?></td>
              <td><?php 
              if($stt == "Tepat waktu"){
                echo "<span class='badge badge-success' style='padding:10px'>Tepat waktu</span>";
              }else{
                echo "<span class='badge badge-danger' style='padding:10px'>Tidak tepat waktu</span>";
              }
              ?></td>
            </tr>

          <?php
          $no++;
          }
          ?>
          </tbody>
        </table>
    </div>
  </div>

</div>

<!-- Footer -->
<footer class="page-footer font-small abu1 mt-5">

  <!-- Footer Elements -->
  <div class="container">

    <!-- Grid row-->
    <div class="row">

      <!-- Grid column -->
      <div class="col-md-12 py-5">
        <div class="mb-5 d-flex justify-content-center">
      </div>
      <!-- Grid column -->

    </div>
    <!-- Grid row-->

  </div>
</footer>
<!-- Footer -->


<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="js/jquery.js"></script>
<script src="jspopper.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<script type="text/javascript" src="js/datatables.js"></script>

<!-- validasi -->
<script>
  $(document).ready(function(){
    $('.toggle').click(function(){
      $('ul').toggleClass('active');
    });
  });
</script>

<script>
  $(document).ready(function() {
      $('#dataLatih').dataTable({
        "pageLength" : 50
      });
  });
</script>

</body>
</html>
