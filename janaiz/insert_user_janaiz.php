<?php 

	require("koneksi.php");
	$response = array();

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$nama = $_POST["nama"];
		$no_telp = $_POST["no_telp"];
		$alamat = $_POST["alamat"];
		$rw = $_POST["rw"];
		$username = $_POST["username"];
		$password = $_POST["password"];
		$status_keanggotaan = "tidak_aktif";

		mysqli_query($conn, "INSERT INTO anggota_janaiz(nama,no_telp,alamat,rw,username,password,status_keanggotaan) VALUES('$nama','$no_telp','$alamat','$rw','$username','$password','$status_keanggotaan')");

		$query = mysqli_query($conn, "SELECT * FROM anggota_janaiz ORDER BY id DESC LIMIT 1");
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
				$F['status_keanggotaan'] = $ambil->status_keanggotaan;
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
