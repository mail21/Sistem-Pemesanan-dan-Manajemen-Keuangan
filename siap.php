<?php
session_start();
 
include 'koneksi.php';
$_GET['siap'] = !empty($_GET['siap']) && is_string($_GET['siap']) ? $_GET['siap'] : '';
$_GET['saji'] = !empty($_GET['saji']) && is_string($_GET['saji']) ? $_GET['saji'] : '';

$resQuery = mysqli_query($db,"SELECT siap FROM order_list WHERE id_order_list = ".$_GET['id']);
$res = mysqli_fetch_assoc($resQuery);
if ($_GET['tipe']== "Pelayan" && $_GET['siap']==1) {
    echo "<script>
    alert('Anda Tidak mempunyai hak');
    window.location= 'index.php'
    </script>";
}else if($_GET['tipe']== "Koki" && $_GET['saji']==1){
    echo "<script>
    alert('Anda Tidak mempunyai hak');
    window.location= 'index.php'
    </script>";
}else if($res['siap'] == "0" && $_SESSION['tipe'] == "Pelayan"){
    echo "<script>
			alert('koki Belum memberi keterangan Ready');
			window.location= 'index.php'
			</script>";
}else if(isset($_GET['siap']) && $_GET['tipe'] == "Koki"){
    mysqli_query($db,"UPDATE order_list SET siap='".$_GET['siap']."' WHERE id_order_list = ".$_GET['id']);
    header("location:index.php");
}else if(isset($_GET['saji']) && $_GET['tipe'] == "Pelayan"){
    mysqli_query($db,"UPDATE order_list SET saji='".$_GET['saji']."' WHERE id_order_list = ".$_GET['id']);
    header("location:index.php");
}else{
    header("location:index.php");
}
