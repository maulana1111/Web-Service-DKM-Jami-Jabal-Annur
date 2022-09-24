<?php 

	require("koneksi.php");
	$response = array();

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$response['param'] = 1;
		$id = $_POST["id"];
		$nama = $_POST["nama"];
		$no_telp = $_POST["no_telp"];
		$alamat = $_POST["alamat"];
		$rw = $_POST["rw"];
		$username = $_POST["username"];
		$password = $_POST["password"];

		mysqli_query($conn, "UPDATE anggota_janaiz SET nama = '$nama', no_telp = '$no_telp', alamat = '$alamat', rw = '$rw', username = '$username', password = '$password' WHERE id = '$id' ");

	}else{
		$response['param'] = 0;
	}

	echo json_encode($response);
	mysqli_close($conn);
