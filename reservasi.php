<?php 

	include "koneksi.php";
	include "functions.php";
	require 'cek-sesi.php';
	$cekDoubleReservasiQuery = "SELECT tanggal_reservasi FROM `reservasi` WHERE id_user = ".$_SESSION['id_user']." AND DATE_FORMAT(tanggal_reservasi, '%Y-%d-%Y 00:00:00') = DATE_FORMAT(NOW(), '%Y-%d-%Y 00:00:00') ";
	$res1 = mysqli_query($db,$cekDoubleReservasiQuery);
	if($_SESSION['tipe'] == "Pelanggan" && mysqli_num_rows($res1) > 0){
		echo "<script>
			alert('Anda hari ini sudah melakukan reservasi');
			window.location= 'index.php'
		</script>";
	}else{
		echo "reservasi";
		$date = date("Y-m-d");
		$waktu = $_POST['jam'] . ":".$_POST['menit'] . "-" .$_POST['jam2'] . ":".$_POST['menit2'];
		// var_dump($_SESSION['id_user']);
		$id_user = $_SESSION['id_user'];
		var_dump($_POST['tambah']);
		if($_POST['tambah'] == "false"){
			$tambah = false;
			$status = "aktif";
		}else{
			$tambah = $_POST['tambah'] || false;
			$status = "reservasi";
		}
		var_dump($tambah);
		$result = mysqli_query($db,"SELECT * FROM reservasi");
		$antrianQuery = mysqli_query($db,"SELECT antrian FROM meja WHERE id_meja = ".$_POST['id']);
		$listAntrian = mysqli_fetch_assoc($antrianQuery);
		$jmlReservasi = mysqli_num_rows($result) + 1;
		$tambahReservasi = $listAntrian['antrian']. "," .$jmlReservasi;
		if($tambah){
			mysqli_query($db,"INSERT INTO `reservasi` (`id_reservasi`, `id_user`, `tanggal_reservasi`, `jam`, `nama_pelanggan`, `no_telp`, `email`) VALUES (NULL, '$id_user', '".$date."', '".$waktu."', '".$_POST['nama']."', '".$_POST['no']."', '".$_POST['email']."')");
			$reservasi = $tambahReservasi;
			mysqli_query($db,"UPDATE meja SET antrian = '$reservasi' WHERE id_meja = ".$_POST['id']);	
			header("location:index.php");
		}else{
			mysqli_query($db,"INSERT INTO `reservasi` (`id_reservasi`, `id_user`, `tanggal_reservasi`, `jam`, `nama_pelanggan`, `no_telp`, `email`) VALUES (NULL, '$id_user', '$date', '".$waktu."', '".$_POST['nama']."', '".$_POST['no']."', '".$_POST['email']."')");
			$reservasi = $jmlReservasi;
			mysqli_query($db,"UPDATE meja SET id_reservasi = $jmlReservasi, status = '$status',antrian = '$reservasi'  WHERE id_meja = ".$_POST['id']);	
			header("location:index.php");
		}
	}
	
?>