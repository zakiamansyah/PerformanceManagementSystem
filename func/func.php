<?php
require_once("koneksi.php");

	function konfig()
	{
		$konfig['url'] = 'http://localhost/kinerja';
		$konfig['judul'] = 'Sistem Monitoring Kinerja Pegawai';
		$konfig['perusahaan'] = 'IKMI';
		$konfig['alamat_perusahaan'] = 'JALAN';
		$konfig['nama_atasan'] = '';
		return $konfig;
	}

	function masuk($user,$pass)
	{
		$konek = koneksi();
		$username = mysqli_real_escape_string($konek, $user);
		$password = mysqli_real_escape_string($konek, md5($pass));
		$cekuser = $konek->query("SELECT * FROM user WHERE username = '$username' AND password ='$password'");
		$jumlah = $cekuser->num_rows;
		$hasil = $cekuser->fetch_array(MYSQLI_BOTH);
		if($jumlah == 0) {
			header('location:login.php?login=gagal');
			}elseif ($hasil['password'] != $password) {
			header('location:login.php?login=gagal');
			}elseif ($hasil['level'] == 1) {
			$_SESSION['username'] = $hasil['username'];
			$_SESSION['level'] = $hasil['level'];
			header('location:./admin/index.php');
			}elseif ($hasil['level'] == 2) {
			$_SESSION['username'] = $hasil['username'];
			$_SESSION['level'] = $hasil['level'];
			header('location:./kepala/index.php');
			}elseif ($hasil['level'] == 3){
			$_SESSION['username'] = $hasil['username'];
			$_SESSION['level'] = $hasil['level'];
			header('location:index.php');
		}
	}

	function keluar()
	{
		session_start();
		session_destroy();
		header('location:login.php');
	}

	function flash( $name = '', $message = '')
	{
    if( !empty( $name ) )
    {
        if( !empty( $message ) && empty( $_SESSION[$name] ) )
        {
            if( !empty( $_SESSION[$name] ) )
            {
                unset( $_SESSION[$name] );
            }

            $_SESSION[$name] = $message;
        }
        elseif( !empty( $_SESSION[$name] ) && empty( $message ) )
        {
        	$dd = $_SESSION[$name];
        	unset($_SESSION[$name]);
            return $dd;
            
        }
    }
	}

	function kodeotomatis($tabel,$field,$lebar=0,$awalan='') {
		$konek = koneksi();
		 $sqlstr="SELECT $field FROM $tabel order by $field desc limit 1";
		 $hasil = $konek->query($sqlstr);
		 	if(!$hasil) die('gagal auto number query:'.mysqli_error());
		 		$jumlahrecord= $hasil->num_rows;
		 		if($jumlahrecord == 0)
		 			$nomor=1;
		 		else
		 		{
		 	$row= $hasil->fetch_array(MYSQLI_BOTH);
		 	$nomor=intval(substr($row[0],strlen($awalan)))+1;
		 	}
		 	if($lebar>0)
		 		$angka = $awalan.str_pad($nomor,$lebar,"0",STR_PAD_LEFT);
			 	else
			 	$angka = $awalan.$nomor;
			 	return $angka;
		 	}
	
	function waktu($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'Tahun',
        'm' => 'Bulan',
        'w' => 'Minggu',
        'd' => 'Hari',
        'h' => 'Jam',
        'i' => 'Menit',
        's' => 'Detik',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' lalu' : 'Baru Saja';
}




