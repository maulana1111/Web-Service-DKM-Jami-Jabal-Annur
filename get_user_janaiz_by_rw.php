<?php 

	require("koneksi.php");
	$response = array();

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{

		$rw = $_POST['rw'];

		$kueri = "SELECT * FROM anggota_janaiz WHERE rw = '$rw' ORDER BY id DESC";
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
				$F['no_telp'] = $ambil->no_telp;
				$F['alamat'] = $ambil->alamat;
				$F['rw'] = $ambil->rw;
				$F['username'] = $ambil->username;
				$F['password'] = $ambil->password;
				$F['status_keanggotaan'] = $ambil->status_keanggotaan;
				$F['due_date'] = $ambil->due_date;
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