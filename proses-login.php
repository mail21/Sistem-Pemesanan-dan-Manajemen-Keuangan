<?php
session_start();
 
include 'koneksi.php';
 
// menangkap data yang dikirim dari form
$username =mysqli_real_escape_string($db,$_POST['username']);
$pass =mysqli_real_escape_string($db, $_POST['password']);
 
// menyeleksi data admin dengan username dan password yang sesuai
$data = mysqli_query($db,"select * from user where username='$username' AND password='$pass'");
 
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($data);
 
if($cek > 0){
$sesi = mysqli_query($db,"select * from user where username='$username' AND password='$pass'");
$sesi = mysqli_fetch_assoc($sesi);
	$_SESSION['id_user'] = $sesi['id_user'];
	$_SESSION['nama'] = $sesi['nama'];
	$_SESSION['status'] = "login";
	$_SESSION['tipe'] = $sesi['tipe'];
	$_SESSION['email'] = $sesi['email'];
	header("location:index.php");
}else{
	header("location:login.php?pesan=gagal");
}
?>