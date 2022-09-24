<?php 

	require("koneksi.php");
	$response = array();

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$response['param'] = 1;

		$id = $_POST['id'];
		$category_id = $_POST['category_id'];
		$nomor_id = $_POST['nomor_id'];
		$nama = $_POST['nama'];
		$tanggal_lahir = $_POST['tanggal_lahir'];
		$alamat_rumah = $_POST['alamat_rumah'];
		$nomor_ktp = $_POST['nomor_ktp'];
		$tempat_lahir = $_POST['tempat_lahir'];

		mysqli_query($conn, "UPDATE umat SET category_id = '$category_id', nomor_id = '$nomor_id', nama = '$nama', tanggal_lahir = '$tanggal_lahir', alamat_rumah = '$alamat_rumah', nomor_ktp = '$nomor_ktp', tempat_lahir = '$tempat_lahir' WHERE id = '$id'");
	}else{
		$response['param'] = 0;
	}

	echo json_encode($response);
	mysqli_close($conn);