<?php 
	global $conn;
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "masjid";

	$conn = mysqli_connect ($servername,$username ,$password,$dbname);
		if (!$conn) {
			die('koneksi gagal'.mysqli_connect_erorr());
		}
 ?>