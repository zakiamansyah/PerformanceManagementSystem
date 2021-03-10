<?php
date_default_timezone_set("Asia/Jakarta");
setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
session_start();
include '../func/func.php';
$konfig = konfig();
$konek = koneksi();
if(!isset($_SESSION['username'])) {
    header('location:'.$konfig['url'].'/login.php');
}elseif ($_SESSION['level'] == '2') {
    header('location:'.$konfig['url'].'/kepala/index.php');
}elseif ($_SESSION['level'] == '3') {
    header('location:'.$konfig['url'].'/index.php');
}
$komplain = $konek->query("SELECT * FROM keberatan WHERE status='0'")->num_rows;
?>


<!doctype html>
<html lang="en">
  <head>
  <title><?=$konfig['judul']?></title>
  <link rel="stylesheet" type="text/css" href="<?=$konfig['url']?>/assets/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="<?=$konfig['url']?>/assets/css/style.css">
  <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css">
  <link rel="stylesheet" type="text/css" href="<?=$konfig['url']?>/assets/sa/sweetalert.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">
  <style type="text/css">.asteriskField{color: red;}</style>
</head>

  <body class="fixed-sn indigo-skin">
  <!--Main Navigation-->
    <header>

        <!-- Sidebar navigation -->
        <div id="slide-out" class="side-nav sn-bg-4 fixed">
            <ul class="custom-scrollbar">
            <li>
                <ul class="collapsible collapsible-accordion">
                    <li><a href="<?=$konfig['url']?>/admin/index.php" class="collapsible-header waves-effect"><i class="fa fa-home"></i>Dashboard</a></li>
                    <li><a href="<?=$konfig['url']?>/admin/indikator.php" class="collapsible-header waves-effect active"><i class="fa fa-plus"></i>Indikator</a></li>
                    <li><a href="<?=$konfig['url']?>/admin/pegawai.php" class="collapsible-header waves-effect"><i class="fa fa-users"></i>Pegawai</a></li>
                    <li><a href="<?=$konfig['url']?>/admin/nilai.php" class="collapsible-header waves-effect"><i class="fa fa-list"></i>Nilai</a></li>
                    <li><a href="<?=$konfig['url']?>/admin/komplain.php" class="collapsible-header waves-effect"><i class="fa fa-minus"></i><?php if ($komplain != 0) { echo'<span class="badge badge-warning">'.$komplain.'</span>'; } ?> Komplain</a></li>
                </ul>
            </li>
            <!--/. Side navigation links -->
            </ul>
            <div class="sidenav-bg mask-strong"></div>
        </div>
        <!--/. Sidebar navigation -->

        <!-- Navbar -->
        <nav class="navbar fixed-top navbar-expand-lg scrolling-navbar double-nav">
            <!-- SideNav slide-out button -->
            <div class="float-left">
                <a href="#" data-activates="slide-out" class="button-collapse black-text"><i class="fa fa-bars"></i></a>
            </div>
            <div class="breadcrumb-dn mr-auto">
                <p><?=$konfig['judul']?></p>
            </div>
            <ul class="nav navbar-nav nav-flex-icons ml-auto">
                <li class="nav-item">
                    <a class="nav-link waves-effect" href="<?=$konfig['url']?>/out.php"><i class="fa fa-sign-out-alt"></i></a>
                </li>

            </ul>
            <!--/Navbar links-->
        </nav>
        <!-- /.Navbar -->

    </header>

          <!--Main Navigation-->
          <main>
              <div class="container">
                <section class="section card mt-lg-5">
                  <div class="card-body">
                    <div class="row">
                      <div class="col" id="reload">
        	<?php
        		if (@$_GET['page'] == 'tambah') {
        			include 'halaman/indikator/tambah.php';
        		}elseif (@$_GET['page'] == 'update' && @$_GET['id']) {
        			$read = read('indikator','id_indikator',$_GET['id']);
        			$row = $read->fetch_array(MYSQLI_BOTH);
        			include 'halaman/indikator/update.php';
        		}elseif (@$_GET['page'] == 'cetak') {
        			include 'halaman/indikator/cetak.php';
        		}else{
        	?>

          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Data Indikator</h1>
            <div class="btn-group mr-2">
              <a href="<?=$konfig['url']?>/admin/indikator.php" class="btn btn-sm btn-danger active">Tabel Data</a>
              <a href="?page=tambah" class="btn btn-sm btn-outline-danger">Tambah Data</a>
            </div>
          </div>

          <div class="table-responsive">
            <table id="tablee" class="table table-striped table-bordered">
            	<thead>
            		<tr>
            			<td>#</td>
            			<td>ID</td>
            			<td>Nama</td>
            			<td>Aksi</td>
            		</tr>
            	</thead>
            	<tbody>
            		<?php
            		$no = 1;
            		$indikator = read("indikator");
            		while ($row = $indikator->fetch_array(MYSQLI_BOTH)) {?>
            		<tr>
            			<td><?=$no?></td>
            			<td><?=$row['id_indikator']?></td>
            			<td><?=$row['nama_indikator']?></td>
            			<td><a href="#" class="btn btn-danger" onclick='deletedata("<?=$row['id_indikator']?>")'>Hapus</a> <a href="?page=update&id=<?=$row['id_indikator']?>" class="btn btn-info">Update</a></td>
            		</tr>
            		<?php $no++; }?>
            	</tbody>
            </table>
        </div>
        <?php } ?>
                  </div>
              </div>
            </section>
    </main>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript" src="<?=$konfig['url']?>/assets/js/jquery-2.1.0.js"></script>
    <script type="text/javascript" src="<?=$konfig['url']?>/assets/js/compiled.min.js"></script>
    <script type="text/javascript" src="<?=$konfig['url']?>/assets/bootstrap/popper.min.js"></script>
    <script type="text/javascript" src="<?=$konfig['url']?>/assets/bootstrap/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?=$konfig['url']?>/assets/sa/sweetalert.min.js"></script>
	<script type="text/javascript" src="<?=$konfig['url']?>/assets/sa/sweetalert-dev.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
	<script type="text/javascript" src="<?=$konfig['url']?>/assets/js/jquery.PrintArea.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			    $('#tablee').DataTable();
			} );

    // SideNav Initialization
        $(".button-collapse").sideNav();

        var container = document.querySelector('.custom-scrollbar');
        Ps.initialize(container, {
            wheelSpeed: 2,
            wheelPropagation: true,
            minScrollbarLength: 20
        });

        // Data Picker Initialization
        $('.datepicker').pickadate();

        // Material Select Initialization
        $(document).ready(function () {
            $('.mdb-select').material_select();
        });

        // Tooltips Initialization
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
	</script>
	<script>
    $(document).ready(function(){
        $("#cetak").click(function(){
            var mode = 'iframe'; //popup
            var close = mode == "popup";
            var options = { mode : mode, popClose : close};
            $("print#areaprint").printArea( options );
        });
    });
    </script>
    <script>
    function deletedata(str){
      var id = str;
      swal({
  title: "Peringatan!!",
  text: "Apa Anda Yakin Ingin Menghapus Data Ini??",
  type: "warning",
  showCancelButton: true,
  closeOnConfirm: false,
  showLoaderOnConfirm: true,
},function(){
          
      $.ajax({
         type: "POST",
         dataType: "json",
         url: "<?=$konfig['url']?>/admin/halaman/indikator/delete.php?i="+id
      }).done(function( data ) {
      	if (data.status == 'sukses') {
        $("#reload").load(location.href + " #reload");
        swal("Berhasil!", "Berhasil dihapus", "success");
    	} else {
    	swal("Gagal!", "Gagal dihapus", "error");
    	}
      setTimeout(function(){
        location.reload();
        }, 2000);
		});
      
    });
  }
  </script>
  </body>
</html>
