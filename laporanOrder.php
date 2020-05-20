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
	staff.nama AS namastaff,
	menu.harga AS Harga,
	order_list.quantity AS quantity,
	order_list.total AS total
	FROM
	order_list JOIN meja 
		ON order_list.id_meja = meja.id_meja
	JOIN staff 
		ON order_list.id_staff = staff .id_staff
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
            <th>namastaff</th>
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
            <th><?= $order['namastaff']; ?></th>
            <td><?= $order['Harga']; ?></td>
            <td><?= $order['quantity']; ?></td>
            <td><?= $order['total']; ?></td>
            </tr>
        <?php endforeach; ?>
   </table>
    