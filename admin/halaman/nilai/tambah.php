		<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Tambah Data Penilaian</h1>
            <div class="btn-group mr-2">
              <a href="<?=$konfig['url']?>/admin/nilai.php" class="btn btn-sm btn-outline-danger">Tabel Data</a>
            </div>
          </div>
          <?php
    if (@$_GET['page'] == 'tambah' && isset($_POST['submit']) && isset($_GET['id'])) {
        $ceknilai = $konek->query("SELECT * FROM penilaian WHERE nik='$_POST[nik]' AND semester='$_POST[semester]' AND tahun='$_POST[tahun]'")->fetch_array(MYSQLI_BOTH);
          if ($ceknilai['semester'] == $_POST['semester'] && $ceknilai['nik'] == $_POST['nik'] && $ceknilai['tahun'] == $_POST['tahun']) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <strong>Gagal</strong> Data Untuk Semester '.$_POST['semester'].' Tahun '.$_POST['tahun'].' Sudah Ada
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>';
          }else{
        $indi = read('indikator');
        $no = 0;
        while($row = $indi->fetch_array(MYSQLI_BOTH)){
          $post = array(
                'id_nilai' => '',
                'id_sub_nilai' => $_POST['subs'],
                'semester' => $_POST['semester'],
                'tahun' => $_POST['tahun'],
                'nik' => $_POST['nik'],
                'id_indikator' => $row['id_indikator'],
                'nilai' => $_POST['indi'][$no]
               );
          $result = create('penilaian',$post);
          $no++;
        }
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
       }
    }

    $sql = read('pegawai','nik',$_GET['id'])->fetch_array(MYSQLI_BOTH);
    if ($sql['nik'] != $_GET['id']) {
      header('location:pegawai.php');
    }

    ?>


          <form method="post">
			     <div class="form-group ">
			      <label class="control-label requiredField">
			       Pegawai
			       <span class="asteriskField">
			        *
			       </span>
			      </label>
            <input class="form-control" id="subs" name="subs" type="hidden" value="<?=kodeotomatis('penilaian','id_sub_nilai',2,'NILAI')?>">
			      <input class="form-control" id="nik" name="nik" type="hidden" value="<?=$_GET['id']?>">
            <input class="form-control" type="text" value="<?=$sql['nama']?> (<?=$_GET['id']?>)" readonly>
			     </div>
			     <div class="form-group ">
			      <label class="control-label requiredField" for="semester">
			       Semester
			       <span class="asteriskField">
			        *
			       </span>
			      </label>
            <select class="mdb-select" id="semester" name="semester" required>
              <option value="1">Semester 1</option>
              <option value="2">Semester 2</option>
              <option value="3">Semester 3</option>
              <option value="4">Semester 4</option>
              <option value="5">Semester 5</option>
              <option value="6">Semester 6</option>
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
                                                $sel = $i == date('Y') ? ' selected="selected"' : '';
                                                echo '<option value="'.$i.'"'.$sel.'>'.$i.'</option>';
                                            }
                                            ?>
         </select>
           </div>
           <?php
           $indi = read('indikator');
           while($row = $indi->fetch_array(MYSQLI_BOTH)){
           ?>
           <div class="form-group ">
            <label class="control-label requiredField">
             <?=$row['nama_indikator']?>
             <span class="asteriskField">
              *
             </span>
            </label>
            <input class="form-control" id="indi[]" name="indi[]" type="text" required>
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