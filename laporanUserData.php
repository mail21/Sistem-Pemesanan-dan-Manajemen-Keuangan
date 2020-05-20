<?php
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=Data_laporan_staff.xls");
	?>
<style>
    td,th{
        width: 15%;
        height: 25px;
    }
</style>
<?php 
    include "koneksi.php";
    include "functions.php";
    
    $staffs = query("SELECT * FROM staff");
    
?>
   <table border="1">
       <tr>
            <th>Id Staff</th>  
            <th>Username</th> 	
            <th>Nama</th>
            <th>Tipe</th> 	 	
       </tr>

       <?php foreach($staffs  as $staff): ?>
        <tr>
            <td><?= $staff['id_staff']; ?></td>  
            <td><?= $staff['username']; ?></td> 	
            <td><?= $staff['nama']; ?></td>
            <td><?= $staff['tipe']; ?></td> 	 	
       </tr>
       <?php endforeach; ?>
   </table>
    