<?php
date_default_timezone_set("Asia/Jakarta");
setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
session_start();
include 'func/func.php';
$konfig = konfig();
$konek = koneksi();
if(!isset($_SESSION['username'])) {
    header('location:'.$konfig['url'].'/login.php');
}elseif ($_SESSION['level'] == '1') {
    header('location:'.$konfig['url'].'/admin/index.php');
}elseif ($_SESSION['level'] == '2') {
    header('location:'.$konfig['url'].'/kepala/index.php');
}
$pegawai = $konek->query("SELECT * FROM pegawai WHERE nik='$_SESSION[username]'")->fetch_array(MYSQLI_BOTH);
$komplain = $konek->query("SELECT * FROM keberatan WHERE status='2'")->num_rows;
?>

<!DOCTYPE html>
<html>
<head>
  <title><?=$konfig['judul']?></title>
  <link rel="stylesheet" type="text/css" href="<?=$konfig['url']?>/assets/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="<?=$konfig['url']?>/assets/css/style.css">
  <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css">
</head>
<body class="fixed-sn indigo-skin">
  <!--Main Navigation-->
    <header>

        <!-- Sidebar navigation -->
        <div id="slide-out" class="side-nav sn-bg-4 fixed">
            <ul class="custom-scrollbar">
            <li>
                <ul class="collapsible collapsible-accordion">
                  <li><a href="<?=$konfig['url']?>/index.php" class="collapsible-header waves-effect"><i class="fa fa-home"></i>Dashboard</a></li>
                    <li><a href="<?=$konfig['url']?>/nilai.php" class="collapsible-header waves-effect active"><i class="fa fa-list"></i>Nilai</a></li>
                    <li><a href="<?=$konfig['url']?>/komplain.php" class="collapsible-header waves-effect"><i class="fa fa-minus"></i><?php if ($komplain != 0) { echo'<span class="badge badge-warning">'.$komplain.'</span>'; } ?> Komplain</a></li>
                    <li><a href="<?=$konfig['url']?>/profile.php" class="collapsible-header waves-effect"><i class="fa fa-user"></i>Profile</a></li>
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
        		if (@$_GET['page'] == 'view' && @$_GET['nik'] && @$_GET['semester'] && @$_GET['tahun'] ) {
        			include 'halaman/nilai/view.php';
        		}else{
        	?>

          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Data Nilai</h1>
          </div>

          <div class="table-responsive">
            <table id="tablee" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <td>#</td>
                  <td>Semester</td>
                  <td>Tahun</td>
                  <td>Aksi</td>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                $nilai = $konek->query("SELECT * FROM penilaian WHERE nik=$pegawai[nik] GROUP BY id_sub_nilai");
                while ($row = $nilai->fetch_array(MYSQLI_BOTH)) {
                ?>
                <tr>
                  <td><?=$no?></td>
                  <td><?=$row['semester']?></td>
                  <td><?=$row['tahun']?></td>
                  <td><a href="?page=view&nik=<?=$row['nik']?>&semester=<?=$row['semester']?>&tahun=<?=$row['tahun']?>" class="btn btn-info">Lihat Nilai</a></td>
                </tr>
                <?php $no++; }?>
              </tbody>
            </table>
        </div>
                            
        <?php } ?>
                  </div>
                  </div>
              </div>
            </section>
    </main>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript" src="<?=$konfig['url']?>/assets/js/jquery-2.1.0.js"></script>
    <script type="text/javascript" src="<?=$konfig['url']?>/assets/bootstrap/bootstrap.min.js"></script>
  <script type="text/javascript" src="<?=$konfig['url']?>/assets/js/compiled.min.js"></script>
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
  </body>
</html>
