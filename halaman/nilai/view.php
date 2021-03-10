		<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Data Nilai</h1>
            <a href="<?=$konfig['url']?>/nilai.php" class="btn btn-sm btn-outline-danger">Table Data</a>
          </div>

          <?php
                            if (isset($_GET['nik']) && !empty($_GET['nik']) && isset($_GET['semester']) && !empty($_GET['semester']) && isset($_GET['tahun']) && !empty($_GET['tahun'])) {
                              $ceknilai = $konek->query("SELECT * FROM penilaian WHERE nik='$_GET[nik]' AND semester='$_GET[semester]' AND tahun='$_GET[tahun]'")->fetch_array(MYSQLI_BOTH);
                              if ($ceknilai['nik'] == $_GET['nik'] && $ceknilai['semester'] == $_GET['semester'] && $ceknilai['tahun'] == $_GET['tahun']) {
                                $pegawai = read('pegawai','nik',$ceknilai['nik'])->fetch_array(MYSQLI_BOTH);
                            ?>
                            <a href="#" id="cetak" class="btn pink"><i class="fa fa-print"></i> Print</a>
                            <a href="komplain.php?page=view&id=<?=$ceknilai['id_sub_nilai']?>" class="btn btn-danger"><i class="fas fa-exclamation-triangle"></i> Keberatan ?</a>
                            <hr>
  <print id="areaprint">
    <style type="text/css">
    @media print {
		  @page { margin: 0; }
		  body { margin: 1.6cm; }
		}
             /* @page 
                  {
                      size:  auto;
                      margin: 4mm;  
                  }*/
            </style>

    <div class="row">
        <div class="col-md-12">
                <table cellspacing="0" cellpadding="0">
                <tr>
                <td>
                    <img src="<?=$konfig['url']?>/assets/img/ikmi.png" width="250" height="250" alt="logo">
                </td>
                <td class="col-md-9">
                    <h2 class="text-center"><?=$konfig['perusahaan']?></h2>
                    <h3 class="text-center"><?=$konfig['alamat_perusahaan']?></h3>
                </td>
              </tr>
            </table>
        <br><br>
            </div>
      </div>
      <table>
            <tr>
                <td>Nama Pegawai</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td><td><?=$pegawai['nama']?></td>
            </tr>
            <tr>
                <td>Semester</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td><td><?=$ceknilai['semester']?></td>
            </tr>
            <tr>
                <td>Tahun</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td><td><?=$ceknilai['tahun']?></td>
            </tr>
    </table>
    <br><br>
            <table class="table table-condensed table-striped table-bordered">
                <thead>
                  <tr>
                    <th rowspan="2">#</th>
                    <th rowspan="2">Indikator</th>
                    <th colspan="2">Nilai</th>
                  </tr>
                  <tr>
                    <th>Angka</th>
                    <th>Sebutan</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  $no = 1;
                  $total = 0;
                  $sqls = $konek->query("SELECT * FROM penilaian WHERE nik='$_GET[nik]' AND semester='$_GET[semester]' AND tahun='$_GET[tahun]'"); 
                  $itungnilai = $sqls->num_rows;
                  while($rows = $sqls->fetch_array(MYSQLI_BOTH)){
                  $indikator = read('indikator','id_indikator',$rows['id_indikator'])->fetch_array(MYSQLI_BOTH);
                  $total += $rows['nilai'];
                  if ($rows['nilai'] >= 90) {
                    $mutu = 'A';
                  }elseif ($rows['nilai'] >= 75 && $rows['nilai'] <= 89) {
                    $mutu = 'B';
                  }elseif ($rows['nilai'] >= 60 && $rows['nilai'] <= 74) {
                    $mutu = 'C';
                  }elseif ($rows['nilai'] >= 40 && $rows['nilai'] <= 59) {
                    $mutu = 'D';
                  }elseif ($rows['nilai'] >= 00 && $rows['nilai'] <= 39) {
                    $mutu = 'E';
                  } ?>
                                            <tr>
                                                    <td><?=$no?></td>
                                                    <td><?=$indikator['nama_indikator']?></td>
                                                    <td><?=$rows['nilai']?></td>
                                                    <td><?=$mutu?></td>
                                                </tr>
                                      <?php
                                                $no++;
                                        }   
                          $rata = $total/$itungnilai;
                          if ($rata >= 90) {
                    $mutu = 'A';
                  }elseif ($rata >= 75 && $rata <= 89) {
                    $mutu = 'B';
                  }elseif ($rata >= 60 && $rata <= 74) {
                    $mutu = 'C';
                  }elseif ($rata >= 40 && $rata <= 59) {
                    $mutu = 'D';
                  }elseif ($rata >= 00 && $rata <= 39) {
                    $mutu = 'E';
                  }
                ?>
                <tr>
                  <td colspan="2">Jumlah</td>
                  <td colspan="2"><?=$total?></td>
                </tr>
                <tr>
                  <td colspan="2">Nilai Rata</td>
                  <td><?=$rata?></td>
                  <td><?=$mutu?></td>
                </tr>
            </tbody>
          </table>
          <br><br><br>
          <table border="1" cellpadding="5" cellspacing="10" width="400">
            <thead>
              <tr>
                <th>Angka</th>
                <th>Huruf Mutu</th>
                <th>Keterangan</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>90-100</td>
                <td>A</td>
                <td>Amat Baik</td>
              </tr>
              <tr>
                <td>75-89</td>
                <td>B</td>
                <td>Baik</td>
              </tr>
              <tr>
                <td>60-74</td>
                <td>C</td>
                <td>Cukup</td>
              </tr>
              <tr>
                <td>40-59</td>
                <td>D</td>
                <td>Kurang</td>
              </tr>
              <tr>
                <td>00-39</td>
                <td>E</td>
                <td>Sangat Kurang</td>
              </tr>
            </tbody>
          </table>
          <br>
  
        <div class="row">
            <div class="col-md-12">
                <div style="float: right;" align="center">
                  Cirebon, <?=strftime('%d %B %Y');?><br>
                  <?=$konfig['perusahaan']?><br><br><br><br>

                  <u><?=$konfig['nama_atasan']?></u><br>
                  Kepala
              </div>
            </div>
        </div>
  </div>
  </print>                    
                            <?php }else{ ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Error</strong> Data Tidak Di Temukan.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <?php } ?>
                            <?php } ?>