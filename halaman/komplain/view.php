		<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Komplain #<?=@$_GET['id']?></h1>
            <a href="<?=$konfig['url']?>/komplain.php" class="btn btn-sm btn-outline-danger">Table Data</a>
          </div>
          <?php
                        $ceknilai = $konek->query("SELECT * FROM penilaian WHERE id_sub_nilai='$_GET[id]' ORDER BY id_nilai DESC LIMIT 1");
                        $pecahnilai = $ceknilai->fetch_array(MYSQLI_BOTH);
                        $cekberat = $konek->query("SELECT * FROM keberatan WHERE id_sub_nilai='$_GET[id]' GROUP BY id_keberatan DESC LIMIT 1");
                        $itungpesan = $konek->query("SELECT * FROM keberatan WHERE id_sub_nilai='$_GET[id]'")->num_rows;
                        $pecahberat = $cekberat->fetch_array(MYSQLI_BOTH);

                            if ($pecahnilai['id_sub_nilai'] == $_GET['id']) {
                              
                              if ($pecahberat) {
                              
                            ?>
                            <!--Section: Comments-->
<section class="my-5">
  <!-- Card header -->
  <div class="card-header border-0 font-weight-bold"><?=$itungpesan?> Pesan</div>

    <?php
      $beraat = $konek->query("SELECT * FROM keberatan WHERE id_sub_nilai='$_GET[id]'");
      while ($row = $beraat->fetch_array(MYSQLI_BOTH)) {
        if ($row['status'] == 2) {
          update('keberatan', array('status' => 1),'id_keberatan',$row['id_keberatan']);
        }
        $nama = $konek->query("SELECT nama FROM pegawai WHERE nik=$pegawai[nik]")->fetch_array(MYSQLI_BOTH);
    ?>
  <div class="media d-block d-md-flex mt-4">
    <img class="card-img-64 d-flex mx-auto mb-3" src="<?=$konfig['url']?>/assets/img/profile.png" width="90" height="90">
    <div class="media-body text-center text-md-left ml-md-3 ml-0">
      <h5 class="font-weight-bold mt-0">
        <a href="#"><?=strtoupper($row['pengirim'] == 'admin' ? 'ADMIN' : ''.@$nama[nama].' (USER)')?></a>
      </h5>
        <h6 style="float: right;">
          <?=strftime('%d %B %Y', strtotime($row['tgl_kirim']))?> (<?=waktu($row['tgl_kirim'])?>)
        </h6>
      
      <p><?=$row['komplain']?></p>
    </div>
  </div>

                                  
                            <?php } ?>
                            <?php }else{ ?>
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                Belum Ada Pesan Komplain
                              </div>

                            <?php } ?>

                            <!-- Quick Reply -->
                            <form method="post">
                            <div class="form-group mt-4">
                              <label for="quickReplyFormComment">Pesan</label>
                              <input type="hidden" name="id_sub_nilai" value="<?=$_GET['id']?>">
                              <textarea class="form-control" name="keberatan" id="quickReplyFormComment" rows="5" required></textarea>

                              <div class="text-center my-4">
                                <button class="btn btn-primary btn-sm" name="kirimkeberatan" type="submit">Post</button>
                              </div>
                            </div>
                          </form>
                            </section>
                            <?php }else{ ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Error</strong> Data Tidak Di Temukan.
                              </div>
                              <?php } ?>