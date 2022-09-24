<?php 

	require("koneksi.php");
	$response = array();

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$response['param'] = 1;

		$judul = $_POST['judul'];
		$tanggal = $_POST['tanggal'];
		$nominal = $_POST['nominal'];
		$category_id = $_POST['category_id'];
		$status = $_POST['status'];

		mysqli_query($conn, "INSERT INTO laporan_keuangan(judul,tanggal,nominal,category_id,status_laporan) VALUES('$judul','$tanggal','$nominal','$category_id','$status')");
	}else{
		$response['param'] = 0;
	}

	echo json_encode($response);
	mysqli_close($conn);