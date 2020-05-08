<?php 

	$db = mysqli_connect("localhost","root","","restoran");
	$date = date("Y-m-d");
	$query = "INSERT INTO `reservasi` (`id_reservasi`, `id_staff`, `tanggal_reservasi`, `jam`, `nama_pelanggan`, `no_telp`) VALUES (NULL, '1', '".$date."', '".$_GET['jam']."', '".$_GET['nama']."', '".$_GET['no']."')";
	mysqli_query($db,$query);
	$result = mysqli_query($db,"SELECT * FROM reservasi");
	$num_rows = mysqli_num_rows($result);
	$queryMeja = "UPDATE meja SET id_reservasi = $num_rows, status = 'reservasi' WHERE id_meja = ".$_GET['id'];
	var_dump($queryMeja);
	mysqli_query($db,$queryMeja);
	header("location:index.php");
?>