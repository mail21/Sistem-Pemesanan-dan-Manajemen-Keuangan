<?php 
	
	include "koneksi.php";

	$query = mysqli_query($db,"SELECT * FROM meja");
	while ($query2 = mysqli_fetch_assoc($query)) {
		$box[] = $query2;
	}

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
      </nav>
	

		<div class="container-fluid">
			<?php 
				foreach ($box as $meja) {
					if ($meja['status'] === "kosong") {
						echo "<div class='meja mr-2 btn-secondary' data-id='".$meja['id_meja']."' data-toggle='modal' data-target='#ModalAktif'> <span class='id'>".$meja['id_meja']."</span>". $meja['status'] ."</div>";	
					}else if($meja['status'] === "reservasi"){
						echo "<div class='meja mr-2 btn-primary' data-toggle='modal' data-target='#ModalAktif'> <span class='id'>".$meja['id_meja']."</span>". $meja['status'] ."</div>";
					}else{
						$menu = [];
						$id = $meja['id_meja'];
						$menuQuery = mysqli_query($db,"SELECT * FROM order_list JOIN menu ON order_list.id_menu = menu.id_menu WHERE id_meja = ".$meja['id_meja']);
						while ($query3 = mysqli_fetch_assoc($menuQuery)) {
							$menu[] = $query3;
						}
						$str = "";
						$a = 0;
						foreach ($menu as $menus) {
							if ($a>0) {
								$str .=",";
							}
							$nama = $menus['nama'];
							$qt = $menus['quantity'];
							$total = $menus['total'];
							$ket = preg_replace('/\s+/', '', $menus['ket']);
						$str .= "{'nama':'$nama','quantity':$qt,'total':$total,'ket':'$ket'}";
							// echo $menus['nama'];
							// echo $menus['quantity'];
							// echo $menus['total'];
							// echo $menus['ket'];
						$a++;
						}
						echo $str;
						echo "<div class='meja mr-2 btn-warning' data-toggle='modal' data-target='#ModalAktif'  data-menu=[$str]> <span class='id'>".$meja['id_meja']."</span>". $meja['status'] ."</div>";
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
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			<button type="button" class="btn btn-primary">Save changes</button>
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
	
	// =======================   meja ===============================
	let rows = document.querySelectorAll(".meja");
	const id_meja = document.querySelectorAll(".id");
	for (const row of rows) {
		row.addEventListener("click", async (e)=>{
			

			const modalBody = document.querySelector('.modal-body');
			let data = await row.dataset.menu;
			let id = await row.dataset.id;
			if (data == undefined) {
				console.log("yes")
				console.log(id)
	            let	isi =`
<h3>Meja Masih kosong</h3>
<button type="button" class="btn btn-secondary">Reservasi</button>
<form action="ubah.php" method="GET">
	<input type="hidden" name="id" value="${id}">
	Jam : <input type="text" name="jam">
	<br>
	Nama : <input type="text" name="nama">
	<br>
	No Telepon : <input type="text" name="no">
	<button name="submit">submit</button>
</form>
	            	`; 
	            	console.log(isi)
	            modalBody.innerHTML = isi;
			}else{
				console.log("noo")
				console.log(typeof data)
				data = data.replace(/\'/g, '"');
				console.log(data)
				const menu = JSON.parse(data)
				console.log(menu)
				let isi = "";
	            for (makan of menu) {
	            	isi +=`Pesan : ${makan.nama},jumlah : ${makan.quantity},total : ${makan.total},keterangan : ${makan.ket}`; 
	            }
	            modalBody.innerHTML = isi;
			}
		})
	}
</script>
<!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script> -->
</html>