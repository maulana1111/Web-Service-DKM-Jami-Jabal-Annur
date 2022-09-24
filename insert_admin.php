<?php 

	require("koneksi.php");
	$response = array();

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$response['param'] = 1;

		$nama = $_POST['nama'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$status = $_POST['status'];
		$tingkat = $_POST['tingkat'];
		$kepengurusan = $_POST['kepengurusan'];

		mysqli_query($conn, "INSERT INTO admin(nama,username,password,status,tingkat,kepengurusan) VALUES('$nama','$username','$password','$status','$tingkat','$kepengurusan')");
	}else{
		$response['param'] = 0;
	}

	echo json_encode($response);
	mysqli_close($conn);