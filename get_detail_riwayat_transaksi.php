<?php 

	require("koneksi.php");
	$response = array();

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{

		$id = $_POST['id'];

		$kueri = "SELECT * FROM transaksi_janaiz WHERE id = '$id'";
		$query = mysqli_query($conn, $kueri);
		$cek = mysqli_num_rows($query);

		if($cek > 0)
		{
			$response['param'] = 1;
			$response["data"] = array();

			while($ambil = mysqli_fetch_object($query))
			{
				
				$F['id'] = $ambil->id;
				$F['id_anggota'] = $ambil->id_anggota;
				$F['nama_pengirim'] = $ambil->nama_pengirim;
				$F['nomor_rekening'] = $ambil->nomor_rekening;
				$F['gambar'] = $ambil->gambar;
				$F['lama_infaq'] = $ambil->lama_infaq;
				$F['total_infaq'] = $ambil->total_infaq;
				$F['tanggal_infaq'] = $ambil->tanggal_infaq;
				$F['batas_infaq'] = $ambil->batas_infaq;
				$F['status_infaq'] = $ambil->status_infaq;
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