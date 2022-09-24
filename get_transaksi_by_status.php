<?php 

	require("koneksi.php");
	$response = array();

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{

		$status = $_POST['status'];

		$kueri = "SELECT transaksi_janaiz.*, anggota_janaiz.nama FROM transaksi_janaiz, anggota_janaiz WHERE transaksi_janaiz.id_anggota = anggota_janaiz.id AND transaksi_janaiz.status_transaksi = '$status' ORDER BY id DESC";

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
				$F['nama_anggota'] = $ambil->nama;
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