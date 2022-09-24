<?php 

	require("koneksi.php");
	$response = array();

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$response['param'] = 1;

		$id = $_POST['id'];
		$judul_kajian = $_POST["judul_kajian"];
		$tanggal = $_POST["tanggal"];
		$waktu = $_POST["waktu"];
		$tema = $_POST["tema"];
		$nama_khatib = $_POST["nama_khatib"];
		$nama_muadzin = $_POST["nama_muadzin"];

		mysqli_query($conn, "UPDATE kajian SET judul_kajian = '$judul_kajian', tanggal = '$tanggal', waktu = '$waktu', tema = '$tema', nama_khatib = '$nama_khatib', nama_muadzin = '$nama_muadzin' WHERE id = '$id' ");
	}else{
		$response['param'] = 0;
	}

	echo json_encode($response);
	mysqli_close($conn);