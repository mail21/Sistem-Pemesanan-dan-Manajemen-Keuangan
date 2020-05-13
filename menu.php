<?php 
	include "koneksi.php";
	include "functions.php";
	$boxMeja = query("SELECT * FROM reservasi JOIN meja ON reservasi.id_reservasi = meja.id_reservasi");
	$boxMenu = query("SELECT * FROM menu");

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

<style>	
	.menu{
		display: flex;
		justify-content: space-around;
	}

	menu-item{
		margin: 5px 0;
		display: inline-block;
		width: auto;
		background: red;
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

      
	  <div class="container">
		  <?php 
			echo "<input type='hidden' id='hiddenMeja' value=[$strMeja]>";
			foreach ($boxMenu as $menuData) {
				echo "
				<div class='row menu mt-3' style='border : 1px solid' data-toggle='modal' data-target='#ModalMenu'>
				  <menu-item> ".$menuData['id_menu'] ." </menu-item>
				  <menu-item> ".$menuData['nama'] ."</menu-item>
				  <menu-item> Rp. ".$menuData['harga'] ."</menu-item>
				  <menu-item> <img src='./assets/image/nasi-goreng.jpg' width='200' ></menu-item>
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
	<script>
		$("#menu-toggle").click(function(e) {
		  e.preventDefault();
		  $("#wrapper").toggleClass("toggled");
		});
		
		let menuRows = document.querySelectorAll(".menu");
		for (const menuRow of menuRows) {
			 menuRow.addEventListener("click",async (e)=>{
				const modalBody = document.querySelector('.modal-body');
				// =========================== get menu =======================
				let targetParent = e.target.parentElement
                let menuStr = e.target.innerText.split("\n");
				if(targetParent.tagName == "DIV" && menuStr.length === 1){
					//jika yang diklik harga,namaMakanan,nomor
					menuStr = targetParent.innerText.split("\n");
				}else if(targetParent.tagName == "MENU-ITEM"){
					//jika yang diklik gambar
					menuStr = targetParent.parentElement.innerText.split("\n");
				}
                // =========================== get menu =======================
				let noMeja = document.querySelector("#hiddenMeja");
				let strMejaValue = noMeja.value;
				strMejaValue = strMejaValue.replace(/\'/g, '"');
				const dataMeja = JSON.parse(strMejaValue);
				let str2 = ""
				for ( let strDataMeja of dataMeja){
					if(strDataMeja.nama_pelanggan != "kosong"){
					 	str2 += `<option value='${strDataMeja.id_meja}'>${strDataMeja.id_meja} - ${strDataMeja.status} - ${strDataMeja.nama_pelanggan} </option>`;
					}else{
						str2 += `<option value='${strDataMeja.id_meja}'>${strDataMeja.id_meja} - ${strDataMeja.status}</option>`
					}	
				}
    			 let isi2 = `
			<form action="tambahPesanan.php" method="POST">
				<h4>${menuStr[1]}, <span class="harga">${menuStr[2]}</span></h4>
				<input type="hidden" name="idMenu" value="${menuStr[0]}">
				<input type="hidden" name="harga" value="${menuStr[2]}">
				<div class="form-group mr-3 ml-3">
					<label for="nomorMeja">No Meja</label>
					<select name="nomorMeja" class="form-control" id="nomorMeja">
					${str2}
					</select>
				</div>
				<div class="form-group mr-3 ml-3">
					<label for="exampleFormControlTextarea1">Deskripsi</label>
					<textarea class="form-control" name="deskripsi" id="deskripsiText" rows="3"></textarea>
				</div>
				<div id="input_div">
					<span class="btnInput minus mr-2">-</span>
					<input type="text" name="quantity" readonly value="1" id="count">
					<span class="btnInput plus ml-2">+</span>
				</div>
				<center>
					<input type="text" name="total" readonly value="${menuStr[2]}" id="total">
				</center>
				<br>
				<button type="button" class="btn buttonSubmit btn-secondary btn-lg" data-dismiss="modal">Close</button>
				<button name="pesan" type="submit" class="btn buttonSubmit btn-primary btn-lg">Pesan</button>
			</form>`
					 modalBody.innerHTML = isi2;

				let selectTag = document.querySelector("#nomorMeja")
				console.log(selectTag)
				selectTag.addEventListener("change",(e)=>{
					console.log(e.target.value)
				 })
                 let count = 1;
                 let countTotal = document.getElementById("total");
                 let countEl = document.getElementById("count");
                 let harga = parseInt(menuStr[2].replace(/RP./gi, ""));
                 const plus = document.querySelector('.plus')
                 plus.addEventListener("click", ()=>{
                     count++;
                     countTotal.value = "Rp." + harga * count;
                     countEl.value = count;
                 });
                 const minus = document.querySelector('.minus');
                 minus.addEventListener("click", ()=>{
                    if (count > 1) {
                         count--;
                         countTotal.value = "Rp." + harga * count;
                         countEl.value = count;
						 if(count == 0){
							countTotal.value = "Rp." + harga;
						 }
                    }
                })

			 })
	} 
	</script>
</html>