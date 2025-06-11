<?php
require_once 'autoload.php';

$obj = new Bayes();

// echo $obj->sumData()."<br>";
// echo $obj->sumTrue()."<br>";
// echo $obj->sumFalse()."<br>";
// echo $obj->probUmur(21,0)."<br>";

$jumTrue = $obj->sumTrue();
$jumFalse = $obj->sumFalse();
$jumData = $obj->sumData();

$a1 = "laki_laki";
$a2 = "ya";
$a3 = "sangat_baik";
$a4 = "baik";
$a5 = "sangat_baik";
$a6 = "sangat_baik";
$a7 = "baik";
$a8 = "baik";
$a9 = "sangat_baik";
$a10 = "sangat_baik";
$a11 = "baik";

//TRUE
$jk = $obj->probJenisKelamin($a1,1);
$bea = $obj->probBeasiswa($a2,1);
$ips1 = $obj->probIPS1($a3,1);
$ips2 = $obj->probIPS2($a4,1);
$ips3 = $obj->probIPS3($a5,1);
$ips4 = $obj->probIPS4($a6,1);
$ips5 = $obj->probIPS5($a7,1);
$ips6 = $obj->probIPS6($a8,1);
$ips7 = $obj->probIPS7($a9,1);
$ips8 = $obj->probIPS8($a10,1);
$ipk = $obj->probIPK($a11,1);

//FALSE
$jk2 = $obj->probJenisKelamin($a1,0);
$bea2 = $obj->probBeasiswa($a2,0);
$ips1_2 = $obj->probIPS1($a3,0);
$ips2_2 = $obj->probIPS2($a4,0);
$ips3_2 = $obj->probIPS3($a5,0);
$ips4_2 = $obj->probIPS4($a6,0);
$ips5_2 = $obj->probIPS5($a7,0);
$ips6_2 = $obj->probIPS6($a8,0);
$ips7_2 = $obj->probIPS7($a9,0);
$ips8_2 = $obj->probIPS8($a10,0);
$ipk_2 = $obj->probIPK($a11,0);

//result
$paT = $obj->hasilTrue($jumTrue,$jumData,$jk,$bea,$ips1,$ips2,$ips3,$ips4,$ips5,$ips6,$ips7,$ips8,$ipk);
$paF = $obj->hasilFalse($jumTrue,$jumData,$jk2,$bea2,$ips1_2,$ips2_2,$ips3_2,$ips4_2,$ips5_2,$ips6_2,$ips7_2,$ips8_2,$ipk_2);

echo "
======================================<br>
Jenis Kelamin : $a1<br>
Beasiswa : $a2<br>
IP Semester 1 : $a3<br>
IP Semester 2 : $a4<br>
IP Semester 3 : $a5<br>
IP Semester 4 : $a6<br>
IP Semester 5 : $a7<br>
IP Semester 6 : $a8<br>
IP Semester 7 : $a9<br>
IP Semester 8 : $a10<br>
IP Kumulatif : $a11<br>
=======================================<br><br>
";

echo "
======================================<br>
kemungkinan true : <br>
jumlah true : $jumTrue <br>
jumlah data : $jumData <br>
=======================================<br><br>
";

echo "
======================================<br>
kemungkinan false : <br>
jumlah false : $jumFalse <br>
jumlah data : $jumData <br>
=======================================<br><br>
";

echo "
======================================<br>
pATrue : $jumTrue / $jumData<br>
Jenis Kelamin true : $jk / $jumTrue <br>
Beasiswa true : $bea / $jumTrue <br>
IP Semester 1 true : $ips1 / $jumTrue <br>
IP Semester 2 true : $ips2 / $jumTrue <br>
IP Semester 3 true : $ips3 / $jumTrue <br>
IP Semester 4 true : $ips4 / $jumTrue <br>
IP Semester 5 true : $ips5 / $jumTrue <br>
IP Semester 6 true : $ips6 / $jumTrue <br>
IP Semester 7 true : $ips7 / $jumTrue <br>
IP Semester 8 true : $ips8 / $jumTrue <br>
IP Kumulatif true : $ipk / $jumTrue <br><br>
=======================================<br><br>
";

echo "
======================================<br>
pAFalse : $jumFalse / $jumData<br>
Jenis Kelamin false : $jk2 / $jumFalse <br>
Beasiswa false : $bea2 / $jumFalse <br>
IP Semester 1 false : $ips1_2 / $jumFalse <br>
IP Semester 2 false : $ips2_2 / $jumFalse <br>
IP Semester 3 false : $ips3_2 / $jumFalse <br>
IP Semester 4 false : $ips4_2 / $jumFalse <br>
IP Semester 5 false : $ips5_2 / $jumFalse <br>
IP Semester 6 false : $ips6_2 / $jumFalse <br>
IP Semester 7 false : $ips7_2 / $jumFalse <br>
IP Semester 8 false : $ips8_2 / $jumFalse <br>
IP Kumulatif false : $ipk_2 / $jumFalse <br>
=======================================<br><br>
";

echo "
======================================<br>
presentasi yes : $paT<br>
presentasi no : $paF<br>
=======================================<br><br>
";

if($paT > $paF){
  echo "
  ======================================<br>
  PRESENTASI YES LEBIH BESAR DARI PADA PRESENTASI NO<br>
  =======================================
  <br><br>";
}else if($paF > $paT){
  echo "
  ======================================<br>
  PRESENTASI NO LEBIH BESAR DARI PADA PRESENTASI YES<br>
  =======================================
  <br><br>";
}

// echo $obj->hasilTrue($jumTrue,$jumData,$umur,$tinggi,$bb,$kesehatan,$pendidikan)."<br>";
// echo $obj->hasilFalse($jumTrue,$jumData,$umur2,$tinggi2,$bb2,$kesehatan2,$pendidikan2)."<br><br>";

$result = $obj->perbandingan($paT,$paF);
echo " Status : $result[0] <br>Presentasi lulus tepat waktu sebanyak : ".round($result[1],2)." % <br>Presentasi tidak lulus tepat waktu sebanyak : ".round($result[2],2)." % ";
 ?>
