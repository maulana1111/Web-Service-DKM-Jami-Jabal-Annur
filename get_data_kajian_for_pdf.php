<?php 

	require("koneksi.php");

	$kueri = "SELECT * FROM kajian";
	$query = mysqli_query($conn, $kueri);
	$cek = mysqli_num_rows($query);

	if($cek > 0)
	{
		$response['param'] = 1;
		$response["data_kajian_jumat"] = array();
		$response["data_kajian"] = array();

		while($data = mysqli_fetch_object($query))
		{
			if($data->pemateri == "")
			{

				$F['tanggal'] = $data->tanggal;
				$F['tema'] = $data->tema;
				$F['nama_khatib'] = $data->nama_khatib;
				$F['nama_muadzin'] = $data->nama_muadzin;
				array_push($response["data_kajian_jumat"], $F);

			}
			if($data->nama_khatib == ""){

				$G['judul_kajian'] = $data->judul_kajian;
				$G['tanggal'] = $data->tanggal;
				$G['waktu'] = $data->waktu;
				$G['pemateri'] = $data->pemateri;
				$G['tema'] = $data->tema;
				array_push($response["data_kajian"], $G);

			}
		}
	}else{
		$response['param'] = 0;
	}
	
	echo json_encode($response);
	mysqli_close($conn);