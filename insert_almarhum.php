<?php 

	require("koneksi.php");
	$response = array();

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$response['param'] = 1;

		$nama = $_POST['nama'];
		$alamat = $_POST['alamat'];
		$tanggal_meninggal = $_POST['tanggal_meninggal'];
		$sebab_meninggal = $_POST['sebab_meninggal'];
		$pemakaman = $_POST['pemakaman'];

		mysqli_query($conn, "INSERT INTO data_almarhum(nama,alamat,tanggal_meninggal,sebab_meninggal,pemakaman) VALUES('$nama','$alamat','$tanggal_meninggal','$sebab_meninggal','$pemakaman')");
	}else{
		$response['param'] = 0;
	}

	echo json_encode($response);
	mysqli_close($conn);