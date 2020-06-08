<?php
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=Data_laporan_user.xls");
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
    
    $users = query("SELECT * FROM user");
    
?>
   <table border="1">
       <tr>
            <th>Id user</th>  
            <th>Username</th> 	
            <th>Nama</th>
            <th>Email</th>
            <th>Tipe</th> 	 	
       </tr>

       <?php foreach($users  as $user): ?>
        <tr>
            <td><?= $user['id_user']; ?></td>  
            <td><?= $user['username']; ?></td> 	
            <td><?= $user['nama']; ?></td>
            <td><?= $user['email']; ?></td>
            <td><?= $user['tipe']; ?></td> 	 	
       </tr>
       <?php endforeach; ?>
   </table>
    