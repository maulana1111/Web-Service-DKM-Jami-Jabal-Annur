<?php 

	require("koneksi.php");

	$kueri = "SELECT * FROM kajian ORDER BY id DESC";

	$query = mysqli_query($conn, $kueri);
	$cek = mysqli_num_rows($query);

	if($cek > 0)
	{
		$response['param'] = 1;
		$response["data"] = array();

		while($ambil = mysqli_fetch_object($query))
		{
			$F['id'] = $ambil->id;
			$F['category'] = $ambil->category;
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
	
	echo json_encode($response);
	mysqli_close($conn);