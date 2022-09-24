<?php 

	require("koneksi.php");
	$response = array();

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{

		$id = $_POST['id'];
		$kondisi = $_POST['kondisi'];


		if($kondisi == "Diterima")
		{
			//update status transaksi
			mysqli_query($conn, "UPDATE transaksi_janaiz SET status_transaksi = 'Diterima' WHERE id = '$id' ");

			$detail_transaksi = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM transaksi_janaiz WHERE id = '$id' "));
			$detail_id_anggota = $detail_transaksi['id_anggota'];
			$detail_id_per = $detail_transaksi['id_perpanjangan'];
			$detail_id_donasi = $detail_transaksi['id_donasi'];

			mysqli_query($conn, "UPDATE anggota_janaiz SET status_keanggotaan = 'aktif' WHERE id = '$detail_id_anggota' ");
			$detail_anggota = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM anggota_janaiz WHERE id = '$detail_id_anggota' "));
			$namaAnggota = $detail_anggota['nama'];
			$due_date = $detail_anggota['due_date'];
			$dueDate = date("Y-m", strtotime($due_date));
			$judul = "Infaq Dari ".$namaAnggota;

			if($detail_id_donasi != 0)
			{
				$detail_donasi = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM donasi_janaiz WHERE id = '$detail_id_donasi' "));
				$getDetailJudulDonasi = $detail_donasi['judul'];
				$getDetailNominalDonasi = $detail_donasi['nominal'];
				$getDetailTanggalDonasi = $detail_donasi['tanggal'];

				mysqli_query($conn, "INSERT INTO keuangan_janaiz(judul, nominal, tanggal, kategori_keuangan, status_keuangan) VALUES('$getDetailJudulDonasi','$getDetailNominalDonasi','$getDetailTanggalDonasi','Donasi','Pemasukan')");
			}

			if($detail_id_per != 0)
			{
				$detail_perpanjangan = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM perpanjangan_janaiz WHERE id = '$detail_id_per' "));
				$getDetail = $detail_perpanjangan['batas_infaq'];
				$getDetailNominal = $detail_perpanjangan['nominal'];
				$getDetailTanggal = $detail_perpanjangan['tanggal_infaq'];
				$batas = date("Y-m", strtotime($getDetail));

				if($dueDate < $batas)
				{
					mysqli_query($conn, "UPDATE anggota_janaiz SET due_date = '$getDetail' WHERE id = '$detail_id_anggota' ");
				}

				mysqli_query($conn, "INSERT INTO keuangan_janaiz(judul, nominal, tanggal, kategori_keuangan, status_keuangan) VALUES('$judul','$getDetailNominal','$getDetailTanggal','Infaq Kematian','Pemasukan')");
			}



		}else{
			mysqli_query($conn, "UPDATE transaksi_janaiz SET status_transaksi = 'Ditolak' WHERE id = '$id' ");
		}


		$response['param'] = 1;
	}else{
		$response['param'] = 0;
	}

	echo json_encode($response);
	mysqli_close($conn);