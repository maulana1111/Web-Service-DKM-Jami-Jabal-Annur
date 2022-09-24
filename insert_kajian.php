<?php 

	require("koneksi.php");
	$response = array();

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$judul_kajian = $_POST["judul_kajian"];
		$tanggal = $_POST["tanggal"];
		$waktu = $_POST["waktu"];
		$pemateri = $_POST["pemateri"];
		$tema = $_POST["tema"];

		mysqli_query($conn, "INSERT INTO kajian(category,judul_kajian,tanggal,waktu,pemateri,tema) VALUES(2, '$judul_kajian','$tanggal','$waktu', '$pemateri','$tema')");
		$response['param'] = 1;
	}else{
		$response['param'] = 0;
	}

	echo json_encode($response);
	mysqli_close($conn);