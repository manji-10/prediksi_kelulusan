<?php
session_start();

// Check if not user
if (!isset($_SESSION["user"])) {
    // Redirect to login 
    header("Location: login.php");
    exit();
}



require_once 'autoload.php';

require_once 'database.php';

$obj = new Bayes();

$jumTrue = $obj->sumTrue();
$jumFalse = $obj->sumFalse();
$jumData = $obj->sumData();

$nama = $_SESSION["user"]["full_name"];
$a1 = $_POST['jenis_kelamin'];
$a2 = $_POST['beasiswa'];
// $a3 = $_POST['ips_1'];
// $a4 = $_POST['ips_2'];
// $a5 = $_POST['ips_3'];
// $a6 = $_POST['ips_4'];
// $a7 = $_POST['ips_5'];
// $a8 = $_POST['ip_kumulatif'];

// IPS 1
  if ($_POST['ips_1'] > 4) {
    echo "<p style='color:red;'>Error: IP Semester 1 tidak valid</p>";
    return false;
  } elseif ($_POST['ips_1'] > 3.5) {
    $a3 = "A";
  } elseif ($_POST['ips_1'] >= 3 && $_POST['ips_1'] <= 3.5) {
    $a3 = "B";
  } elseif ($_POST['ips_1'] >= 2.5 && $_POST['ips_1'] < 3) {
    $a3 = "C";
  } elseif ($_POST['ips_1'] >= 2 && $_POST['ips_1'] < 2.5) {
    $a3 = "D";
  } elseif ($_POST['ips_1'] < 2) {
    $a3 = "E";
  }

// IPS 2
  if ($_POST['ips_2'] > 4) {
    echo "<p style='color:red;'>Error: IP Semester 2 tidak valid</p>";
    return false;
  } elseif ($_POST['ips_2'] > 3.5) {
    $a4 = "A";
  } elseif ($_POST['ips_2'] >= 3 && $_POST['ips_2'] <= 3.5) {
    $a4 = "B";
  } elseif ($_POST['ips_2'] >= 2.5 && $_POST['ips_2'] < 3) {
    $a4 = "C";
  } elseif ($_POST['ips_2'] >= 2 && $_POST['ips_2'] < 2.5) {
    $a4 = "D";
  } elseif ($_POST['ips_2'] < 2) {
    $a4 = "E";
  }

// IPS 3
  if ($_POST['ips_3'] > 4) {
    echo "<p style='color:red;'>Error: IP Semester 3 tidak valid</p>";
    return false;
  } elseif ($_POST['ips_3'] > 3.5) {
    $a5 = "A";
  } elseif ($_POST['ips_3'] >= 3 && $_POST['ips_3'] <= 3.5) {
    $a5 = "B";
  } elseif ($_POST['ips_3'] >= 2.5 && $_POST['ips_3'] < 3) {
    $a5 = "C";
  } elseif ($_POST['ips_3'] >= 2 && $_POST['ips_3'] < 2.5) {
    $a5 = "D";
  } elseif ($_POST['ips_3'] < 2) {
    $a5 = "E";
  }

// IPS 4
  if ($_POST['ips_4'] > 4) {
    echo "<p style='color:red;'>Error: IP Semester 4 tidak valid</p>";
    return false;
  } elseif ($_POST['ips_4'] > 3.5) {
    $a6 = "A";
  } elseif ($_POST['ips_4'] >= 3 && $_POST['ips_4'] <= 3.5) {
    $a6 = "B";
  } elseif ($_POST['ips_4'] >= 2.5 && $_POST['ips_4'] < 3) {
    $a6 = "C";
  } elseif ($_POST['ips_4'] >= 2 && $_POST['ips_4'] < 2.5) {
    $a6 = "D";
  } elseif ($_POST['ips_4'] < 2) {
    $a6 = "E";
  }

// IPS 5
  if ($_POST['ips_5'] > 4) {
    echo "<p style='color:red;'>Error: IP Semester 4 tidak valid</p>";
    return false;
  } elseif ($_POST['ips_5'] > 3.5) {
    $a7 = "A";
  } elseif ($_POST['ips_5'] >= 3 && $_POST['ips_5'] <= 3.5) {
    $a7 = "B";
  } elseif ($_POST['ips_5'] >= 2.5 && $_POST['ips_5'] < 3) {
    $a7 = "C";
  } elseif ($_POST['ips_5'] >= 2 && $_POST['ips_5'] < 2.5) {
    $a7 = "D";
  } elseif ($_POST['ips_5'] < 2) {
    $a7 = "E";
  }

// IP Kumulatif
  if ($_POST['ip_kumulatif'] > 4) {
    echo "<p style='color:red;'>Error: IP Semester 4 tidak valid</p>";
    return false;
  } elseif ($_POST['ip_kumulatif'] > 3.5) {
    $a8 = "A";
  } elseif ($_POST['ip_kumulatif'] >= 3 && $_POST['ip_kumulatif'] <= 3.5) {
    $a8 = "B";
  } elseif ($_POST['ip_kumulatif'] >= 2.5 && $_POST['ip_kumulatif'] < 3) {
    $a8 = "C";
  } elseif ($_POST['ip_kumulatif'] >= 2 && $_POST['ip_kumulatif'] < 2.5) {
    $a8 = "D";
  } elseif ($_POST['ip_kumulatif'] < 2) {
    $a8 = "E";
  }
  

//TRUE
$jk = $obj->probJenisKelamin($a1,1);
$bea = $obj->probBeasiswa($a2,1);
$ips1 = $obj->probIPS1($a3,1);
$ips2 = $obj->probIPS2($a4,1);
$ips3 = $obj->probIPS3($a5,1);
$ips4 = $obj->probIPS4($a6,1);
$ips5 = $obj->probIPS5($a7,1);
$ipk = $obj->probIPK($a8,1);

//FALSE
$jk2 = $obj->probJenisKelamin($a1,0);
$bea2 = $obj->probBeasiswa($a2,0);
$ips1_2 = $obj->probIPS1($a3,0);
$ips2_2 = $obj->probIPS2($a4,0);
$ips3_2 = $obj->probIPS3($a5,0);
$ips4_2 = $obj->probIPS4($a6,0);
$ips5_2 = $obj->probIPS5($a7,0);
$ipk_2= $obj->probIPK($a8,0);

//result
$paT = $obj->hasilTrue($jumTrue,$jumData,$jk,$bea,$ips1,$ips2,$ips3,$ips4,$ips5,$ipk);
$paF = $obj->hasilFalse($jumTrue,$jumData,$jk2,$bea2,$ips1_2,$ips2_2,$ips3_2,$ips4_2,$ips5_2,$ipk_2);

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
echo "
<div class='jumbotron jumbotron-fluid' id='hslPrekdiksinya'>
  <div class='container'>
    <h1 class='display-4 tebal'>Hasil Prediksi</h1>
    <p class='lead'>Berikut ini adalah hasil prediksi kelulusan tepat waktu berdasarkan data mahasiswa menggunakan metode naive bayes.</p>
  </div>
</div>
";

echo "
<div class='card' style='width: 25rem;'>
  <div class='card-header' style='background-color:#17a2b8;color:#fff'>
    <b>Informasi Mahasiswa</b>
  </div>
  <ul class='list-group list-group-flush'>
  <li class='list-group-item'>Jenis Kelamin : &nbsp;&nbsp;<b>$a1</b></li>
  <li class='list-group-item'>Beasiswa : &nbsp;&nbsp;<b>$a2</b></li>
  <li class='list-group-item'>IP Semester 1 : &nbsp;&nbsp;<b>$a3</b></li>
  <li class='list-group-item'>IP Semester 2 : &nbsp;&nbsp;<b>$a4</b></li>
  <li class='list-group-item'>IP Semester 3 : &nbsp;&nbsp;<b>$a5</b></li>
  <li class='list-group-item'>IP Semester 4 : &nbsp;&nbsp;<b>$a6</b></li>
  <li class='list-group-item'>IP Semester 5 : &nbsp;&nbsp;<b>$a7</b></li>
  <li class='list-group-item'>IP Kumulatif : &nbsp;&nbsp;<b>$a8</b></li>
  </ul>
</div><br>
<hr>
";

// echo "<br>
// <table class='table table-bordered' style='font-size:18px;text-align:center'>
//   <tr style='background-color:#17a2b8;color:#fff'>
//     <th>Jumlah True</th>
//     <th>Jumlah False</th>
//     <th>Jumlah Total Data</th>
//   </tr>
//   <tr>
//     <td>$jumTrue</td>
//     <td>$jumFalse</td>
//     <td>$jumData</td>
//   </tr>
// </table>
// ";

// echo "<br>
// <table class='table table-bordered' style='font-size:18px;text-align:center'>
//   <tr style='background-color:#17a2b8;color:#fff'>
//     <th></th>
//     <th>True</th>
//     <th>False</th>
//   </tr>
//   <tr>
//     <td>pA</td>
//     <td>$jumTrue / $jumData</td>
//     <td>$jumFalse / $jumData</td>
//   </tr>
//   <tr>
//     <td>Jenis Kelamin</td>
//     <td>$jk / $jumTrue</td>
//     <td>$jk2 / $jumFalse</td>
//   </tr>
//   <tr>
//     <td>Beasiswa</td>
//     <td>$bea / $jumTrue</td>
//     <td>$bea2 / $jumFalse</td>
//   </tr>
//   <tr>
//     <td>IP Semester 1</td>
//     <td>$ips1 / $jumTrue</td>
//     <td>$ips1_2 / $jumFalse</td>
//   </tr>
//   <tr>
//     <td>IP Semester 2</td>
//     <td>$ips2 / $jumTrue</td>
//     <td>$ips2_2 / $jumFalse</td>
//   </tr>
//   <tr>
//     <td>IP Semester 3</td>
//     <td>$ips3 / $jumTrue</td>
//     <td>$ips3_2 / $jumFalse</td>
//   </tr>
//   <tr>
//     <td>IP Semester 4</td>
//     <td>$ips4 / $jumTrue</td>
//     <td>$ips4_2 / $jumFalse</td>
//   </tr>
//   <tr>
//     <td>IP Semester 5</td>
//     <td>$ips5 / $jumTrue</td>
//     <td>$ips5_2 / $jumFalse</td>
//   </tr>
//   <tr>
//     <td>IP Kumulatif</td>
//     <td>$ipk / $jumTrue</td>
//     <td>$ipk_2 / $jumFalse</td>
//   </tr>
// </table>
// ";

// echo "<br>
//   <table class='table table-bordered' style='font-size:18px;text-align:center;'>
//     <tr style='background-color:#17a2b8;color:#fff'>
//       <th>Presentasi Lulus Tepat Waktu</th>
//       <th>Presentasi Tidak Lulus Tepat Waktu</th>
//     </tr>
//     <tr>
//       <td>$paT</td>
//       <td>$paF</td>
//     </tr>
//   </table>
// ";

$result = $obj->perbandingan($paT,$paF);

//if($paT > $paF){
  // echo "<br>
  // <h3 class='tebal'>PRESENTASI <span class='badge badge-success' style='padding:10px'><b>LULUS TEPAT WAKTU</b></span> LEBIH BESAR DARI PADA PRESENTASI TIDAK LULUS TEPAT WAKTU</h3><br>";
 // echo "<h4><br>Presentasi lulus tepat waktu sebanyak : <b>".round($result[1],2)." %</b> <br>Presentasi tidak lulus tepat waktu sebanyak : <b>".round($result[2],2)." % </b></h4>";
//}else if($paF > $paT){
  // echo "<br>
  // <h3 class='tebal'>PRESENTASI <span class='badge badge-danger' style='padding:10px'><b>TIDAK LULUS TEPAT WAKTU</b></span> LEBIH BESAR DARI PADA PRESENTASI LULUS TEPAT WAKTU</h3><br>";
 // echo "<h4><br>Presentasi tidak lulus tepat waktu sebanyak : <b>".round($result[1],2)." %</b> <br>Presentasi lulus tepat waktu sebanyak : <b>".round($result[2],2)." % </b></h4>";
//}

if($result[0] == "LULUS TEPAT WAKTU"){
  echo "
  <div class='alert alert-success mt-5' role='aler'>
    <h4 class='alert-heading'>Kesimpulan : Anda diprediksi <b>$result[0]!</b> </h4>
    <p>Berdasarkan hasil prediksi, anda diprediksi <b>$result[0]!</b></p>
    <hr>
    <p class='mb-0'>- Have a nice day -</p>
  </div>";
}else{
  echo"
  <div class='alert alert-danger mt-5' role='aler'>
  <h4 class='alert-heading'>Kesimpulan : diprediksi <b>$result[0]!</b></h4>
  <p>Berdasarkan hasil prediksi, anda diprediksi <b>$result[0]!</p>
  <hr>
  <p class='mb-0'>- Don't give up ! -</p>
  </div>";
}

// Insert data into the database
$sql = "INSERT INTO histories (nama,jenis_kelamin, beasiswa, ips_1, ips_2, ips_3, ips_4, ips_5, ip_kumulatif,
                               total_true, total_false, total_data,
                               true_jk, true_bea, true_ips1, true_ips2, true_ips3, true_ips4, true_ips5, true_ipk,
                               false_jk, false_bea, false_ips1, false_ips2, false_ips3, false_ips4, false_ips5, false_ipk,
                               tepat_waktu, tidak_tepat_waktu,
                               status
                              )
        VALUES ('$nama','$a1', '$a2', '$a3', '$a4', '$a5', '$a6', '$a7', '$a8',
                 '$jumTrue', '$jumFalse', '$jumData',
                 '$jk', $bea, $ips1, $ips2, $ips3, $ips4, $ips5, $ipk,
                  $jk2, $bea2, $ips1_2, $ips2_2, $ips3_2, $ips4_2, $ips5_2, $ipk_2,
                  $paT, $paF,
                  '$result[0]'
                )";

if ($conn->query($sql) === TRUE) {
    echo "";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();

 ?>
