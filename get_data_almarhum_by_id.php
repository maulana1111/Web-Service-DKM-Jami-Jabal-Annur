<?php 

	require("koneksi.php");
	$response = array();

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{

		$id = $_POST['id'];

		$kueri = "SELECT * FROM data_almarhum WHERE id = '$id'";
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
				$F['alamat'] = $ambil->alamat;
				$F['tanggal_meninggal'] = $ambil->tanggal_meninggal;
				$F['sebab_meninggal'] = $ambil->sebab_meninggal;
				$F['pemakaman'] = $ambil->pemakaman;
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