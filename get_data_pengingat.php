<?php 

	require("koneksi.php");
	$response = array();

	$tanggal = date("Y-m-d");

	$query = mysqli_query($conn, "SELECT * FROM anggota_janaiz WHERE TIMESTAMPDIFF(MONTH, '$tanggal', due_date) = 1");
	// $query = mysqli_query($conn, "SELECT * FROM anggota_janaiz WHERE due_date > now() - interval 1 month");
	//select * from anggota_janaiz where month(due_date)=month(now())-1
	$cek = mysqli_num_rows($query);

	if($cek > 0)
	{
		$response['param'] = 1;
		$response['date'] = $tanggal;
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

	echo json_encode($response);
	mysqli_close($conn);