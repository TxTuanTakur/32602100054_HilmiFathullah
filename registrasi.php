<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Form Registrasi</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<style>
body {
	background: #ffffff;
}
.form-control {
	min-height: 41px;
	background: #fff;
	box-shadow: none !important;
	border-color: #e3e3e3;
}
.form-control:focus {
	border-color: #70c5c0;
}
.form-control, .btn {
	border-radius: 2px;
}
.login-form {
	width: 100%;
	max-width: 350px;
	margin: 0 auto;
	padding: 100px 0 30px;
}
.login-form form {
	color: #7a7a7a;
	border-radius: 2px;
	margin-bottom: 15px;
	font-size: 13px;
	background: #ececec;
	box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
	padding: 30px;
	position: relative;
}
.login-form h2 {
	font-size: 22px;
	margin: 35px 0 25px;
}
.login-form .avatar {
	position: absolute;
	margin: 0 auto;
	left: 0;
	right: 0;
	top: -50px;
	width: 95px;
	height: 95px;
	border-radius: 50%;
	z-index: 9;
	background: #fff;
	padding: 15px;
	box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
}
.login-form .avatar img {
	width: 100%;
}
.login-form input[type="checkbox"] {
	position: relative;
	top: 1px;
}
.login-form .btn, .login-form .btn:active {
	font-size: 16px;
	font-weight: bold;
	background: #0062cc!important;
	border: none;
	margin-bottom: 20px;
}
.login-form .btn:hover, .login-form .btn:focus {
	background: #50b8b3 !important;
}
.login-form a {
	color: #fff;
	text-decoration: underline;
}
.login-form a:hover {
	text-decoration: none;
}
.login-form form a {
	color: #000;
	text-decoration: none;
}
.login-form form a:hover {
	text-decoration: underline;
}
.login-form .bottom-action {
	font-size: 14px;
}
</style>
</head>
<body>
<div class="login-form">
	<?php
	include "config.php";  
	$query = $koneksi->query("SELECT max(kode) as kodeTerbesar FROM tb_user");
	$data = $query->fetch_array();
	$kodeUser = $data['kodeTerbesar'];
	$urutan = (int) substr($kodeUser, 4, 4);

	$urutan++;
	$huruf = "USE-";
	$kodeUser = $huruf . sprintf("%04s", $urutan);
	?>
    <form action="" method="post">
		<div class="avatar">
			<img src="img/avatar.png" alt="Avatar">
		</div>
        <h2 class="text-center">Form Pendaftaran</h2>
         <div class="form-group">
        	<input type="hidden" name="kode" value="<?php echo $kodeUser; ?>">
        </div>
        <div class="form-group">
        	<input type="text" class="form-control" name="nama_user" placeholder="nama lengkap" required="required">
        </div>
        <div class="form-group">
        	<input type="email" class="form-control" name="email" placeholder="email" required="required">
        </div>

        <div class="form-group">
        	<input type="text" class="form-control" name="user" placeholder="username" required="required">
        </div>
		<div class="form-group">
            <input type="password" class="form-control" name="pass1" placeholder="password" required="required">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="pass2" placeholder="ulangi password" required="required">
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary btn-lg btn-block" value="DAFTAR" name="tombol">
        </div>
    </form>
    <?php  
    $kode			= @$_POST["kode"];
    $nama_user		= @$_POST["nama_user"];
    $email			= @$_POST["email"];
    $user			= @$_POST["user"];
    $pass1			= md5(@$_POST["pass1"]);
    $pass2			= md5(@$_POST["pass2"]);
    $tombol			= @$_POST["tombol"];

    if($tombol) {
    	if($pass1 == $pass2) {
	    	$data = $koneksi->query("SELECT * FROM tb_user WHERE email='$email'");
	    	$hitung = $data->num_rows;
	    	if($hitung > 0 ) {
	    		echo "email sudah terdaftar";
	    	} else {
	    		$input = $koneksi->query("INSERT INTO tb_login VALUES('','$kode','$user','$pass1','user','offline','aktif')");
	    		$input .= $koneksi->query("INSERT INTO tb_user VALUES('','$kode','$nama_user','','$email','','')");
	    		if($input) {
	    			echo "Registrasi Berhasil";
	    		} else {
	    			echo "Registrasi Gagal";
	    		}
	    	}
	    } else {
	    	echo "password tidak sesuai";
	    }
    }
    ?>
    
    <p class="text-center small">Sudah punya akun ? <a href="login.php" class="text-primary">Login</a></p>
</div>
</body>
</html>