<?php 

	require("koneksi.php");
	$response = array();

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{

		$judul = $_POST['judul'];
		mysqli_query($conn, "INSERT INTO category_laporan_keuangan(nama_category) VALUES('$judul')");
		$response['param'] = 1;
	}else{
		$response['param'] = 0;
	}

	echo json_encode($response);
	mysqli_close($conn);