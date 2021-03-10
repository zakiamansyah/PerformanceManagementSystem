		<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Update Data Pegawai</h1>
            <div class="btn-group mr-2">
              <a href="<?=$konfig['url']?>/admin/pegawai.php" class="btn btn-sm btn-outline-primary">Tabel Data</a>
            </div>
          </div>
          <?php
    if (@$_GET['page'] == 'update' && isset($_POST['submit'])) {
        $post = array(
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
        $cekpw = read('user','username',$_POST['nik']);
	                			if (empty($_POST['password'])) {
	                				$password = $cekpw[0]['password'];
	                			}else{
	                				$password = md5($_POST['password']);
	                			}
	                			$user = array(
	                				'username' => $_POST['nip'],
	                				'password' => $password
	                			);
	  $login = update('user',$user,'username',$_POST['nik']);
      $result = update('pegawai',$post,'nik',$_POST['nik']);
        if ($result) {
         echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>Sukses</strong> Data Sudah Di Update
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>';
         }else{
         echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <strong>Gagal</strong> Data Tidak Dapat Di Update
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
			      <input class="form-control" id="nik" name="nik" type="text" value="<?=$row['nik']?>" required readonly>
			     </div>
			     <div class="form-group ">
			      <label class="control-label requiredField" for="nama">
			       Password
			      </label>
			      <input class="form-control" id="password" name="password" type="password">
			     </div>
			     <div class="form-group ">
			      <label class="control-label requiredField" for="nama">
			       Nama
			       <span class="asteriskField">
			        *
			       </span>
			      </label>
			      <input class="form-control" id="nama" name="nama" type="text" value="<?=$row['nama']?>" required>
			     </div>
			     <div class="form-group ">
			      <label class="control-label requiredField" for="tempat_lahir">
			       Tempat Lahir
			       <span class="asteriskField">
			        *
			       </span>
			      </label>
			      <input class="form-control" id="tempat_lahir" name="tempat_lahir" type="text" value="<?=$row['nik']?>" required>
			     </div>
			     <div class="form-group ">
			      <label class="control-label requiredField" for="date">
			       Tanggal Lahir
			       <span class="asteriskField">
			        *
			       </span>
			      </label>
			      <input class="form-control" id="tgl_lahir" name="tgl_lahir" placeholder="MM/DD/YYYY" type="date" value="<?=$row['tgl_lahir']?>" data-value="<?=$row['tgl_lahir']?>" required>
			     </div>
			     <div class="form-group ">
			      <label class="control-label requiredField" for="sd">
			       SD
			       <span class="asteriskField">
			        *
			       </span>
			      </label>
			      <input class="form-control" id="sd" name="sd" type="text" value="<?=$row['sd']?>" required>
			     </div>
			     <div class="form-group ">
			      <label class="control-label requiredField" for="smp">
			       SMP
			       <span class="asteriskField">
			        *
			       </span>
			      </label>
			      <input class="form-control" id="smp" name="smp" type="text" value="<?=$row['smp']?>" required>
			     </div>
			     <div class="form-group ">
			      <label class="control-label requiredField" for="sma">
			       SMA
			       <span class="asteriskField">
			        *
			       </span>
			      </label>
			      <input class="form-control" id="sma" name="sma" type="text" value="<?=$row['sma']?>" required>
			     </div>
			     <div class="form-group ">
			      <label class="control-label requiredField" for="akademik">
			       Akademik
			       <span class="asteriskField">
			        *
			       </span>
			      </label>
			      <input class="form-control" id="akademik" name="akademik" type="text" value="<?=$row['akademik']?>" required>
			     </div>
			     <div class="form-group ">
			      <label class="control-label requiredField" for="thn_masuk_kerja">
			       Tahun Masuk Kerja
			       <span class="asteriskField">
			        *
			       </span>
			      </label>
			      <input class="form-control" id="thn_masuk_kerja" name="thn_masuk_kerja" type="text" value="<?=$row['thn_masuk_kerja']?>" required>
			     </div>
			     <div class="form-group ">
			      <label class="control-label requiredField" for="status">
			       Status
			       <span class="asteriskField">
			        *
			       </span>
			      </label>
			      <input class="form-control" id="status" name="status" type="text" value="<?=$row['status']?>" required>
			     </div>
			     <div class="form-group ">
			      <label class="control-label requiredField" for="nomor_sk">
			       Nomor SK
			       <span class="asteriskField">
			        *
			       </span>
			      </label>
			      <input class="form-control" id="nomor_sk" name="nomor_sk" type="number" value="<?=$row['nomor_sk']?>" required>
			     </div>
			     <div class="form-group">
			      <div>
			       <button class="btn btn-primary " name="submit" type="submit">
			        Submit
			       </button>
			      </div>
			     </div>
			    </form>