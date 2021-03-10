		<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Tambah Data Penilaian</h1>
            <div class="btn-group mr-2">
              <a href="<?=$konfig['url']?>/admin/nilai.php?page=view&nik=<?=$_GET['id']?>&semester=<?=$_GET['semester']?>&tahun=<?=$_GET['tahun']?>" class="btn btn-sm btn-outline-danger">Lihat Data</a>
            </div>
          </div>
          <?php
    if (@$_GET['page'] == 'update' && isset($_POST['submit']) && isset($_GET['id'])) {
        $indi = read('indikator');
        $no = 0;
        while($row = $indi->fetch_array(MYSQLI_BOTH)){
          $nilai = $_POST['indi'][$no];
          $result = $konek->query("UPDATE penilaian SET nilai='$nilai' WHERE nik='$_POST[nik]' AND semester='$_POST[semester]' AND tahun='$_POST[tahun]' AND id_indikator='$row[id_indikator]'");
          $no++;
        }
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
    }

    $sql = read('pegawai','nik',$_GET['id'])->fetch_array(MYSQLI_BOTH);
    if ($sql['nik'] != $_GET['id']) {
      header('location:pegawai.php');
    }
    $ceks = $konek->query("SELECT * FROM penilaian WHERE nik='$_GET[id]' AND semester='$_GET[semester]' AND tahun='$_GET[tahun]'")->fetch_array(MYSQLI_BOTH);
    if ($ceks['semester'] != $_GET['semester'] && $ceks['tahun'] != $_GET['tahun']) {
      header('location:nilai.php');
    }
    ?>


          <form method="post">
			     <div class="form-group ">
			      <label class="control-label requiredField">
			       NIK
			       <span class="asteriskField">
			        *
			       </span>
			      </label>
			      <input class="form-control" id="nik" name="nik" type="text" value="<?=$_GET['id']?>" readonly>
			     </div>
			     <div class="form-group ">
			      <label class="control-label requiredField" for="semester">
			       Semester
			       <span class="asteriskField">
			        *
			       </span>
			      </label>
            <select class="mdb-select" id="semester" name="semester" required>
              <option value="1" <?=$_GET['semester'] == 1 ? ' selected="selected"' : ''?>>Semester 1</option>
              <option value="2" <?=$_GET['semester'] == 2 ? ' selected="selected"' : ''?>>Semester 2</option>
              <option value="3" <?=$_GET['semester'] == 3 ? ' selected="selected"' : ''?>>Semester 3</option>
              <option value="4" <?=$_GET['semester'] == 4 ? ' selected="selected"' : ''?>>Semester 4</option>
              <option value="5" <?=$_GET['semester'] == 5 ? ' selected="selected"' : ''?>>Semester 5</option>
              <option value="6" <?=$_GET['semester'] == 6 ? ' selected="selected"' : ''?>>Semester 6</option>
            </select>
			     </div>
           <div class="form-group ">
            <label class="control-label requiredField" for="tahun">
             Tahun
             <span class="asteriskField">
              *
             </span>
            </label>
            <select name="tahun" class="mdb-select colorful-select dropdown-primary" id="tahun" searchable="Search here.." required>
                                            <?php
                                            $mulai= date('Y');
                                            for($i = $mulai;$i>$mulai - 20;$i--){
                                                $sel = $i == $_GET['tahun'] ? ' selected="selected"' : '';
                                                echo '<option value="'.$i.'"'.$sel.'>'.$i.'</option>';
                                            }
                                            ?>
         </select>
           </div>
           <?php
           $indi = read('indikator');
           while($row = $indi->fetch_array(MYSQLI_BOTH)){
           	$ceknilai = $konek->query("SELECT * FROM penilaian WHERE nik='$_GET[id]' AND semester='$_GET[semester]' AND tahun='$_GET[tahun]' AND id_indikator='$row[id_indikator]'")->fetch_array(MYSQLI_BOTH);
           ?>
           <div class="form-group ">
            <label class="control-label requiredField">
             <?=$row['nama_indikator']?>
             <span class="asteriskField">
              *
             </span>
            </label>
            <input class="form-control" id="indi[]" name="indi[]" type="text" value="<?=$ceknilai['nilai']?>" required>
           </div>
           <?php }?>
			     <div class="form-group">
			      <div>
			       <button class="btn btn-primary " name="submit" type="submit">
			        Submit
			       </button>
			      </div>
			     </div>
			    </form>