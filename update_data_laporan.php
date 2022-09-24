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
		$category_id = $_POST['category_id'];
		$status = $_POST['status'];

		mysqli_query($conn, "UPDATE laporan_keuangan SET judul = '$judul', tanggal = '$tanggal', nominal = '$nominal', category_id = '$category_id', status_laporan = '$status' WHERE id = '$id'");
	}else{
		$response['param'] = 0;
	}

	echo json_encode($response);
	mysqli_close($conn);