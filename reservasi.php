<?php 

	include "koneksi.php";
	include "functions.php";
	$date = date("Y-m-d");
	$waktu = $_POST['jam'] . ":".$_POST['menit'];
	var_dump($waktu);
	query("INSERT INTO `reservasi` (`id_reservasi`, `id_staff`, `tanggal_reservasi`, `jam`, `nama_pelanggan`, `no_telp`) VALUES (NULL, '1', '".$date."', '".$waktu."', '".$_POST['nama']."', '".$_POST['no']."')");
	$result = mysqli_query($db,"SELECT * FROM reservasi");
	$jmlReservasi = mysqli_num_rows($result);
	query("UPDATE meja SET id_reservasi = $jmlReservasi, status = 'reservasi' WHERE id_meja = ".$_POST['id']);
	header("location:index.php");
?>