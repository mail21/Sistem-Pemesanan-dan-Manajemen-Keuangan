<?php 

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
<style>
    body {
  margin: 0;
  padding: 0;
  background-color: #17a2b8;
  height: 120vh;
}

#login .container #login-row #login-column #login-box {
  margin-top: 120px;
  max-width: 600px;
  height: 550px;
  border: 1px solid #9C9C9C;
  background-color: #EAEAEA;
}

#login .container #login-row #login-column #login-box #login-form {
  padding: 20px;
}

#login .container #login-row #login-column #login-box #login-form #register-link {
  margin-top: -85px;
}

</style>
<body>
    <div id="login">
        <h3 class="text-center text-white pt-5">Daftar Member Form</h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="proses-daftar.php" method="post">
                            <h3 class="text-center text-info">Daftar</h3>
                            <div class="form-group">
                                <label for="username" class="text-info">Username:</label><br>
                                <input type="text" name="username" id="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="nama" class="text-info">Nama:</label><br>
                                <input type="text" name="nama" id="nama" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="email" class="text-info">Email:</label><br>
                                <input type="email" name="email" id="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Password:</label><br>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="kpassword" class="text-info"> Konfirmasi Password:</label><br>
                                <input type="password" name="kpassword" id="kpassword" class="form-control">
                            </div>
                            <div class="form-group">
                                <button type="submit" name="submit" class="btn btn-info btn-md">Submit</button>
                                <a href="login.php"><button type="button" class="btn btn-info btn-md">Login</button></a> 
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>