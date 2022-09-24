<?php 

	require("koneksi.php");
	$response = array();

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$response['param'] = 1;

		$judul = $_POST['judul'];
		$tanggal = $_POST['tanggal'];
		$nominal = $_POST['nominal'];
		$kategori_keuangan = $_POST['kategori_keuangan'];
		$status_keuangan = $_POST['status_keuangan'];

		mysqli_query($conn, "INSERT INTO keuangan_janaiz(judul,tanggal,nominal,kategori_keuangan,status_keuangan) VALUES('$judul','$tanggal','$nominal','$kategori_keuangan','$status_keuangan')");
	}else{
		$response['param'] = 0;
	}

	echo json_encode($response);
	mysqli_close($conn);