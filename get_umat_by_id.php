<?php 

	require("koneksi.php");
	$response = array();

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{

		$id = $_POST['id'];

		$kueri = "SELECT umat.*, category_umat.nama_category
				FROM umat, category_umat WHERE category_umat.id =
				umat.category_id AND umat.id = '$id'";
		$query = mysqli_query($conn, $kueri);
		$cek = mysqli_num_rows($query);

		if($cek > 0)
		{
			$response['param'] = 1;
			$response["data"] = array();

			while($ambil = mysqli_fetch_object($query))
			{
				
				$F['id'] = $ambil->id;
				$F['nama_category'] = $ambil->nama_category;
				$F['nomor_id'] = $ambil->nomor_id;
				$F['nama'] = $ambil->nama;
				$F['tanggal_lahir'] = $ambil->tanggal_lahir;
				$F['alamat_rumah'] = $ambil->alamat_rumah;
				$F['nomor_ktp'] = $ambil->nomor_ktp;
				$F['tempat_lahir'] = $ambil->tempat_lahir;
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