<?php 
	
	include "koneksi.php";
	include "functions.php";
	require 'cek-sesi.php';
	if($_SESSION['tipe'] === "Admin" ){
    	header("location:menuLaporan.php");
	}
	$mejaQuery = query("SELECT * FROM `meja` JOIN reservasi ON meja.id_reservasi = reservasi.id_reservasi");
	$orderListQuery = query("SELECT 
	meja.id_meja AS nomormeja,
	menu.nama AS namamenu,
	staff.nama AS namastaff,
	menu.harga AS Harga,
	order_list.quantity AS quantity,
	order_list.total AS total,
	order_list.ket AS keterangan,
	meja.status AS status
	FROM
	order_list JOIN meja 
		ON order_list.id_meja = meja.id_meja
	JOIN staff 
		ON order_list.id_staff = staff .id_staff
	JOIN menu 
		ON order_list.id_menu = menu.id_menu
		
	WHERE meja.status = 'aktif' AND order_list.no_transaksi = '0000000'
	ORDER BY order_list.id_order_list DESC");
	$session_value=(isset($_SESSION['tipe']))?$_SESSION['tipe']:''; 
 ?>
 <script type="text/javascript">
    var tipe='<?php echo $session_value;?>';
</script>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Home</title>
	 <!-- Bootstrap core CSS -->
	 <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="assets/styles/style.css">
	<link rel="stylesheet" href="assets/styles/sidebar.css">
</head>


<body>
<div class="d-flex" id="wrapper">
	<!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">Welcome , <?= $_SESSION['tipe'] ?> <?= $_SESSION['nama']  ?> </div>
      <div class="list-group list-group-flush">
        <a href="index.php" class="list-group-item list-group-item-action bg-light linkHome">Home</a>
        <a href="menu.php" class="list-group-item list-group-item-action bg-light linkPesan">Pesan</a>
        <a href="menuLaporan.php" class="list-group-item list-group-item-action bg-light linkLaporan">Laporan</a>
        <a href="logout.php" class="list-group-item list-group-item-action bg-light">logout</a>
	  </div>
    </div>
	<!-- /#sidebar-wrapper -->
	
	<!-- Page Content -->
    <div id="page-content-wrapper">

		<div class="container-fluid banner"></div>
		<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
			<button class="btn btn-info" id="menu-toggle">Toggle Menu</button>
			
			<button type="button" class="btn btn-info btnDenah ml-2" aria-pressed="false" autocomplete="off">
				Denah
			</button>
			<button type="button" class="btn btn-info btnOrderList ml-2" aria-pressed="false" autocomplete="off">
				Order List 
			</button>
		</nav>
		
		<!-- =============================== Denah ================================== -->
		<div class="container-fluid mt-3">
			<div class="legenda">
				<span style="
				display:inline-block;
				background-color:yellow;
				width:15px;height:15px;
				"></span>
				Kasir
				<br>
				<span style="
				display:inline-block;
				background-color:black;
				width:15px;height:15px;
				"></span>
				Pintu
				<br>
				<div class="aktif" style="display:inline-block;width:30px;height:30px; background-size: cover;"></div>
				Meja Aktif
				<br>
				<div class="kosong" style="display:inline-block;width:30px;height:30px; background-size: cover;"></div>
				Meja Kosong
				<br>
				<div class="reservasi" style="display:inline-block;width:30px;height:30px; background-size: cover;"></div>
				Meja Reservasi
			</div>
			<br>
			<div class="containerDenah">
				<div class="atas" style="border-bottom: 1px solid; padding:10px;"></div>
				<div class="kiri" style="border: 1px solid; padding:10px;"></div>
				<div class="bawah" style="border-top: 1px solid; padding:10px;"></div>
				<div class="kanan" style="border: 1px solid; padding:10px;"></div>
				<div class="tengah" style="border: 1px solid; padding:10px;"></div>
				<div class="tengah" style="border: 1px solid; padding:10px;"></div>
				<div class="tengah" style="border: 1px solid; padding:10px;"></div>
				<div class="tengah" style="border: 1px solid; padding:10px;"></div>
				<?php 
					foreach ($mejaQuery as $meja) {
						$status = $meja['status'];
						if ($meja['status'] === "kosong") {
							echo "<div class='meja $status mr-2' data-toggle='modal' data-id='".$meja['id_meja']."' data-status=$status data-target='#ModalAktif'><span class='id'>".$meja['id_meja']."</span></div>";
						}else if($meja['status'] === "reservasi"){
							echo "<div class='meja $status mr-2' data-toggle='modal' data-pelanggan='".$meja['nama_pelanggan']."' data-id='".$meja['id_meja']."' data-status=$status data-target='#ModalAktif'> <span class='id'>".$meja['id_meja']."</span></div>";
						}else{
							$menu = [];
							$id = $meja['id_meja'];
							$menuQuery = query("SELECT * FROM order_list JOIN menu ON order_list.id_menu = menu.id_menu WHERE id_meja = ".$meja['id_meja']." AND order_list.no_transaksi = '0000000'");
							$str = "";
							$a = 0;
							foreach ($menuQuery as $menus) {
								if ($a>0) {
									$str.=",";
								}
								$id = $menus['id_order_list'];
								$nama = preg_replace('/\s+/', '', $menus['nama']);
								$qt = $menus['quantity'];
								$total = $menus['total'];
								$ket = preg_replace('/\s+/', '', $menus['ket']);
								$str .= "{'id':'$id','nama':'$nama','quantity':$qt,'total':$total,'ket':'$ket'}";
								$a++;
							}
							echo "<div class='meja $status mr-2' data-id='".$meja['id_meja']."'  data-toggle='modal' data-target='#ModalAktif' data-status=$status data-menu=[$str] > <span class='id'>".$meja['id_meja']."</span></div>";
						}
					}
				?>
				<div style=" width: 250px; display:flex; justify-content: space-between;">
				<div style="width: 30%; height: 170px; display: inline-block; background-color: yellow;  "></div>
				<div style="width: 10%; height: 170px; display: inline-block; background-color: black;"></div>
				</div>
			</div>
		</div>
		<!-- =============================== Denah ================================== -->
					
	 
		
		<!-- =============================== OrderList ================================== -->
		<div class="container mt-3 containerOrderList" hidden>
				<table class="table">
					<thead class="thead-dark">
						<tr>
						<th scope="col">Nomor</th>
						<th scope="col">Nomor Meja</th>
						<th scope="col">Nama Menu</th>
						<th scope="col">Nama Staff</th>
						<th scope="col">Harga</th>
						<th scope="col">Quantity</th>
						<th scope="col">Total</th>
						<th scope="col">Keterangan</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no = 0;
						foreach($orderListQuery as $order){
							$no++;
							echo "<tr>
								<th scope='row'>$no</th>
								<td>".$order['nomormeja']."</td>
								<td>".$order['namamenu']."</td>
								<td>".$order['namastaff']."</td>
								<td>".$order['Harga']."</td>
								<td>".$order['quantity']."</td>
								<td>".$order['total']."</td>
								<td>".$order['keterangan']."</td>
							</tr>";
						} 
						?>
						
					</tbody>
					</table>

		</div>
		<!-- =============================== OrderList ================================== -->

	</div>
    <!-- /#page-content-wrapper -->


	<!-- Modal Pesanan Aktif -->
	<div class="modal fade" id="ModalAktif" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog " role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Order</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

				</div>
			</div>
		</div>
	</div>
	<!-- Modal Pesanan Aktif -->
</div>

</body>	

<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="scriptindex.js"></script>
<script>
if(tipe === "Koki" ){
    btnDenah.disabled = true;
    btnOrderList.disabled = true;
    containerDenah.hidden = true;
    containerLegenda.hidden = true;
	containerOrderList.hidden = false;
	document.querySelector(".linkLaporan").setAttribute("href", "#");
	document.querySelector(".linkPesan").setAttribute("href", "#");
  }else if(tipe === "Pelanggan"){
    btnDenah.disabled = true;
	btnOrderList.disabled = true;
	document.querySelector(".linkLaporan").setAttribute("href", "");
  }else if(tipe === "Pelayan"){
	document.querySelector(".linkLaporan").setAttribute("href", "");
  }

  document.addEventListener("click", (e)=>{
	if(e.target.classList.contains("linkPesan") && tipe === "Koki"){
		alert("Anda Tidak mempunyai Akses");
	}else if(e.target.classList.contains("linkLaporan") && (tipe === "Koki" || tipe === "Pelayan" || tipe === "Pelanggan")){
		alert("Anda Tidak mempunyai Akses");
	}
  });
</script>
</html>