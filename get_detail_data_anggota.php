<?php 

	require("koneksi.php");
	$response = array();

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{

		$id = $_POST['id'];

		$kueriT = "SELECT * FROM transaksi_janaiz WHERE id_anggota = '$id' ORDER BY id DESC";
		$queryT = mysqli_query($conn, $kueriT);


		$kueriA = "SELECT * FROM anggota_janaiz WHERE id = '$id'";
		$queryA = mysqli_query($conn, $kueriA);

		$cekT = mysqli_num_rows($queryT);
		$cekA = mysqli_num_rows($queryA);

		if($cekA > 0)
		{
			$response['param_anggota'] = 1;
			$response["data_anggota"] = array();

			while($ambilA = mysqli_fetch_object($queryA))
			{
				
				$G['id'] = $ambilA->id;
				$G['id_transaksi'] = $ambilA->id_transaksi;
				$G['nama'] = $ambilA->nama;
				$G['no_telp'] = $ambilA->no_telp;
				$G['alamat'] = $ambilA->alamat;
				$G['rw'] = $ambilA->rw;
				$G['username'] = $ambilA->username;
				$G['password'] = $ambilA->password;
				$G['status_keanggotaan'] = $ambilA->status_keanggotaan;
				$G['due_date'] = $ambilA->due_date;
				array_push($response["data_anggota"], $G);
			}
		}else{
			$response['param_anggota'] = 0;	
		}

		if($cekT > 0)
		{
			$response['param_transaksi'] = 1;
			$response["data_transaksi"] = array();

			while($ambil = mysqli_fetch_object($queryT))
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
				array_push($response["data_transaksi"], $F);
			}
		}else{
			$response['param'] = 0;	
		}
	}else{
		$response['param'] = 0;
	}

	echo json_encode($response);
	mysqli_close($conn);