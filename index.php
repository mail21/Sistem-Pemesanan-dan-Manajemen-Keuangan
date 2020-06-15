<?php 
	
	include "koneksi.php";
	include "functions.php";
	require 'cek-sesi.php';
	$mejaQuery = query("SELECT * FROM `meja` JOIN reservasi ON meja.id_reservasi = reservasi.id_reservasi ORDER BY id_meja ASC");
	$orderListQuery = query("SELECT 
	meja.id_meja AS nomormeja,
	menu.nama AS namamenu,
	user.nama AS namauser,
	menu.harga AS Harga,
	order_list.siap AS siap,
	order_list.saji AS saji,
	order_list.id_order_list AS idOrder,
	order_list.quantity AS quantity,
	order_list.total AS total,
	order_list.ket AS keterangan,
	meja.status AS status
	FROM
	order_list JOIN meja 
		ON order_list.id_meja = meja.id_meja
	JOIN user 
		ON order_list.id_user = user.id_user
	JOIN menu 
		ON order_list.id_menu = menu.id_menu
		
	WHERE meja.status = 'aktif' AND order_list.no_transaksi = '0000000'
	ORDER BY order_list.id_order_list DESC");
	$session_value=(isset($_SESSION['tipe']))?$_SESSION['tipe']:''; 
	$session_nama = (isset($_SESSION['nama']))? $_SESSION['nama']:'';
	$session_email = (isset($_SESSION['email']))? $_SESSION['email']:'';
	if($_SESSION['tipe'] == "Pelanggan"){
		$userQuery = mysqli_query($db,"select jam from reservasi WHERE reservasi.id_user = '".$_SESSION['id_user']."' AND reservasi.tanggal_reservasi = DATE(NOW()) ");
	
		if(mysqli_num_rows($userQuery) != 0){
			$userQuery = query("select jam from reservasi WHERE reservasi.id_user = '".$_SESSION['id_user']."' AND reservasi.tanggal_reservasi = DATE(NOW()) ");
			$jamreservasiandaPHP = substr($userQuery[0]['jam'],0,2);
		}
	}
	
	if(!isset($jamreservasiandaPHP)){
		$jamreservasiandaPHP = "NULL";
	}
 ?>
 <script type="text/javascript">
	var tipe='<?php echo $session_value;?>';
	var namaSession='<?php echo $session_nama;?>';
	var emailSession='<?php echo $session_email;?>';
	var jamreservasianda = '<?php echo $jamreservasiandaPHP?>' ;

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
      <div class="sidebar-heading">Welcome , <br> <?= $_SESSION['tipe'] ?> <?= $_SESSION['nama']  ?> </div>
      <div class="list-group list-group-flush">
        <a href="index.php" class="list-group-item list-group-item-action bg-light linkHome">Home</a>
		<?php if($session_value != "Koki"): ?>
			<a href="menu.php" class="list-group-item list-group-item-action bg-light linkPesan">Pesan</a>
		<?php endif; ?>  
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
							$strReservasi = "";
							$mejaAntrian = explode(",",$meja['antrian']);
							$mejaAntrianLength = count($mejaAntrian);
							$x = $mejaAntrianLength;
							for ($i=0; $i < $mejaAntrianLength ; $i++) {
								
								$reservasiQuery = query("SELECT nama_pelanggan,jam,antrian FROM reservasi JOIN meja ON meja.id_reservasi = reservasi.id_reservasi WHERE reservasi.id_reservasi = ".$mejaAntrian[$i]);
								foreach ($reservasiQuery as $x) {
									$b = 0;
									$listAntriFromDb = explode(",",$x['antrian']);
									// echo "===================<br>";
									// $datamysqlantrian = $x['antrian'];
									// echo "<br>";
									foreach ($listAntriFromDb as $y) {
										if ($b>0) {
											$strReservasi.=",";
										}
										
										$Query = query("SELECT id_reservasi,nama_pelanggan,jam FROM reservasi WHERE id_reservasi = $y");
										$idreservasiforjs = $Query[0]["id_reservasi"];
										$nama_pel = $ket = preg_replace('/\s+/', '', $Query[0]["nama_pelanggan"]);
										$jam = $Query[0]["jam"];
										$strReservasi .= "{'id':'$idreservasiforjs','nama':'$nama_pel','jam':'$jam'}";
										$b++;
									}
									echo "<div style='width:90px;' class='meja $status mr-2' data-datareservasi=[$strReservasi] data-id='".$meja['id_meja']."' data-antrian='".$meja['antrian']."' data-toggle='modal' data-pelanggan='".$meja['nama_pelanggan']."' data-status=$status data-target='#ModalAktif'> <span class='id'>".$meja['id_meja']."</span></div>";
									$strReservasi = '';
								}
								
							}
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
							echo "<div class='meja $status mr-2' data-id='".$meja['id_meja']."' data-toggle='modal' data-target='#ModalAktif' data-status=$status data-menu=[$str] > <span class='id'>".$meja['id_meja']."</span></div>";
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
				<table class="table table-striped table-dark">
					<thead class="thead-dark">
						<tr>
						<th scope="col">Nomor</th>
						<th scope="col">Sudah Siap?</th>
						<th scope="col">Sudah disajikan?</th>
						<th scope="col">Nomor Meja</th>
						<th scope="col">Nama Menu</th>
						<th scope="col">Quantity</th>
						<th scope="col">Keterangan</th>
						
						</tr>
					</thead>
					<tbody>
						<?php
						$no = 0;
						foreach($orderListQuery as $order){
							$no++;
							echo "<tr>
								<th scope='row'>$no</th>";
								if($order['siap'] == "1"){
									echo "<td><a href='#'><button class='btn btn-success btnSiap'>Ready</button></a></td>";
								}else{
									echo "<td><a href='siap.php?siap=1&id=".$order['idOrder']."'><button class='btn btn-danger btnSiap'>Not Ready</button></a></td>";

								}

								if($order['saji'] == "1"){
									echo "<td><a href='#'><button class='btn btn-success btnSaji'>Ready</button></a></td>";
								}else{
									echo "<td><a href='siap.php?saji=1&id=".$order['idOrder']."'><button class='btn btn-danger btnSaji'>Not Ready</button></a></td>";
								}
							echo"<td>".$order['nomormeja']."</td>
								<td>".$order['namamenu']."</td>
								<td>".$order['quantity']."</td>
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
let btnSiap = document.querySelectorAll('.btnSiap');
for (let iterator of btnSiap) {
	iterator.addEventListener("click", ()=>{
		if(tipe != "Koki"){
			alert("Anda Tidak mempunyai hak");	
		}
	});
	
}

let btnSaji = document.querySelectorAll('.btnSaji');
for (let iterator2 of btnSaji) {
	iterator2.addEventListener("click", ()=>{
		if(tipe != "Pelayan"){
			alert("Anda Tidak mempunyai hak");	
		}
	});
	
}
    
if(tipe === "Koki" ){
    btnDenah.hidden = true;
    btnOrderList.hidden = true;
    containerDenah.hidden = true;
    containerLegenda.hidden = true;
	containerOrderList.hidden = false;
	document.querySelector(".linkLaporan").setAttribute("href", "#");
	document.querySelector(".linkPesan").setAttribute("href", "#");
  }else if(tipe === "Pelanggan"){
    btnDenah.hidden = true;
	btnOrderList.hidden = true;
}else if(tipe === "Admin" ){
    btnDenah.hidden = true;
    btnOrderList.hidden = true;
    containerDenah.hidden = true;
    containerLegenda.hidden = true;
	containerOrderList.hidden = false;
  }

</script>
</html>