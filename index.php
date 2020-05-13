<?php 
	
	include "koneksi.php";
	include "functions.php";
	$mejaQuery = query("SELECT * FROM `meja` JOIN reservasi ON meja.id_reservasi = reservasi.id_reservasi");
	

 ?>
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
      <div class="sidebar-heading">Welcome , user </div>
      <div class="list-group list-group-flush">
        <a href="index.php" class="list-group-item list-group-item-action bg-light">Home</a>
        <a href="menu.php" class="list-group-item list-group-item-action bg-light">Pesan</a>
        <a href="laporan.php" class="list-group-item list-group-item-action bg-light">Laporan</a>
      </div>
    </div>
	<!-- /#sidebar-wrapper -->
	
	<!-- Page Content -->
    <div id="page-content-wrapper">

		<div class="container-fluid banner"></div>
      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle">Toggle Menu</button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
		</button>
		<button>Denah</button>
		<button>Order List</button>
      </nav>

		<div class="container-fluid mt-3">
		<img src="">
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
						$menuQuery = query("SELECT * FROM order_list JOIN menu ON order_list.id_menu = menu.id_menu WHERE id_meja = ".$meja['id_meja']);
						$str = "";
						$a = 0;
						foreach ($menuQuery as $menus) {
							if ($a>0) {
								$str.=",";
							}
							// $nama = $menus['nama'];
							$nama = preg_replace('/\s+/', '', $menus['nama']);
							$qt = $menus['quantity'];
							$total = $menus['total'];
							$ket = preg_replace('/\s+/', '', $menus['ket']);
							$str .= "{'nama':'$nama','quantity':$qt,'total':$total,'ket':'$ket'}";
							$a++;
						}
						echo $str;
						echo "<div class='meja $status mr-2' data-id='".$meja['id_meja']."'  data-toggle='modal' data-target='#ModalAktif' data-status=$status data-menu=[$str] > <span class='id'>".$meja['id_meja']."</span></div>";
					}
				}
			?>
		</div>
	
	</div>
    <!-- /#page-content-wrapper -->


	<!-- Modal Pesanan Aktif -->
	<div class="modal fade" id="ModalAktif" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
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
no_transaksi 	id_order_list 	id_menu 	id_sumber 	tanggal 	harga 	quantity 	total 	kembalian 
<form action="cetakStruk.php" method="POST">
	
</form>

<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script>
	$("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
	
	// =======================   meja ===============================
	let rows = document.querySelectorAll(".meja");
	for (const row of rows) {
		row.addEventListener("click", async (e)=>{
			const modalBody = document.querySelector('.modal-body');
			
			let id = await row.dataset.id;
			let statusMeja = await row.dataset.status;
			if (statusMeja == "kosong") {
				console.log(id)
	            let	isi =`
<h3>Meja Masih kosong</h3>
<button type="button" class="btn btn-secondary reservasiToggle">Reservasi</button>
<a href="menu.php"><button type="button" class="btn btn-primary">Pesan</button></a>
<div class="formReservasi" hidden>
	<form action="reservasi.php" method="POST">
		<input type="hidden" name="id" value="${id}">
		<label for="no">Jam:</label>
		<input name="jam" type="text" class="form-control inputWaktu mt-3" placeholder="Jam" id="no">
		<input name="menit" type="text" class="form-control inputWaktu mt-3" placeholder="Menit">
		<br>
		<label for="nama">Nama</label>
    	<input name="nama" type="text" class="form-control" id="nama" placeholder="Nama Pelanggan">
		<label for="no">No Telepon</label>
    	<input name="no" type="text" class="form-control" id="no" placeholder="Nomor Telepon">
		<button name="submit" class="btn btn-primary mt-3">submit</button>
	</form>
</div>`; 
	            modalBody.innerHTML = isi;
				let reservasiToggle = document.querySelector(".reservasiToggle")
				reservasiToggle.addEventListener('click', function(){
					document.querySelector(".formReservasi").toggleAttribute('hidden');
				})
			}else if(statusMeja == "aktif"){
				let data = await row.dataset.menu;
				console.log(data);
				data = data.replace(/\'/g, '"');
				const menu = JSON.parse(data)
				console.log(menu)
				let isi = "";
	            for (makan of menu) {
	            	isi +=`Pesan : ${makan.nama},jumlah : ${makan.quantity},total : ${makan.total},keterangan : ${makan.ket}`; 
	            }
	            modalBody.innerHTML = isi;
			}else if(statusMeja == "reservasi"){
				let nama_pelanggan = await row.dataset.pelanggan;
				let	isi =`
<h3>Meja Reservasi Milik ${nama_pelanggan}</h3>
<a href="menu.php"><button type="button" class="btn btn-primary">Pesan</button></a>`; 
	            modalBody.innerHTML = isi;
			}
		})
	}
</script>
</html>