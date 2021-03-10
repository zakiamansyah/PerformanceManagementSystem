		<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Update Data Indikator</h1>
            <div class="btn-group mr-2">
              <a href="<?=$konfig['url']?>/admin/indikator.php" class="btn btn-sm btn-outline-primary">Tabel Data</a>
            </div>
          </div>
          <?php
    if (@$_GET['page'] == 'update' && isset($_POST['submit'])) {
        $post = array(
						'nama_indikator' => $_POST['nama_indikator']
        			 );
      $result = update('indikator',$post,'id_indikator',$_POST['id_indikator']);
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


          <form method="post">
			     <div class="form-group ">
			      <label class="control-label requiredField" for="id_indikator">
			       ID
			       <span class="asteriskField">
			        *
			       </span>
			      </label>
			      <input class="form-control" id="id_indikator" name="id_indikator" value="<?=$row['id_indikator']?>" type="text" required readonly>
			     </div>
			     <div class="form-group ">
			      <label class="control-label requiredField" for="nama_indikator">
			       Nama
			       <span class="asteriskField">
			        *
			       </span>
			      </label>
			      <input class="form-control" id="nama_indikator" name="nama_indikator" value="<?=$row['nama_indikator']?>" type="text" required>
			     </div>

			     <div class="form-group">
			      <div>
			       <button class="btn btn-primary " name="submit" type="submit">
			        Submit
			       </button>
			      </div>
			     </div>
			    </form>