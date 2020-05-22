
<?php 
	
	include "koneksi.php";
	include "functions.php";
	require 'cek-sesi.php';
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
      <div class="sidebar-heading">Welcome , <?= $_SESSION['nama'] ?> </div>
      <div class="list-group list-group-flush">
        <a href="index.php" class="list-group-item list-group-item-action bg-light">Home</a>
        <a href="menu.php" class="list-group-item list-group-item-action bg-light">Pesan</a>
        <a href="menuLaporan.php" class="list-group-item list-group-item-action bg-light">Laporan</a>
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
				<div class="atas"></div>
				<div class="kiri"></div>
				<div class="bawah"></div>
				<div class="kanan"></div>
				<div class="tengah"></div>
				<div class="tengah"></div>
				<div class="tengah"></div>
				<div class="tengah"></div>
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
<script>
	$("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });

	const btnDenah = document.querySelector('.btnDenah');
	const  btnOrderList = document.querySelector('.btnOrderList');
	const containerDenah = document.querySelector('.containerDenah');
	const allMeja = document.querySelectorAll('.meja');
	let index = 1;
	const mejaAtas = document.querySelector(".atas");
	const mejaBawah = document.querySelector(".bawah");
	const mejaKiri = document.querySelector(".kiri");
	const mejaKanan = document.querySelector(".kanan");
	const mejaTengah = document.querySelectorAll(".tengah");
	for (let meja of allMeja) {
		if(index <= 4){
			mejaAtas.appendChild(meja);
		}else if(index <= 8){
			mejaBawah.appendChild(meja);
		}else if(index <= 10){
			mejaKiri.appendChild(meja);
		}else if(index <= 12){
			mejaKanan.appendChild(meja);
		}else if(index <= 14){
			mejaTengah[0].appendChild(meja);
		}else if(index <= 16){
			mejaTengah[1].appendChild(meja);
		}else if(index <= 18){
			mejaTengah[2].appendChild(meja);
		}else if(index <= 20){
			mejaTengah[3].appendChild(meja);
		}
		index++;
	}

	const containerOrderList = document.querySelector('.containerOrderList');
	const containerLegenda = document.querySelector(".legenda");
	btnDenah.addEventListener("click", ()=>{
		containerDenah.toggleAttribute('hidden');
		containerOrderList.toggleAttribute('hidden');
		containerLegenda.toggleAttribute('hidden');

	});
	btnOrderList.addEventListener("click", ()=>{
		containerDenah.toggleAttribute('hidden');
		containerOrderList.toggleAttribute('hidden');
		containerLegenda.toggleAttribute('hidden');
	})
	
	// =======================   meja ===============================
	let rows = document.querySelectorAll(".meja");
	for (const row of rows) {
		row.addEventListener("click", async (e)=>{
			const modalBody = document.querySelector('.modal-body');
			const modalTitle = document.querySelector('.modal-title');
			document.querySelector('.modal-dialog').classList.remove('modal-lg');
			let id_meja = await row.dataset.id;
			let statusMeja = await row.dataset.status;
			if (statusMeja == "kosong") {
	            let	isi =`
<h3>Meja Masih kosong</h3>
<button type="button" class="btn btn-secondary reservasiToggle">Reservasi</button>
<a href="menu.php"><button type="button" class="btn btn-primary">Pesan</button></a>
<div class="formReservasi" hidden>
	<form action="reservasi.php" method="POST">
		<input type="hidden" name="id" value="${id_meja}">
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
				modalTitle.textContent = `Meja ${id_meja}`;
				let reservasiToggle = document.querySelector(".reservasiToggle")
				reservasiToggle.addEventListener('click', function(){
					document.querySelector(".formReservasi").toggleAttribute('hidden');
				})
			}else if(statusMeja == "aktif"){
				document.querySelector('.modal-dialog').classList.add('modal-lg');
				let data = await row.dataset.menu;
				console.log(id_meja)
				console.log(data);
				data = data.replace(/\'/g, '"');
				const menu = JSON.parse(data);
				modalTitle.textContent = `Meja ${id_meja}`;
				let isi = `
		<form action="cetakStruk.php" method="POST">
		<a href="menu.php"><button type="button" class="btn btn-primary mb-3">Pesan</button></a>
			<input type="hidden" name="idSumber" value="1">
		<input type="hidden" name="id_meja" value="${id_meja}">
			<table class="mb-3" cellpadding="6">`;
				let ket = 'Keterangan : <br>';
				let totalOrder = 0;
	            for (makan of menu) {
					totalOrder += makan.total;
					ket += `- ${makan.ket}<br>`
					isi += `
					<tr>
						<td>${makan.id}</td>
						<td>${makan.nama}</td>
						<td>${makan.quantity} Porsi</td>
						<td>${makan.total}</td>
					</tr>`;
	            }
				isi += `<tr style="border-top:1px solid;"><td colspan="3" align="right">Total :</td><td align="right">${totalOrder}</td></tr>`;
				isi += `<tr><td colspan="4">${ket}</td></tr></table>`;
				isi += `
				<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo">Input Uang</button>
				<button type="submit" disabled id="btnKonfirmasi" class="btn btn-info">Konfirmasi Bayar</button>
				<div id="demo" class="collapse">
				<input id="inputUang" name="inputUang" type="text" class="form-control mt-3" placeholder="Masukkan Pembayaran">
				</div> 
				<input type="hidden" name="total" value="${totalOrder}">
				</form>
				`;
	            modalBody.innerHTML = isi;
				const inputUang = document.querySelector("#inputUang");
				inputUang.addEventListener("input",(e)=>{
					if(inputUang.value >= totalOrder){
						document.querySelector('#btnKonfirmasi').disabled = false;
					}else{
						document.querySelector('#btnKonfirmasi').disabled = true;
					}
				})
			}else if(statusMeja == "reservasi"){
				let nama_pelanggan = await row.dataset.pelanggan;
				modalTitle.textContent = `Meja ${id_meja}`;
				let	isi =`
		<h3>Meja Reservasi Milik ${nama_pelanggan}</h3>
		<a href="menu.php"><button type="button" class="btn btn-primary">Pesan</button></a>
		<a href="kosong.php?nama='${nama_pelanggan}'"><button type="button" class="btn btn-primary">Kosongkan</button></a>`;
	            modalBody.innerHTML = isi;
			}
		})
	}
</script>
</html>