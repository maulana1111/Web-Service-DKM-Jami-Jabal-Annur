<?php 

	require("koneksi.php");
	$response = array();

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{

		$nama_barang = $_POST['nama_barang'];
		$jumlah = $_POST['jumlah'];
		$kondisi = $_POST['kondisi'];

		mysqli_query($conn, "INSERT INTO inventory(nama_barang, jumlah, kondisi) VALUES('$nama_barang','$jumlah', '$kondisi')");
		$response['param'] = 1;
	}else{
		$response['param'] = 0;
	}

	echo json_encode($response);
	mysqli_close($conn);