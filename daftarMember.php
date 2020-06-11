<?php 

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

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Member</title>
</head>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="assets/styles/util.css">
<link rel="stylesheet" type="text/css" href="assets/styles/main.css">
<body>

<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form p-l-55 p-r-55 p-t-178" action="proses-daftar.php" method="post">
					<span class="login100-form-title">
                        Daftar Member
					</span>

					<div class="wrap-input100 validate-input m-b-16" data-validate="Please enter username">
						<!-- <input class="input100" type="text" name="username" placeholder="Username"> -->
                        <input class="form-control input100" type="text" name="username" placeholder="Username"  required>
					</div>
                    
                    <div class="wrap-input100 validate-input m-b-16" data-validate="Please enter username">
                        <input type="text"  name="nama" id="nama" class="form-control input100" placeholder="Nama" required>
                    </div>

                    <div class="wrap-input100 validate-input m-b-16" data-validate="Please enter username">
                        <input type="email" name="email" id="email" class="form-control input100" placeholder="Email"  required>
                    </div>

                    <div class="wrap-input100 validate-input m-b-16" data-validate="Please enter username">
                        <input type="password" name="password" id="password" class="form-control input100" placeholder="Password"  required>
                    </div>

                    <div class="wrap-input100 validate-input m-b-16" data-validate="Please enter username">
                        <input type="password"  name="kpassword" id="kpassword" class="form-control input100" placeholder="Konfirmasi Password"  required>
                    </div>

					<br>
					<br>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit">
							Sign Up
						</button>
					</div>

					<div class="flex-col-c p-t-40 p-b-40">
						
                        <a class="txt3" href="login.php">
                            Kembali
                        </a>   
					</div>
				</form>
			</div>
		</div>
    </div>                  
</body>

</html>