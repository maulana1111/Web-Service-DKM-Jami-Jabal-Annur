<?php 

	require("koneksi.php");
	$response = array();

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{

		$username = $_POST['username'];

		$kueri = "SELECT * FROM anggota_janaiz WHERE username = '$username'";
		$query = mysqli_query($conn, $kueri);
		$cek = mysqli_num_rows($query);

		if($cek > 0)
		{
			$response['param'] = 1;
		}else{
			$response['param'] = 0;			
		}
	}else{
		$response['param'] = 0;
	}

	echo json_encode($response);
	mysqli_close($conn);