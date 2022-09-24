<?php 

	require("koneksi.php");
	$response = array();

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{

		$id = $_POST['id'];

		$kueri = "SELECT * FROM transaksi_janaiz WHERE id_anggota = '$id' ORDER BY id DESC";
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
				$F['id_donasi'] = $ambil->id_donasi;
				$F['id_perpanjangan'] = $ambil->id_perpanjangan;
				$F['nama_pengirim'] = $ambil->nama_pengirim;
				$F['nomor_rekening'] = $ambil->nomor_rekening;
				$F['gambar'] = $ambil->gambar;
				$F['tanggal_transaksi'] = $ambil->tanggal_transaksi;
				$F['status_transaksi'] = $ambil->status_transaksi;
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