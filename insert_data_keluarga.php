<?php 

	require("koneksi.php");
	$response = array();

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$response['param'] = 1;

		$nama = $_POST['nama'];
		$status_keluarga = $_POST['status_keluarga'];
		$id_anggota = $_POST['id_anggota'];

		mysqli_query($conn, "INSERT INTO anggota_keluarga(nama,status_keluarga,id_anggota_janaiz) VALUES('$nama','$status_keluarga','$id_anggota')");
	}else{
		$response['param'] = 0;
	}

	echo json_encode($response);
	mysqli_close($conn);