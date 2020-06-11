<?php 
	
	include "koneksi.php";
	include "functions.php";
	require 'cek-sesi.php';
	$_GET['pesan'] = !empty($_GET['pesan']) && is_string($_GET['pesan']) ? $_GET['pesan'] : '';

    if($_GET["pesan"] === "passwordtidaksesuai"){
        echo "<script>
				alert('konfirmasi password tidak sesuai!');
		      </script>";
    }else if($_GET["pesan"] === "usernamesama"){
        echo "<script>
            alert('username sudah terdaftar!')
          </script>";
    }
    $boxUser = query("SELECT * FROM user");
	$session_value=(isset($_SESSION['tipe']))?$_SESSION['tipe']:''; 
 ?>
 <script type="text/javascript">
    var tipe='<?php echo $session_value;?>';
</script>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Staff</title>
	 <!-- Bootstrap core CSS -->
	 <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="assets/styles/style.css">
	<link rel="stylesheet" href="assets/styles/sidebar.css">
</head>
<style>
    .form{
        background-color: white;
        border: 1px solid;
        border-radius: 5%;
        padding: 20px;
        width: 80%;
    }
</style>

<body>
<div class="d-flex" id="wrapper">
	<!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">Welcome ,<br> <?= $_SESSION['tipe'] ?> <?= $_SESSION['nama']  ?> </div>
      <div class="list-group list-group-flush">
        <a href="index.php" class="list-group-item list-group-item-action bg-light linkHome">Home</a>
        <a href="menu.php" class="list-group-item list-group-item-action bg-light linkPesan">Pesan</a>
		<?php if($session_value === "Admin"): ?>
            <a href="menuLaporan.php" class="list-group-item list-group-item-action bg-light linkLaporan">Laporan</a>
			<a href="halamanStaff.php" class="list-group-item list-group-item-action bg-light linkLaporan">Staff</a>
		<?php endif; ?>  
		<a href="logout.php" class="list-group-item list-group-item-action bg-light">logout</a>
	</div>
    </div>
	<!-- /#sidebar-wrapper -->
	
	<!-- Page Content -->
    <div id="page-content-wrapper">

		<div class="container-fluid banner"></div>
		<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
			<button class="btn btn-info" id="menu-toggle">Toggle Menu</button>
			
		</nav>
		
		
		<div class="container-fluid mt-3">

        <table class="table table-striped table-dark">
        <thead>
            <tr>
            <th scope="col">No user</th>
            <th scope="col">Username</th>
            <th scope="col">Nama</th>
            <th scope="col">Tipe</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($boxUser as $user):  ?>
            <tr>
            <th scope="row"><?= $user['id_user']; ?></th>
            <td><?= $user['username']; ?></td>
            <td><?= $user['nama']; ?></td>
            <td><?= $user['tipe']; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        </table>
                    
        <br>
        <hr>
        <br>

        <form id="login-form" class="form" action="proses-daftar-staff.php" method="post">
            <h3 class="text-center text-info">Daftar Staff</h3>
            <div class="form-group">
                <label for="username" class="text-info">Username:</label><br>
                <input type="text" name="username" id="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="nama" class="text-info">Nama:</label><br>
                <input type="text"  name="nama" id="nama" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email" class="text-info">Email:</label><br>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password" class="text-info">Password:</label><br>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="kpassword" class="text-info"> Konfirmasi Password:</label><br>
                <input type="password"  name="kpassword" id="kpassword" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="tipe">Tipe</label>
                <select name="tipe" class="form-control" id="tipe">
                <option value="Pelayan">Pelayan</option>
                <option value="Koki">Koki</option>
                <option value="Kasir">Kasir</option>
                <option value="Admin">Admin</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-info btn-md">Submit</button>
            </div>
        </form>

		</div>
		
	</div>
    <!-- /#page-content-wrapper -->

</div>

</body>	

<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script>
$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
  });
</script>
</html>