<?php 

include 'koneksi.php';


$username = strtolower(stripslashes($_POST["username"]));
$password = mysqli_real_escape_string($db, $_POST["password"]);
$password2 = mysqli_real_escape_string($db, $_POST["kpassword"]);
$nama = $_POST['nama'];
$email = $_POST['email'];

// cek konfirmasi password
if( $password !== $password2 ) {
    header("location:daftarMember.php?pesan=passwordtidaksesuai");
}

// cek username sudah ada atau belum
$result = mysqli_query($db, "SELECT username FROM user WHERE username = '$username'");

if( mysqli_fetch_assoc($result) ) {
    header("location:daftarMember.php?pesan=usernamesama");
}

mysqli_query($db, "INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `email`, `tipe`) VALUES ('', '$username', '$password', '$nama', '$email', 'Pelanggan') ");
header("location:login.php");
