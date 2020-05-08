<?php 
	$db = mysqli_connect("localhost","root","","restoran");
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
	<link rel="stylesheet" href="./bootstrap-4.4.1-dist/css/bootstrap.css">
</head>
<style>
	.banner{
		width: 100%;
		background-image: url("gambar.jpg");
		height: 25vh;
		background-size: cover;
	}

	.meja{
		display: inline-block;
		width: 100px;
		height: 100px;
		border: 1px solid;
	}

	.none{
		display: none;
	}

</style>

<body>
	<div class="container-fluid banner"></div>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	  
	  <div class="collapse navbar-collapse" id="navbarNavDropdown">
	    <ul class="navbar-nav">
	      <li class="nav-item active">
	        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="halamanMenu.php">Pesan</a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="#">Laporan</a>
	      </li>
	    </ul>
	  </div>
	</nav>

	
	<div class="container-fluid">
		<?php 
			$mejaQuery = "SELECT * FROM reservasi JOIN meja ON reservasi.id_reservasi = meja.id_reservasi";
			$query4 = mysqli_query($db,$mejaQuery);
			while ($query5 = mysqli_fetch_assoc($query4)) {
				$boxMeja[] = $query5;
			}
			$menuQuery = "SELECT * FROM menu";
			$query6 = mysqli_query($db,$menuQuery);
			while ($query7 = mysqli_fetch_assoc($query6)) {
				$boxMenu[] = $query7;
			}
			$strMeja = "";
			$b = 0;
			foreach ($boxMeja as $MEJA) {
				if($b>0){
					$strMeja .= ",";
				}
						$id_meja = $MEJA['id_meja'];
						$nama_pelanggan = $MEJA['nama_pelanggan'];
						$id_reservasi = $MEJA['id_reservasi'];
						$status = $MEJA['status'];
				$strMeja .= "{'id_meja':'$id_meja','nama_pelanggan':'$nama_pelanggan','id_reservasi':$id_reservasi,'status':'$status'}";
				$b++;	
			}
			var_dump($strMeja);
			echo "<input type='hidden' id='hiddenMeja' value=[$strMeja]>";
			foreach ($boxMenu as $menuData) {
				echo "<div class='row menu' style='border : 1px solid' data-toggle='modal' data-target='#ModalMenu'>
				".$menuData['id_menu'] ." 
				<br>
		 		".$menuData['nama'] ."
		 		<br>
		 		".$menuData['gambar'] ."
		 		<br>
		 		".$menuData['harga'] ."
		 		<br>
		 		</div>";
			}
		 ?>
		 
	</div>


	
	<!-- Modal Pesanan Kosong -->
	<div class="modal fade" id="ModalMenu" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Pesan </h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body2">
			
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-primary">Save changes</button>
	      </div>
	    </div>
	  </div>
	</div>

</body>
<script>
	let menuRows = document.querySelectorAll(".menu");
	for (menuRow of menuRows) {
	 	menuRow.addEventListener("click",async ()=>{
	 		const modalBody2 = document.querySelector('.modal-body2');
	 			let noMeja = document.querySelector("#hiddenMeja");
	 			let strMejaValue = noMeja.value;
	 			strMejaValue = strMejaValue.replace(/\'/g, '"');
	 			const dataMeja = JSON.parse(strMejaValue);
	 			console.log(dataMeja)
	 			let str2 = ""
	 			for ( let strDataMeja of dataMeja) {
	 				if(strDataMeja.nama_pelanggan != "kosong"){
	 				str2 += `
					<option value='${strDataMeja.id_meja}'>${strDataMeja.id_meja} - ${strDataMeja.status} - ${strDataMeja.nama_pelanggan} </option>`;
	 				}else{
	 					str2 += `
					<option value='${strDataMeja.id_meja}'>${strDataMeja.id_meja} - ${strDataMeja.status}</option>
	 				`
	 				}	
	 			}
	 			let isi2 = `
<form action="ubah.php" method="GET">
				No Meja : <select name="noMeja" id="select">
					${str2}
				</select>
				
				<br>
				<input type="hidden" name="id" value="">
				harga : <input type="text" name="harga">
				<br>
				Keterangan : <input type="text" name="ket">
				<button name="submit">submit</button>
</form>
	 			`
	 			modalBody2.innerHTML = isi2;
	 			let selectTag = document.querySelector("#select")
				console.log(selectTag)
				selectTag.addEventListener("change",(e)=>{
					console.log(e.target.value)
				})
	 	})
	 } 

</script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</html>