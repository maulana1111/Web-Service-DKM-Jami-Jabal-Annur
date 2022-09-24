<?php 

	require("koneksi.php");
	$response = array();

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{

		$nama = $_POST['nama'];
		$tanggal = $_POST['tanggal'];
		$nominal = $_POST['nominal'];
		$category_id = $_POST['category_id'];
		$judul = "Donasi Dari Donatur";

		mysqli_query($conn, "INSERT INTO donatur(nama, tanggal, nominal) VALUES('$nama','$tanggal','$nominal')");
		mysqli_query($conn, "INSERT INTO laporan_keuangan(judul,nominal,tanggal,category_id,status_laporan) VALUES('$judul','$nominal','$tanggal','$category_id','Pemasukan')");

		$response['param'] = 1;
	}else{
		$response['param'] = 0;
	}

	echo json_encode($response);
	mysqli_close($conn);