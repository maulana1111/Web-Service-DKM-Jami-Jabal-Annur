<?php 

	require("koneksi.php");
	$response = array();

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$response['param'] = 1;

		$id = $_POST['id'];
		$nama = $_POST['nama'];
		$status_keluarga = $_POST['status_keluarga'];

		mysqli_query($conn, "UPDATE anggota_keluarga SET nama = '$nama', status_keluarga = '$status_keluarga' WHERE id = '$id' ");
	}else{
		$response['param'] = 0;
	}

	echo json_encode($response);
	mysqli_close($conn);