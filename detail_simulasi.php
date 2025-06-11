<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["admin"])) {
    // Redirect to login page or handle the situation when the user is not logged in
    header("Location: login.php");
    exit();
}

require_once 'autoload.php';
require_once 'database.php';

// Check if the required parameters are set
if (
    !isset($_GET['id'])
) {
    // Redirect or handle the situation when required parameters are not set
    header("Location: error.php");
    exit();
}

// Retrieve ID from the URL
$id = $_GET['id'];

// Use prepared statement to prevent SQL injection
$sql = "SELECT * FROM histories WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

// Check if a record with the specified ID exists
if ($result->num_rows > 0) {
    // Fetch data as an associative array
    $row = mysqli_fetch_assoc($result);

    $obj = new Bayes();

    // Use the retrieved data for further processing
    $jumTrue = $row['total_true'];
    $jumFalse = $row['total_false'];
    $jumData = $row['total_data'];

    $nama = $row["nama"];
    $a1 = $row['jenis_kelamin'];
    $a2 = $row['beasiswa'];
    $a3 = $row['ips_1'];
    $a4 = $row['ips_2'];
    $a5 = $row['ips_3'];
    $a6 = $row['ips_4'];
    $a7 = $row['ips_5'];
    $a8 = $row['ip_kumulatif'];

    //TRUE
    $jk = $row['true_jk'];
    $bea = $row['true_bea'];
    $ips1 = $row['true_ips1'];
    $ips2 = $row['true_ips2'];
    $ips3 = $row['true_ips3'];
    $ips4 = $row['true_ips4'];
    $ips5 = $row['true_ips5'];
    $ipk = $row['true_ipk'];

    //FALSE
    $jk2 = $row['false_jk'];
    $bea2 = $row['false_bea'];
    $ips1_2 = $row['false_ips1'];
    $ips2_2 = $row['false_ips2'];
    $ips3_2 = $row['false_ips3'];
    $ips4_2 = $row['false_ips4'];
    $ips5_2 = $row['false_ips5'];
    $ipk_2= $row['false_ipk'];

    //result
    // $paT = $obj->hasilTrue($jumTrue,$jumData,$jk,$bea,$ips1,$ips2,$ips3,$ips4,$ips5,$ipk);
    // $paF = $obj->hasilFalse($jumTrue,$jumData,$jk2,$bea2,$ips1_2,$ips2_2,$ips3_2,$ips4_2,$ips5_2,$ipk_2);
    $paT = $obj->hasilTrue($row['total_true'],$row['total_data'],$row['true_jk'],$row['true_bea'],$row['true_ips1'],$row['true_ips2'],$row['true_ips3'],$row['true_ips4'],$row['true_ips5'],$row['true_ipk']);
    $paF = $obj->hasilFalse($row['total_true'],$row['total_data'],$row['false_jk'],$row['false_bea'],$row['false_ips1'],$row['false_ips2'],$row['false_ips3'],$row['false_ips4'],$row['false_ips5'],$row['false_ipk']);



} else {
    // Redirect or handle the situation when no record is found
    header("Location: error.php");
    exit();
}

$stmt->close();
$conn->close();

if($a1 == "1"){
    $a1 = "Laki-laki";
    }else{
    $a1 = "Perempuan";
    }

    if($a2 == "1"){
    $a2 = "Ya";
    }else{
    $a2 = "Tidak";
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

  <title>Detail Dari <?php echo"$nama" ?> </title>
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
            <a class="nav-link" href="indexadmin.php">Naive Bayes
                  <span class="sr-only">(current)</span>
                </a>
          </li>
          <a href="logout.php" class="btn btn-danger">Logout</a>
        </ul>
      </div>
    </div>
  </nav>

    
    <div class="container" style='margin-top:90px'>
        <div class='jumbotron jumbotron-fluid' id='hslPrekdiksinya'>
            <!-- <div class="text-center">
                <a href="indexadmin.php" class="btn btn-secondary my-2">Kembali</a>
            </div> -->
            <h1 class='display-4 tebal px-3'>Hasil Prediksi <?php echo"$nama"?></h1>
            <p class='lead px-3'>Berikut ini adalah hasil prediksi kelulusan tepat waktu berdasarkan data mahasiswa menggunakan metode naive bayes.</p>
       
        </div>

        <?php echo "
        <div class='card' style='width: 25rem;'>
            <div class='card-header' style='background-color:#17a2b8;color:#fff'>
                <b>Informasi Mahasiswa</b>
            </div>
            <ul class='list-group list-group-flush'>
            <li class='list-group-item'>User : &nbsp;&nbsp;<b>$nama</b></li>
            <li class='list-group-item'>Jenis Kelamin : &nbsp;&nbsp;<b>$a1</b></li>
            <li class='list-group-item'>Beasiswa : &nbsp;&nbsp;<b>$a2</b></li>
            <li class='list-group-item'>IP Semester 1 : &nbsp;&nbsp;<b>$a3</b></li>
            <li class='list-group-item'>IP Semester 2 : &nbsp;&nbsp;<b>$a4</b></li>
            <li class='list-group-item'>IP Semester 3 : &nbsp;&nbsp;<b>$a5</b></li>
            <li class='list-group-item'>IP Semester 4 : &nbsp;&nbsp;<b>$a6</b></li>
            <li class='list-group-item'>IP Semester 5 : &nbsp;&nbsp;<b>$a7</b></li>
            <li class='list-group-item'>IP Kumulatif : &nbsp;&nbsp;<b>$a8</b></li>
            </ul>
        </div>
        ";
        ?>
    <br>
    <hr>

    <table class='table table-bordered' style='font-size:18px;text-align:center'>
        <tr style='background-color:#17a2b8;color:#fff'>
            <th>Jumlah True</th>
            <th>Jumlah False</th>
            <th>Jumlah Total Data</th>
        </tr>
        <tr>
        <?php echo"
            <td>$jumTrue</td>
            <td>$jumFalse</td>
            <td>$jumData</td>
        "; ?>
        </tr>
    </table>

    <br>
    <?php echo "
        <table class='table table-bordered' style='font-size:18px;text-align:center'>
        <tr style='background-color:#17a2b8;color:#fff'>
            <th></th>
            <th>True</th>
            <th>False</th>
        </tr>
        <tr>
            <td>pA</td>
            <td>$jumTrue / $jumData</td>
            <td>$jumFalse / $jumData</td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>$jk / $jumTrue</td>
            <td>$jk2 / $jumFalse</td>
        </tr>
        <tr>
            <td>Beasiswa</td>
            <td>$bea / $jumTrue</td>
            <td>$bea2 / $jumFalse</td>
        </tr>
        <tr>
            <td>IP Semester 1</td>
            <td>$ips1 / $jumTrue</td>
            <td>$ips1_2 / $jumFalse</td>
        </tr>
        <tr>
            <td>IP Semester 2</td>
            <td>$ips2 / $jumTrue</td>
            <td>$ips2_2 / $jumFalse</td>
        </tr>
        <tr>
            <td>IP Semester 3</td>
            <td>$ips3 / $jumTrue</td>
            <td>$ips3_2 / $jumFalse</td>
        </tr>
        <tr>
            <td>IP Semester 4</td>
            <td>$ips4 / $jumTrue</td>
            <td>$ips4_2 / $jumFalse</td>
        </tr>
        <tr>
            <td>IP Semester 5</td>
            <td>$ips5 / $jumTrue</td>
            <td>$ips5_2 / $jumFalse</td>
        </tr>
        <tr>
            <td>IP Kumulatif</td>
            <td>$ipk / $jumTrue</td>
            <td>$ipk_2 / $jumFalse</td>
        </tr>
        </table>
    "; ?>
    <br>

    <table class='table table-bordered' style='font-size:18px;text-align:center;'>
        <tr style='background-color:#17a2b8;color:#fff'>
            <th>Presentasi Lulus Tepat Waktu</th>
            <th>Presentasi Tidak Lulus Tepat Waktu</th>
        </tr>
        <tr>
        <?php echo"
            <td>$paT</td>
            <td>$paF</td>
        "; ?>
        </tr>
    </table>

    <?php
        $result = $obj->perbandingan($paT,$paF);

        if($paT > $paF){
            echo "<br>
            <h3 class='tebal'>PRESENTASI <span class='badge badge-success' style='padding:10px'><b>LULUS TEPAT WAKTU</b></span> LEBIH BESAR DARI PADA PRESENTASI TIDAK LULUS TEPAT WAKTU</h3><br>";
            echo "<h4><br>Presentasi lulus tepat waktu sebanyak : <b>".round($result[1],2)." %</b> <br>Presentasi tidak lulus tepat waktu sebanyak : <b>".round($result[2],2)." % </b></h4>";
            }else if($paF > $paT){
            echo "<br>
            <h3 class='tebal'>PRESENTASI <span class='badge badge-danger' style='padding:10px'><b>TIDAK LULUS TEPAT WAKTU</b></span> LEBIH BESAR DARI PADA PRESENTASI LULUS TEPAT WAKTU</h3><br>";
            echo "<h4><br>Presentasi tidak lulus tepat waktu sebanyak : <b>".round($result[1],2)." %</b> <br>Presentasi lulus tepat waktu sebanyak : <b>".round($result[2],2)." % </b></h4>";
            }
        
            if($result[0] == "LULUS TEPAT WAKTU"){
            echo "
            <div class='alert alert-success mt-5' role='aler'>
                <h4 class='alert-heading'>Kesimpulan : $result[0] </h4>
                <p>Selamat ! berdasarkan hasil prediksi , anda diprediksi <b>lulus tepat waktu!</b></p>
                <hr>
                <p class='mb-0'>- Have a nice day -</p>
            </div>";
            }else{
            echo"
            <div class='alert alert-danger mt-5' role='aler'>
            <h4 class='alert-heading'>Kesimpulan : $result[0] </h4>
            <p>Maaf, berdasarkan hasil prediksi , anda diprediksi <b>tidak lulus tepat waktu!</p>
            <hr>
            <p class='mb-0'>- Don't give up ! -</p>
            </div>";
            }
    ?>



    </div>

<!-- Footer -->
<footer class="page-footer font-small abu1">

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

<!-- validasi -->
<script>
  $(document).ready(function(){
    $('.toggle').click(function(){
      $('ul').toggleClass('active');
    });
  });
</script>

<script>
$(document).ready(function(){
  $('#dor').click(function(){
    $('html, body').animate({
        scrollTop: $("#hasilSIM").offset().top
    }, 500);
  });
});
</script>
</body>
</html>


