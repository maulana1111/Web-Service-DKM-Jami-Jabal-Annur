<?php 

	require("koneksi.php");
	$response = array();

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$id = $_POST['id'];
		$nama_barang = $_POST['nama_barang'];
		$jumlah = $_POST['jumlah'];
		$kondisi = $_POST['kondisi'];

		mysqli_query($conn, "UPDATE inventory SET nama_barang = '$nama_barang', jumlah = '$jumlah', kondisi = '$kondisi' WHERE id = '$id'");
		$response['param'] = 1;
	}else{
		$response['param'] = 0;
	}

	echo json_encode($response);
	mysqli_close($conn);