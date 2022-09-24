<?php 

	require("koneksi.php");
	$response = array();

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{

		$id = $_POST['id'];

		$kueri = "SELECT * FROM kajian WHERE id = '$id'";
		$query = mysqli_query($conn, $kueri);
		$cek = mysqli_num_rows($query);

		if($cek > 0)
		{
			$response['param'] = 1;
			$response["data"] = array();

			while($ambil = mysqli_fetch_object($query))
			{
				
				$F['id'] = $ambil->id;
				$F['judul_kajian'] = $ambil->judul_kajian;
				$F['tanggal'] = $ambil->tanggal;
				$F['waktu'] = $ambil->waktu;
				$F['pemateri'] = $ambil->pemateri;
				$F['tema'] = $ambil->tema;
				$F['nama_khatib'] = $ambil->nama_khatib;
				$F['nama_muadzin'] = $ambil->nama_muadzin;
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