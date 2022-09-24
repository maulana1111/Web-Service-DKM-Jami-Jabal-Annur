<?php 

	require("koneksi.php");
	$response = array();

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$response['param'] = 1;

		$id = $_POST['id'];
		$nama = $_POST['nama'];
		$username = $_POST['username'];
		$password = $_POST['password'];

		mysqli_query($conn, "UPDATE admin SET nama = '$nama', username = '$username', password = '$password' WHERE id = '$id'");
	}else{
		$response['param'] = 0;
	}

	echo json_encode($response);
	mysqli_close($conn);