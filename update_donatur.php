<?php 

	require("koneksi.php");
	$response = array();

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$id = $_POST['id'];
		$nama = $_POST['nama'];
		$tanggal = $_POST['tanggal'];
		$nominal = $_POST['nominal'];

		mysqli_query($conn, "UPDATE donatur SET nama = '$nama', tanggal = '$tanggal', nominal = '$nominal' WHERE id = '$id'");
		$response['param'] = 1;
	}else{
		$response['param'] = 0;
	}

	echo json_encode($response);
	mysqli_close($conn);