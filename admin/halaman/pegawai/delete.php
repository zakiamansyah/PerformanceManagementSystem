<?php
session_start();
include '../../../func/func.php';
if (!empty($_GET['i'])) {

	$delete =delete("keberatan","nik",$_GET['i']);
	$delete =delete("penilaian","nik",$_GET['i']);
    $delete =delete("pegawai","nik",$_GET['i']);

      if ($delete) {
      	header("Content-Type: application/json");
    echo json_encode(array('status' => 'sukses'), JSON_PRETTY_PRINT);
  } else {
  	header("Content-Type: application/json");
    echo json_encode(array('status' => 'gagal'), JSON_PRETTY_PRINT);
  }
  }
?>