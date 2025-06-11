<?php
class Bayes
{
  private $mahasiswa = "data.json";
  // private $jumTrue = 0;
  // private $jumFalse = 0;
  // private $jumData = 0;

  function __construct()
  {

  }

  /*================================================================
  FUNCTION SUM TRUE DAN FALSE
  =================================================================*/
  function sumTrue()
  {
    $data = file_get_contents($this->mahasiswa);
    $hasil = json_decode($data,true);

    $t = 0;
    foreach($hasil as $hasil)
    {
      if($hasil['status_kelulusan'] == 1){
        $t += 1;
      }
    }

    return $t;
  }

  function sumFalse()
  {
    $data = file_get_contents($this->mahasiswa);
    $hasil = json_decode($data,true);

    $t = 0;
    foreach($hasil as $hasil)
    {
      if($hasil['status_kelulusan'] == 0){
        $t += 1;
      }
    }
    return $t;
  }

  function sumData()
  {
    $data = file_get_contents($this->mahasiswa);
    $hasil = json_decode($data,true);
    return count($hasil);
  }

  //=================================================================

  /*================================================================
  FUNCTION PROBABILITAS
  =================================================================*/
  function probJenisKelamin($jk,$status)
  {
    $data = file_get_contents($this->mahasiswa);
    $hasil = json_decode($data,true);

    $t = 0;
    foreach ($hasil as $hasil) {
      if($hasil['jenis_kelamin'] == $jk && $hasil['status_kelulusan'] == $status){
        $t += 1;
      }else if($hasil['jenis_kelamin'] == $jk && $hasil['status_kelulusan'] == $status){
        $t +=1;
      }
    }
    return $t;
  }

  function probBeasiswa($bea,$status)
  {
    $data = file_get_contents($this->mahasiswa);
    $hasil = json_decode($data,true);

    $t = 0;
    foreach ($hasil as $hasil) {
      if($hasil['beasiswa'] == $bea && $hasil['status_kelulusan'] == $status){
        $t += 1;
      }else if($hasil['beasiswa'] == $bea && $hasil['status_kelulusan'] == $status){
        $t +=1;
      }
    }
    return $t;
  }

  function probIPS1($ips1,$status)
  {
    $data = file_get_contents($this->mahasiswa);
    $hasil = json_decode($data,true);

    $t = 0;
    foreach ($hasil as $hasil) {
      if($hasil['ips_1'] == $ips1 && $hasil['status_kelulusan'] == $status){
        $t += 1;
      }else if($hasil['ips_1'] == $ips1 && $hasil['status_kelulusan'] == $status){
        $t +=1;
      }
    }
    return $t;
  }

  function probIPS2($ips2,$status)
  {
    $data = file_get_contents($this->mahasiswa);
    $hasil = json_decode($data,true);

    $t = 0;
    foreach ($hasil as $hasil) {
      if($hasil['ips_2'] == $ips2 && $hasil['status_kelulusan'] == $status){
        $t += 1;
      }else if($hasil['ips_2'] == $ips2 && $hasil['status_kelulusan'] == $status){
        $t +=1;
      }
    }
    return $t;
  }

  function probIPS3($ips3,$status)
  {
    $data = file_get_contents($this->mahasiswa);
    $hasil = json_decode($data,true);

    $t = 0;
    foreach ($hasil as $hasil) {
      if($hasil['ips_3'] == $ips3 && $hasil['status_kelulusan'] == $status){
        $t += 1;
      }else if($hasil['ips_3'] == $ips3 && $hasil['status_kelulusan'] == $status){
        $t +=1;
      }
    }
    return $t;
  }

  function probIPS4($ips4,$status)
  {
    $data = file_get_contents($this->mahasiswa);
    $hasil = json_decode($data,true);

    $t = 0;
    foreach ($hasil as $hasil) {
      if($hasil['ips_4'] == $ips4 && $hasil['status_kelulusan'] == $status){
        $t += 1;
      }else if($hasil['ips_4'] == $ips4 && $hasil['status_kelulusan'] == $status){
        $t +=1;
      }
    }
    return $t;
  }

  function probIPS5($ips5,$status)
  {
    $data = file_get_contents($this->mahasiswa);
    $hasil = json_decode($data,true);

    $t = 0;
    foreach ($hasil as $hasil) {
      if($hasil['ips_5'] == $ips5 && $hasil['status_kelulusan'] == $status){
        $t += 1;
      }else if($hasil['ips_5'] == $ips5 && $hasil['status_kelulusan'] == $status){
        $t +=1;
      }
    }
    return $t;
  }

  function probIPK($ipk,$status)
  {
    $data = file_get_contents($this->mahasiswa);
    $hasil = json_decode($data,true);

    $t = 0;
    foreach ($hasil as $hasil) {
      if($hasil['ip_kumulatif'] == $ipk && $hasil['status_kelulusan'] == $status){
        $t += 1;
      }else if($hasil['ip_kumulatif'] == $ipk && $hasil['status_kelulusan'] == $status){
        $t +=1;
      }
    }
    return $t;
  }
  //=================================================================

  /*=================================================================
  MARI BERHITUNG
  keterangan parameter :
  $sT   : jumlah data yang bernilai true ( sumTrue )
  $sF   : jumlah data yang bernilai false ( sumFalse )
  $sD   : jumlah data pada data latih ( sumData )
  $pJk   : jumlah probabilitas jenis kelamin ( probJenisKelamin )
  $pBea  : jumlah probabilitas beasiswa ( probBeasiswa )
  $pIps1 : jumlah probabilitas ip semester 1 ( probIPS1 )
  $pIps2 : jumlah probabilitas ip semester 2 ( probIPS2 )
  $pIps3 : jumlah probabilitas ip semester 3 ( probIPS3 )
  $pIps4 : jumlah probabilitas ip semester 4 ( probIPS3 )
  $pIps5 : jumlah probabilitas ip semester 5 ( probIPS3 )
  $pIpk  : jumlah probabilitas ip kumulatif ( probIPK )
  ==================================================================*/

  function hasilTrue($sT = 0, $sD = 0, $pJk = 0, $pBea = 0, $pIps1 = 0, $pIps2 = 0, 
                     $pIps3 = 0, $pIps4 = 0, $pIps5 = 0, $pIpk = 0)
  {
    $paTrue = $sT / $sD;
    $p1 = $pJk / $sT;
    $p2 = $pBea / $sT;
    $p3 = $pIps1 / $sT;
    $p4 = $pIps2 / $sT;
    $p5 = $pIps3 / $sT;
    $p6 = $pIps4 / $sT;
    $p7 = $pIps5 / $sT;
    $p8 = $pIpk / $sT;
    $hsl = $paTrue * $p1 * $p2 * $p3 * $p4 * $p5 * $p6 * $p7 * $p8;
    return $hsl;
  }

  function hasilFalse($sF = 0 , $sD = 0 , $pJk = 0, $pBea = 0, $pIps1 = 0, $pIps2 = 0, 
                      $pIps3 = 0, $pIps4 = 0, $pIps5 = 0, $pIpk = 0)
  {
    $paFalse = $sF / $sD;
    $p1 = $pJk / $sF;
    $p2 = $pBea / $sF;
    $p3 = $pIps1 / $sF;
    $p4 = $pIps2 / $sF;
    $p5 = $pIps3 / $sF;
    $p6 = $pIps4 / $sF;
    $p7 = $pIps5 / $sF;
    $p8 = $pIpk / $sF;
    $hsl = $paFalse * $p1 * $p2 * $p3 * $p4 * $p5 * $p6 * $p7 * $p8;
    return $hsl;
  }

  function perbandingan($pATrue,$pAFalse)
  {
    if($pATrue > $pAFalse){
      $stt = "LULUS TEPAT WAKTU";
      $hitung = ($pATrue / ($pATrue + $pAFalse)) * 100;
      $diterima = 100 - $hitung;
    }elseif($pAFalse > $pATrue)
    {
      $stt = "TIDAK LULUS TEPAT WAKTU";
      $hitung = ($pAFalse / ($pAFalse + $pATrue)) * 100;
      $diterima = 100 - $hitung;
    }

    $hsl = array($stt,$hitung,$diterima);
    return $hsl;
  }
  //=================================================================
}

?>
