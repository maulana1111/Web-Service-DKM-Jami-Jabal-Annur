<?php 

	require("koneksi.php");
	$response = array();

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$response['param'] = 1;
		$judul = $_POST['judul'];
		mysqli_query($conn, "INSERT INTO category_umat(nama_category) VALUES('$judul')");
	}else{
		$response['param'] = 0;
	}

	echo json_encode($response);
	mysqli_close($conn);