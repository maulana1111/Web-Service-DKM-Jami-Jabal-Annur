<?php 

	require("koneksi.php");
	$response = array();

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{

		$id = $_POST['id'];

		$kueri = "SELECT * FROM transaksi_janaiz WHERE id = '$id'";
		$detail_transaksi = mysqli_fetch_array(mysqli_query($conn, $kueri));

		$idTransaksi = $detail_transaksi['id'];
		$idAnggota = $detail_transaksi['id_anggota'];
		$idDonasi = $detail_transaksi['id_donasi'];
		$idPerpanjangan = $detail_transaksi['id_perpanjangan'];

		$kueri_anggota = "SELECT * FROM anggota_janaiz WHERE id = '$idAnggota'";
		$condition_anggota = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM anggota_janaiz WHERE id = '$idAnggota' AND id_transaksi = '$idTransaksi'"));

		$kueri_donasi = "SELECT * FROM donasi_janaiz WHERE id = '$idDonasi'";

		$kueri_perpanjangan = "SELECT * FROM perpanjangan_janaiz WHERE id = '$idPerpanjangan'";

		$query = mysqli_query($conn, $kueri);

		$queryAnggota = mysqli_query($conn, $kueri_anggota);
		$countAnggota = mysqli_num_rows($queryAnggota);
		$queryDonasi = mysqli_query($conn, $kueri_donasi);
		$queryPerpanjangan = mysqli_query($conn, $kueri_perpanjangan);
		$cek = mysqli_num_rows($query);

		if($cek > 0)
		{
			$response["data_transaksi"] = array();
			$response["data_anggota"] = array();
			$response["data_donasi"] = array();
			$response["data_perpanjangan"] = array();

			//get transaksi
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
				array_push($response["data_transaksi"], $F);

			}
			$response['param_transaksi'] = 1;	

			//get anggota
			if($countAnggota)
			{
				while($ambil_anggota = mysqli_fetch_object($queryAnggota))
				{
					$G['id'] = $ambil_anggota->id;
					$G['nama'] = $ambil_anggota->nama;
					$G['no_telp'] = $ambil_anggota->no_telp;
					$G['alamat'] = $ambil_anggota->alamat;
					$G['rw'] = $ambil_anggota->rw;
					$G['status_keanggotaan'] = $ambil_anggota->status_keanggotaan;
					$G['due_date'] = $ambil_anggota->due_date;
					array_push($response["data_anggota"], $G);
				}
				$response['next_param_anggota'] = 1;	
				if($condition_anggota > 0)
				{
					$response['param_anggota'] = 1;	
				}else{
					$response['param_anggota'] = 0;
				}
			}else{
				$response['next_param_anggota'] = 0;	
			}
			

			//get donasi
			if($idDonasi != 0)
			{
				while($ambil_donasi = mysqli_fetch_object($queryDonasi))
				{
					$H['id'] = $ambil_donasi->id;
					$H['judul'] = $ambil_donasi->judul;
					$H['nominal'] = $ambil_donasi->nominal;
					$H['tanggal'] = $ambil_donasi->tanggal;
					$H['catatan'] = $ambil_donasi->catatan;
					array_push($response["data_donasi"], $H);
				}
				$response['param_donasi'] = 1;	
			}else{
				$response['param_donasi'] = 0;	
			}

			// //get perpanjangan
			if($idPerpanjangan != 0)
			{
				while($ambil_per = mysqli_fetch_object($queryPerpanjangan))
				{
					$I['id'] = $ambil_per->id;
					$I['lama_infaq'] = $ambil_per->lama_infaq;
					$I['nominal'] = $ambil_per->nominal;
					$I['tanggal_infaq'] = $ambil_per->tanggal_infaq;
					$I['batas_infaq'] = $ambil_per->batas_infaq;
					array_push($response["data_perpanjangan"], $I);
				}
				$response['param_perpanjangan'] = 1;	
			}else{
				$response['param_perpanjangan'] = 0;	
			}


		}else{
			$response['param'] = 0;	
		}
	}else{
		$response['param'] = 0;
	}

	echo json_encode($response);
	mysqli_close($conn);