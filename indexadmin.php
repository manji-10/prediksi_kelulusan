
<?php
session_start();

// Check session if not admin redirect
if (!isset($_SESSION["admin"])) {
  
    header("Location: login.php");
    exit;
} 

  $admin_id = $_SESSION["admin"]["id"];
  $admin_username = $_SESSION["admin"]["username"];
  $admin_full_name = $_SESSION["admin"]["full_name"];
  

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


  <title>Data Mining UNIMA</title>
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
          <li class="nav-item active">
            <a class="nav-link" href="indexadmin.php">Hasil Prediksi
                  <span class="sr-only">(current)</span>
                </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="data_simulasi.php">Data Latih</a>
          </li>
          <a href="logout.php" class="btn btn-danger">Logout</a>
        </ul>
      </div>
    </div>
  </nav>

    <div class="container" style='margin-top:90px'>
      <div class="row">
        <div class="col-12 mt-5">
        <h2 class="tebal">Selamat Datang Admin <?= $_SESSION['admin']['full_name']; ?></h2>
          <p class="desc mt-4">Naïve Bayes Classifier merupakan sebuah metoda klasifikasi yang berakar pada teorema Bayes.
          Metode pengklasifikasian dengan menggunakan metode probabilitas dan statistik yg dikemukakan oleh ilmuwan Inggris Thomas Bayes,
          yaitu memprediksi peluang di masa depan berdasarkan pengalaman di masa sebelumnya sehingga dikenal sebagai Teorema Bayes.
          Ciri utama dr Naïve Bayes Classifier ini adalah asumsi yang sangat kuat (naïf) akan independensi dari masing-masing kondisi / kejadian.
          Menurut Olson Delen (2008) menjelaskan Naïve Bayes untuk setiap kelas keputusan, menghitung probabilitas dg syarat bahwa kelas keputusan adalah benar,
          mengingat vektor informasi obyek. Algoritma ini mengasumsikan bahwa atribut obyek adalah independen.
          Probabilitas yang terlibat dalam memproduksi perkiraan akhir dihitung sebagai jumlah frekuensi dari " master " tabel keputusan.</p>
        
          <hr>
          <h3 class="text-center my-4"><strong>Daftar hasil prediksi</strong></h3>
          <table id="dataSimulasi" class="display pt-3 mb-3">
            <thead>
              <tr>
                <th>User</th>
                <th>Beasiswa</th>
                <th>IPS 1</th>
                <th>IPS 2</th>
                <th>IPS 3</th>
                <th>IPS 4</th>
                <th>IPS 5</th>
                <th>IPK</th>
                <th>Status Kelulusan</th>
              </tr>
            </thead>
            <tbody>
              <?php
              require_once "database.php";
              
              $sql = 'SELECT * FROM histories';
              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {

                    if($row['status'] == "TIDAK LULUS TEPAT WAKTU"){
                      $stt = "Tidak tepat waktu";
                    }else{
                     $stt = "Tepat Waktu";
                    }

                      echo "<tr>";
                        echo "<td>" . $row["nama"] . "</td>";
                        echo "<td>" . $row["beasiswa"] . "</td>";
                        echo "<td>" . $row["ips_1"] . "</td>";
                        echo "<td>" . $row["ips_2"] . "</td>";
                        echo "<td>" . $row["ips_3"] . "</td>";
                        echo "<td>" . $row["ips_4"] . "</td>";
                        echo "<td>" . $row["ips_5"] . "</td>";
                        echo "<td>" . $row["ip_kumulatif"] . "</td>";
                        echo "<td><a href='detail_simulasi.php?id=" . $row['id'] . "'>";
                          if ($stt == "Tepat Waktu") {
                              echo "<span class='badge badge-success' style='padding:10px'>Tepat waktu</span>";
                          } else {
                              echo "<span class='badge badge-danger' style='padding:10px'>Tidak tepat waktu</span>";
                          }
                        echo "</td></a>";
                      echo "</tr>";
                  }
              } else {
                  echo "<tr><td colspan='3'>No records found</td></tr>";
              }

              $conn->close();
              ?>
          </tbody>

        </table>

        
        </div>
      </div>
    </div>



<!-- --------------------------------------  -->
    <!-- <div class="row">
      <div class="col-12 d-flex justify-content-center">
        <div class="form-group">
            <input type="submit" value="Submit" class="btn btn-primary mt-3 px-7" id="dor" onclick="return simulasi()"/>
          </div>
        </form>
      </div>
    </div>
        
    <div class="row">
      <div class="col-12 mt-5 mb-5">
          <div id="hasilSIM" style="margin-bottom:30px;">

          </div>
      </div>
    </div>

    </div> -->
    
<!-- -------------------------------------------- -->

  


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
      </div>
      <!-- Grid column -->

    </div>
    <!-- Grid row-->

  </div>
  <!-- Footer Elements -->


  <!-- Copyright -->

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

<!--
<script>
  function simulasi()
  {
    var jenis_kelamin = $("#jkelamin").val();
    var beasiswa = $("#beas").val();
    var ips_1 = $("#ip_sem1").val();
    var ips_2 = $("#ip_sem2").val();
    var ips_3 = $("#ip_sem3").val();
    var ips_4 = $("#ip_sem4").val();
    var ips_5 = $("#ip_sem5").val();
    var ip_kumulatif = $("#ip_kum").val();

    //validasi
    var jk = document.getElementById("jkelamin");
    var bea = document.getElementById("beas");
    var ips1 = document.getElementById("ip_sem1");
    var ips2 = document.getElementById("ip_sem2");
    var ips3 = document.getElementById("ip_sem3");
    var ips4 = document.getElementById("ip_sem4");
    var ips5 = document.getElementById("ip_sem5");
    var ipk = document.getElementById("ip_kum");

    if(jk.selectedIndex == 0){
      alert("Jenis Kelamin Tidak Boleh Kosong");
      return false;
    }

    if(bea.selectedIndex == 0){
      alert("Beasiswa Tidak Boleh Kosong");
      return false;
    }

    if(ips1.selectedIndex == 0){
      alert("IP Semester 1 Tidak Boleh Kosong");
      return false;
    }

    if(ips2.selectedIndex == 0){
      alert("IP Semester 2 Tidak Boleh Kosong");
      return false;
    }

    if(ips3.selectedIndex == 0){
      alert("IP Semester 3 Tidak Boleh Kosong");
      return false;
    }

    if(ips4.selectedIndex == 0){
      alert("IP Semester 4 Tidak Boleh Kosong");
      return false;
    }

    if(ips5.selectedIndex == 0){
      alert("IP Semester 5 Tidak Boleh Kosong");
      return false;
    }

    if(ipk.selectedIndex == 0){
      alert("IP Kumulatif Tidak Boleh Kosong");
      return false;
    }

    //batas validasi

      $.ajax({
        url :'simulasi.php',
        type : 'POST',
        dataType : 'html',
        data : {jenis_kelamin : jenis_kelamin , beasiswa : beasiswa , ips_1 : ips_1 , ips_2 : ips_2 , ips_3 : ips_3, ips_4 : ips_4, 
                ips_5 : ips_5, ip_kumulatif : ip_kumulatif},
        success : function(data){
          document.getElementById("hasilSIM").innerHTML = data;
        },
      });

      return false;

  }
</script> 
-->


<!-- <script>
$(document).ready(function(){
  $('#dor').click(function(){
    $('html, body').animate({
        scrollTop: $("#hasilSIM").offset().top
    }, 500);
  });
});
</script> -->

<script>
  $(document).ready(function() {
      $('#dataSimulasi').dataTable({
        "pageLength" : 50
      });
  });
</script>


</body>
</html>
