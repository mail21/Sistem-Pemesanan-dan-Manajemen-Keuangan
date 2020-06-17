<?php 
	include "koneksi.php";
	include "functions.php";
	require 'cek-sesi.php';

	$_GET['from'] = !empty($_GET['from']) && is_string($_GET['from']) ? $_GET['from'] : '';
	$_GET['izin'] = !empty($_GET['izin']) && is_string($_GET['izin']) ? $_GET['izin'] : 'false';
	if($_GET['from'] == 'reservasi'){
		$_GET['jamreservasi'] = !empty($_GET['jamreservasi']) && is_string($_GET['jamreservasi']) ? $_GET['jamreservasi'] : '';

		$_GET['idReservasi'] = !empty($_GET['idReservasi']) && is_string($_GET['idReservasi']) ? $_GET['idReservasi'] : '1';
		$_GET['antrian'] = !empty($_GET['antrian']) && is_string($_GET['antrian']) ? $_GET['antrian'] : '';
		if($_GET['idReservasi'] == "undefined" || $_GET['antrian'] ==""){
			$_GET['idReservasi'] = "1";
			mysqli_query($db,"UPDATE meja SET id_reservasi ='".$_GET['idReservasi']."' , antrian ='".$_GET['antrian']."',status = 'kosong'  WHERE id_meja ='".$_GET['meja']."' ");
		}else{
			mysqli_query($db,"UPDATE meja SET id_reservasi ='".$_GET['idReservasi']."' , antrian ='".$_GET['antrian']."'  WHERE id_meja ='".$_GET['meja']."' ");
		}
		
		
	
		$jamBerapaSkrng =  query("SELECT TIME_FORMAT(NOW(), '%H') AS time ");
		
		if($_GET['jamreservasi'] != $jamBerapaSkrng[0]['time'] && $_SESSION['tipe'] != "Pelayan" ){
			echo "<script>
			alert('Anda belum bisa melakukan pemesanan sekarang');
			window.location= 'index.php'
			</script>";
		}
	}
	$_GET['meja'] = !empty($_GET['meja']) && is_string($_GET['meja']) ? $_GET['meja'] : '';

	if($_SESSION['tipe'] === "Koki"){
		header("location:index.php");
	}
	$boxMeja = query("SELECT * FROM reservasi JOIN meja ON reservasi.id_reservasi = meja.id_reservasi");
	$boxMenu = query("SELECT * FROM menu");

	$strMeja = "";
	$b = 0;
	foreach ($boxMeja as $MEJA) {
		if($b>0){
			$strMeja .= ",";
	 	}	
		$id_meja = $MEJA['id_meja'];
		$nama_pelanggan = preg_replace('/\s+/', '', $MEJA['nama_pelanggan']);
		$id_reservasi = $MEJA['id_reservasi'];
		$status = $MEJA['status'];
		$strMeja .= "{'id_meja':'$id_meja','nama_pelanggan':'$nama_pelanggan','id_reservasi':$id_reservasi,'status':'$status'}";
		$b++;	
	}
	$session_value=(isset($_SESSION['tipe']))?$_SESSION['tipe']:''; 
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Menu </title>
  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/styles/style.css">
  <link rel="stylesheet" href="assets/styles/sidebar.css">
</head>
<script type="text/javascript">
	var tipe='<?php echo $session_value;?>';
	var izin="<?php echo $_GET['izin'];?>";
	var mejaGET="<?php echo $_GET['meja'];?>";
</script>
<style>	
	.menu{
		display: flex;
		justify-content: space-around;
	}

	menu-item{
		margin: 5px 0;
		display: inline-block;
		width: auto;
	}
	
	#input_div{
		display: flex;
		align-items: center;
		justify-content: center;
	}

	#total{
		text-align: center;
		border: none;
		background: white;
		color:black;
		font-size: 2em;
		margin: auto;
	}

	#count{
		border: none;
		background: white;
		width: 40px;
		color:black;
		font-size: 2em;
	}

	.btnInput{
		cursor: pointer;
		display: inline-block;
		width: 40px;
		border: 1px solid;
		border-radius: 40%;
		text-align: center;
		font-size: 20px;
		background-color: lightblue;
	}

	.buttonSubmit{
		width: 49%;
	}

</style>

<body>

<div class="d-flex" id="wrapper">
	<!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">Welcome ,<br><?= $_SESSION['tipe'] ?> <?= $_SESSION['nama'] ?>  </div>
      <div class="list-group list-group-flush">
	  <a href="index.php" class="list-group-item list-group-item-action bg-light linkHome">Home</a>
        <a href="menu.php" class="list-group-item list-group-item-action bg-light linkPesan">Pesan</a>
		<?php if($session_value === "Admin"): ?>
			<a href="menuLaporan.php" class="list-group-item list-group-item-action bg-light linkLaporan">Laporan</a>
			<a href="halamanStaff.php" class="list-group-item list-group-item-action bg-light linkLaporan">Staff</a>
		<?php endif; ?>  
		<a href="logout.php" class="list-group-item list-group-item-action bg-light">logout</a>
	</div>
    </div>
	<!-- /#sidebar-wrapper -->
	
	<!-- Page Content -->
    <div id="page-content-wrapper">

		<div class="container-fluid banner"></div>
      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-info" id="menu-toggle">Toggle Menu</button>

      </nav>

      
	  <div class="container">
		  <?php 
			echo "<input type='hidden' id='hiddenMeja' value=[$strMeja]>";
			foreach ($boxMenu as $menuData) {
				
				echo "
				<div class='row menu mt-3' style='border : 1px solid' data-toggle='modal' data-target='#ModalMenu'>
				  <menu-item> ".$menuData['id_menu'] ." </menu-item>
				  <menu-item> ".$menuData['nama'] ."</menu-item>
				  <menu-item> Rp. ".$menuData['harga'] ."</menu-item>
				  <menu-item> <img src='./assets/image/". $menuData['gambar'] ."' width='200' ></menu-item>
				</div>";
			}
		   ?>
		   
	  </div>

    </div>
    <!-- /#page-content-wrapper -->


	

	<!-- Modal Pesanan-->
	<div class="modal fade" id="ModalMenu" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Pesan </h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body m-3">
	      </div>
	    </div>
	  </div>
	</div>
	<!-- Modal Pesanan-->	

</div>

</body>
<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="scriptMenu.js"></script>

</html>