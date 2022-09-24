<?php 

	require("koneksi.php");
	$response = array();

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{

		$id = $_POST['id'];
		$nama_category = $_POST['nama_category'];

		mysqli_query($conn, "UPDATE category_umat SET nama_category = '$nama_category' WHERE id = '$id'");
		$response['param'] = 1;
	}else{
		$response['param'] = 0;
	}

	echo json_encode($response);
	mysqli_close($conn);