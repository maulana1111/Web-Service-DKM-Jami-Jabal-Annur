<?php 

	require("koneksi.php");
	$response = array();

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$response['param'] = 1;

		$category_id = $_POST['category_id'];
		$nomor_id = $_POST['nomor_id'];
		$nama = $_POST['nama'];
		$tanggal_lahir = $_POST['tanggal_lahir'];
		$alamat_rumah = $_POST['alamat_rumah'];
		$nomor_ktp = $_POST['nomor_ktp'];
		$tempat_lahir = $_POST['tempat_lahir'];

		mysqli_query($conn, "INSERT INTO umat(category_id ,nomor_id ,nama ,tanggal_lahir ,alamat_rumah ,nomor_ktp , tempat_lahir) VALUES('$category_id','$nomor_id','$nama','$tanggal_lahir','$alamat_rumah','$nomor_ktp','$tempat_lahir')");
	}else{
		$response['param'] = 0;
	}

	echo json_encode($response);
	mysqli_close($conn);