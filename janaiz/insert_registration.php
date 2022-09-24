<?php 

	require("koneksi.php");
	$response = array();

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$id_anggota = $_POST["id_anggota"];
		$nama_pengirim = $_POST["nama_pengirim"];
		$nomor_rekening = $_POST["nomor_rekening"];
		$lama_infaq = $_POST["lama_infaq"];
		$total_infaq = $_POST["total_infaq"];
		$tanggal_infaq = $_POST["tanggal_infaq"];
		$status_infaq = $_POST["status_infaq"];

		mysqli_query($conn, "INSERT INTO transaksi_janaiz(id_anggota,nama_pengirim,nomor_rekening,lama_infaq,total_infaq,tanggal_infaq,batas_infaq,status_infaq) VALUES('$id_anggota','$nama_pengirim','$nomor_rekening','$lama_infaq','$total_infaq','$tanggal_infaq',DATE_ADD('$tanggal_infaq', INTERVAL '$lama_infaq' YEAR),'$status_infaq')");
		
		$response['param'] = 1;
	}else{
		$response['param'] = 0;
	}

	echo json_encode($response);
	mysqli_close($conn);