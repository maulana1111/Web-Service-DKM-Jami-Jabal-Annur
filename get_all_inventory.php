<?php 

	require("koneksi.php");

	$kueri = "SELECT * FROM inventory";

	$query = mysqli_query($conn, $kueri);
	$cek = mysqli_num_rows($query);

	if($cek > 0)
	{
		$response['param'] = 1;
		$response["data"] = array();

		while($ambil = mysqli_fetch_object($query))
		{

			$F['id'] = $ambil->id;
			$F['nama_barang'] = $ambil->nama_barang;
			$F['jumlah'] = $ambil->jumlah;
			$F['kondisi'] = $ambil->kondisi;
			array_push($response["data"], $F);
		}
	}else{
		$response['param'] = 0;
	}
	
	echo json_encode($response);
	mysqli_close($conn);