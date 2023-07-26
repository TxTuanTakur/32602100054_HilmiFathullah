<?php  
@session_start();
include "config.php";
if(@$_SESSION["user"]) {
	$aktif = @$_SESSION["user"]["id_login"];
	$koneksi->query("UPDATE tb_login SET status='offline' WHERE id_login='$aktif'");
	session_destroy();
	echo "<script>location='login.php';</script>";
}
?>