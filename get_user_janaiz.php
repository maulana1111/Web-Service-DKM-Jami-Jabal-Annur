<?php 

	require("koneksi.php");
	$response = array();

	$kueri = "SELECT * FROM anggota_janaiz ORDER BY id DESC";
	$query = mysqli_query($conn, $kueri);
	$cek = mysqli_num_rows($query);

	if($cek > 0)
	{
		$response["data"] = array();

		while($ambil = mysqli_fetch_object($query))
		{
			
			$F['id'] = $ambil->id;
			$F['id_transaksi'] = $ambil->id_transaksi;
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
		$response['param'] = 1;
	}else{
		$response['param'] = 0;
	}

	echo json_encode($response);
	mysqli_close($conn);