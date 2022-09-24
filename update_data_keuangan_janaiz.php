<?php 

	require("koneksi.php");
	$response = array();

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$response['param'] = 1;

		$id = $_POST['id'];

		$judul = $_POST['judul'];
		$tanggal = $_POST['tanggal'];
		$nominal = $_POST['nominal'];
		$kategori_keuangan = $_POST['kategori_keuangan'];
		$status_keuangan = $_POST['status_keuangan'];

		mysqli_query($conn, "UPDATE keuangan_janaiz SET judul = '$judul', tanggal = '$tanggal', nominal = '$nominal', kategori_keuangan = '$kategori_keuangan', status_keuangan = '$status_keuangan' WHERE id = '$id'");
	}else{
		$response['param'] = 0;
	}

	echo json_encode($response);
	mysqli_close($conn);