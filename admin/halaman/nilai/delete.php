<?php
session_start();
include '../../../func/func.php';
$konek = koneksi();
if (!empty($_GET['i'])) {

    $delete = $konek->query("DELETE FROM penilaian WHERE nik='$_GET[i]' AND semester='$_GET[sms]' AND tahun='$_GET[thn]'");

      if ($delete) {
      	header("Content-Type: application/json");
    echo json_encode(array('status' => 'sukses'), JSON_PRETTY_PRINT);
  } else {
  	header("Content-Type: application/json");
    echo json_encode(array('status' => 'gagal'), JSON_PRETTY_PRINT);
  }
  }
?>