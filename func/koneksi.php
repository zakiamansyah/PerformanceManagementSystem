<?php
	function koneksi()
	{
		$db['server'] = 'localhost';
		$db['user'] = 'root';
		$db['password'] = '';
		$db['database'] = 'kinerja';

		$con = new mysqli($db['server'],$db['user'],$db['password'],$db['database']) or die('Gagal Konek');
		return $con;
	}

	function read($table,$kunci = null,$isi_kunci = null)
	{
		if ($kunci != null && $isi_kunci != null) {
			$sql = "SELECT * FROM $table WHERE $kunci = '$isi_kunci'";
		}else{
			$sql = "SELECT * FROM $table";
		}
		$run = mysqli_query(koneksi(), $sql);
		return $run;
	}


	function create($table,$isi)
	{
		$fields = $values = array();
		if (is_array($isi)) {
		foreach (array_keys($isi) as $key) {
			$fields[] = $key;
			$values[] = "'" . mysqli_real_escape_string(koneksi(),$isi[$key]) . "'";
		}
		$fields = implode(",", $fields);
    	$values = implode(",", $values);
		$sql = "INSERT INTO $table($fields) VALUES ($values)";
		// echo $sql;
		$run = mysqli_query(koneksi(), $sql);
		if ($run) {
			return true;
		}else{
			return false;
		}
		}else{
			return false;
		}
	}

	function update($table,$isi,$kunci,$isi_kunci)
	{
		if (is_array($isi)) {
		foreach ($isi as $field=>$value) {
			$fields[] = sprintf("%s = '%s'", $field, mysqli_real_escape_string(koneksi(),$value));
		}
		$field_list = join(',', $fields);
		$sql = sprintf("UPDATE `%s` SET %s WHERE `%s` = '%s'", $table, $field_list, $kunci, $isi_kunci);
		$run = mysqli_query(koneksi(), $sql);
		if ($run) {
			return true;
		}else{
			return false;
		}
		}else{
			return false;
		}
	}

	function delete($table,$kunci,$isi_kunci)
	{
		$sql = "DELETE FROM $table WHERE $kunci = '$isi_kunci'";
		$run = mysqli_query(koneksi(), $sql);
		if ($run) {
			return true;
		}else{
			return false;
		}
	}

?>