<?php 

	require("koneksi.php");
	$response = array();

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{

		$username = $_POST['username'];

		$kueri = "SELECT * FROM admin WHERE username = '$username'";
		$query = mysqli_query($conn, $kueri);
		$cek = mysqli_num_rows($query);

		if($cek > 0)
		{
			$response['param'] = 1;
			$response["data"] = array();

			while($ambil = mysqli_fetch_object($query))
			{
				
				$F['id'] = $ambil->id;
				$F['nama'] = $ambil->nama;
				$F['username'] = $ambil->username;
				$F['password'] = $ambil->password;
				$F['status'] = $ambil->status;
				$F['tingkat'] = $ambil->tingkat;
				$F['kepengurusan'] = $ambil->kepengurusan;
				array_push($response["data"], $F);
			}
		}else{

			$response['param'] = 0;
			
		}
	}else{
		$response['param'] = 0;
	}

	echo json_encode($response);
	mysqli_close($conn);