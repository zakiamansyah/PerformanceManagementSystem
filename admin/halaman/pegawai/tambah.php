		<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Tambah Data Pegawai</h1>
            <div class="btn-group mr-2">
              <a href="<?=$konfig['url']?>/admin/pegawai.php" class="btn btn-sm btn-outline-danger">Tabel Data</a>
              <a href="?page=tambah" class="btn btn-sm btn-danger active">Tambah Data</a>
            </div>
          </div>
          <?php
    if (@$_GET['page'] == 'tambah' && isset($_POST['submit'])) {
        $post = array(
        				'nik' => $_POST['nik'],
						'nama' => $_POST['nama'],
						'tempat_lahir' => $_POST['tempat_lahir'], 
						'tgl_lahir' => $_POST['tgl_lahir'], 
						'sd' => $_POST['sd'], 
						'smp' => $_POST['smp'], 
						'sma' => $_POST['sma'], 
						'akademik' => $_POST['akademik'], 
						'thn_masuk_kerja' => $_POST['thn_masuk_kerja'], 
						'status' => $_POST['status'], 
						'nomor_sk' => $_POST['nomor_sk']
        			 );
        $user = array(
	                	'id_user' => '',
	                	'username' => $_POST['nik'],
	                	'password' => md5($_POST['password']),
	                	'level' => 3
	              );
	  $login = create('user',$user);
      $result = create('pegawai',$post);
        if ($result) {
         echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>Sukses</strong> Data Sudah Di Tambahkan
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>';
         }else{
         echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <strong>Gagal</strong> Data Tidak Dapat Di Tambahkan
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>';
         }
    }?>

    	<span class="asteriskField">*</span> Harus Diisi<br>
          <form method="post">
			     <div class="form-group ">
			      <label class="control-label requiredField" for="nik">
			       NIK
			       <span class="asteriskField">
			        *
			       </span>
			      </label>
			      <input class="form-control" id="nik" name="nik" type="text" required>
			     </div>
			     <div class="form-group ">
			      <label class="control-label requiredField" for="nama">
			       Password
			       <span class="asteriskField">
			        *
			       </span>
			      </label>
			      <input class="form-control" id="password" name="password" type="password" required>
			     </div>
			     <div class="form-group ">
			      <label class="control-label requiredField" for="nama">
			       Nama
			       <span class="asteriskField">
			        *
			       </span>
			      </label>
			      <input class="form-control" id="nama" name="nama" type="text" required>
			     </div>
			     <div class="form-group ">
			      <label class="control-label requiredField" for="tempat_lahir">
			       Tempat Lahir
			       <span class="asteriskField">
			        *
			       </span>
			      </label>
			      <input class="form-control" id="tempat_lahir" name="tempat_lahir" type="text" required>
			     </div>
			     <div class="form-group ">
			      <label class="control-label requiredField" for="date">
			       Tanggal Lahir
			       <span class="asteriskField">
			        *
			       </span>
			      </label>
			      <input class="form-control" id="tgl_lahir" name="tgl_lahir" placeholder="MM/DD/YYYY" type="date" required>
			     </div>
			     <div class="form-group ">
			      <label class="control-label requiredField" for="sd">
			       SD
			       <span class="asteriskField">
			        *
			       </span>
			      </label>
			      <input class="form-control" id="sd" name="sd" type="text" required>
			     </div>
			     <div class="form-group ">
			      <label class="control-label requiredField" for="smp">
			       SMP
			       <span class="asteriskField">
			        *
			       </span>
			      </label>
			      <input class="form-control" id="smp" name="smp" type="text" required>
			     </div>
			     <div class="form-group ">
			      <label class="control-label requiredField" for="sma">
			       SMA
			       <span class="asteriskField">
			        *
			       </span>
			      </label>
			      <input class="form-control" id="sma" name="sma" type="text" required>
			     </div>
			     <div class="form-group ">
			      <label class="control-label requiredField" for="akademik">
			       Akademik
			       <span class="asteriskField">
			        *
			       </span>
			      </label>
			      <input class="form-control" id="akademik" name="akademik" type="text" required>
			     </div>
			     <div class="form-group ">
			      <label class="control-label requiredField" for="thn_masuk_kerja">
			       Tahun Masuk Kerja
			       <span class="asteriskField">
			        *
			       </span>
			      </label>
			      <input class="form-control" id="thn_masuk_kerja" name="thn_masuk_kerja" type="text" required>
			     </div>
			     <div class="form-group ">
			      <label class="control-label requiredField" for="status">
			       Status
			       <span class="asteriskField">
			        *
			       </span>
			      </label>
			      <input class="form-control" id="status" name="status" type="text" required>
			     </div>
			     <div class="form-group ">
			      <label class="control-label requiredField" for="nomor_sk">
			       Nomor SK
			       <span class="asteriskField">
			        *
			       </span>
			      </label>
			      <input class="form-control" id="nomor_sk" name="nomor_sk" type="number" required>
			     </div>
			     <div class="form-group">
			      <div>
			       <button class="btn btn-primary " name="submit" type="submit">
			        Submit
			       </button>
			      </div>
			     </div>
			    </form>