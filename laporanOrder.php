<?php
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=Data_laporan_order.xls");
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
    
    $orderListQuery = query("SELECT 
	order_list.no_transaksi AS nomortransaksi,
	order_list.id_order_list AS id,
	meja.id_meja AS nomormeja,
	menu.nama AS namamenu,
	user.nama AS namauser,
	menu.harga AS Harga,
	order_list.quantity AS quantity,
	order_list.total AS total
	FROM
	order_list JOIN meja 
		ON order_list.id_meja = meja.id_meja
	JOIN user 
		ON order_list.id_user = user.id_user
	JOIN menu 
		ON order_list.id_menu = menu.id_menu

  ORDER BY order_list.id_order_list ASC");
    
?>
   <table border="1">
       <tr>
            <th>nomortransaksi</th>
            <th>id</th>
            <th>nomormeja</th>
            <th>namamenu</th>
            <th>namauser</th>
            <th>Harga</th>
            <th>quantity</th>
            <th>total</th>	 	
       </tr>

       <?php foreach ($orderListQuery as $order):  ?>
            <tr>
            <th><?= $order['nomortransaksi']; ?></th>
            <td><?= $order['id']; ?></td>
            <td><?= $order['nomormeja']; ?></td>
            <td><?= $order['namamenu']; ?></td>
            <th><?= $order['namauser']; ?></th>
            <td><?= $order['Harga']; ?></td>
            <td><?= $order['quantity']; ?></td>
            <td><?= $order['total']; ?></td>
            </tr>
        <?php endforeach; ?>
   </table>
    