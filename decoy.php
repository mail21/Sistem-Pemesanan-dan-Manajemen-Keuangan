<?php 

$db = mysqli_connect("localhost","root","","restoran");
$query = mysqli_query($db,"UPDATE meja SET status = 'non-aktif' WHERE id_meja = 1");
header("location:index.php?ismail=keren");

 ?>