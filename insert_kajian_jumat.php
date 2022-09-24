<?php 

	require("koneksi.php");
	$response = array();

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$response['param'] = 1;
		
		$judul_kajian = $_POST["judul_kajian"];
		$tanggal = $_POST["tanggal"];
		$waktu = $_POST["waktu"];
		$tema = $_POST["tema"];
		$nama_khatib = $_POST["nama_khatib"];
		$nama_muadzin = $_POST["nama_muadzin"];

		mysqli_query($conn, "INSERT INTO kajian(category, judul_kajian, tanggal, waktu, tema, nama_khatib, nama_muadzin) VALUES(1,'$judul_kajian','$tanggal','$waktu','$tema','$nama_khatib','$nama_muadzin')");
	}else{
		$response['param'] = 0;
	}

	echo json_encode($response);
	mysqli_close($conn);