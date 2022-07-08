<?php 
	$con = mysqli_connect("localhost", "root", "", "db_bonsaiapp");

	if(!$con) {
		die("Koneksi Gagal : ". mysqli_connect_error());
	};
?>