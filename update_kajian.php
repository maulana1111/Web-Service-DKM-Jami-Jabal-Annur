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
		$pemateri = $_POST["pemateri"];
		$tema = $_POST["tema"];

		mysqli_query($conn, "UPDATE kajian SET judul_kajian = '$judul_kajian', tanggal = '$tanggal', waktu = '$waktu', pemateri = '$pemateri', tema = '$tema' WHERE id = '$id' ");
	}else{
		$response['param'] = 0;
	}

	echo json_encode($response);
	mysqli_close($conn);