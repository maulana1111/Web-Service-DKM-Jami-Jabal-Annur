<?php 

	require("koneksi.php");
	$response = array();

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{

		$id = $_POST['id'];
		$nama = $_POST['nama'];
		$alamat = $_POST['alamat'];
		$tanggal_meninggal = $_POST['tanggal_meninggal'];
		$sebab_meninggal = $_POST['sebab_meninggal'];
		$pemakaman = $_POST['pemakaman'];

		mysqli_query($conn, "UPDATE data_almarhum SET nama = '$nama', alamat = '$alamat', tanggal_meninggal = '$tanggal_meninggal', sebab_meninggal = '$sebab_meninggal', pemakaman = '$pemakaman' WHERE id = '$id' ");
		$response['param'] = 1;
	}else{
		$response['param'] = 0;
	}

	echo json_encode($response);
	mysqli_close($conn);