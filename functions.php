<?php 

include "koneksi.php";

 function query($query){
    global $db;
    $lemari = [];
    $theQuery = mysqli_query($db,$query);
    while($rak = mysqli_fetch_assoc($theQuery)){
        $lemari[] = $rak;
    }
    return $lemari;
 }

