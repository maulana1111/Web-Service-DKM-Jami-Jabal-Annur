<?php 

	require("koneksi.php");
	$response = array();

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{

		$bulan = $_POST['bulan'];
		$tahun = $_POST['tahun'];

		$kueri = "SELECT * FROM donatur  WHERE YEAR(tanggal) = '$tahun' AND MONTH(tanggal) = '$bulan'";
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
				$F['tanggal'] = $ambil->tanggal;
				$F['nominal'] = $ambil->nominal;
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