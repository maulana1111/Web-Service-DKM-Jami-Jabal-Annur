<?php 

	require("koneksi.php");
	$response = array();

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$response['param'] = 1;

		$status_transaksi = "Diterima";
		$id_donasi = 0;
		$id_anggota = $_POST['id_anggota'];
		$lama_infaq = $_POST['lama_infaq'];
		$nominal = $_POST['nominal'];
		$tanggal_transaksi = $_POST['tanggal_transaksi'];

		$cek = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM perpanjangan_janaiz WHERE id_anggota = '$id_anggota' ORDER BY id DESC"));

		if($cek > 0)
		{

			$detail = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM perpanjangan_janaiz WHERE id_anggota = '$id_anggota' ORDER BY id DESC LIMIT 1"));
			$detail_batas = $detail['batas_infaq'];

			$batas_waktu = date("Y-m", strtotime($detail_batas));
			$now_date = date("Y-m", strtotime($tanggal_transaksi));

			if($now_date >= $batas_waktu)
			{
				mysqli_query($conn, "INSERT INTO perpanjangan_janaiz(id_anggota,lama_infaq,nominal,tanggal_infaq,batas_infaq) VALUES('$id_anggota', '$lama_infaq', '$nominal', '$tanggal_transaksi', DATE_ADD('$tanggal_transaksi', INTERVAL '$lama_infaq' YEAR))");

				$response['param_perpanjangan'] = 1;
			}else{
				mysqli_query($conn, "INSERT INTO perpanjangan_janaiz(id_anggota,lama_infaq,nominal,tanggal_infaq,batas_infaq) VALUES('$id_anggota', '$lama_infaq', '$nominal', '$tanggal_transaksi', DATE_ADD('$detail_batas', INTERVAL '$lama_infaq' YEAR))");

				$response['param_perpanjangan'] = 1;
			}

		}else{
			mysqli_query($conn, "INSERT INTO perpanjangan_janaiz(id_anggota,lama_infaq,nominal,tanggal_infaq,batas_infaq) VALUES('$id_anggota', '$lama_infaq', '$nominal', '$tanggal_transaksi', DATE_ADD('$tanggal_transaksi', INTERVAL '$lama_infaq' YEAR))");

			$response['param_perpanjangan'] = 1;
		}

		$ndetail_angg = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM anggota_janaiz WHERE id = '$id_anggota' ORDER BY id DESC LIMIT 1"));
		$ndetail_angg_nama = $ndetail_angg['nama'];
		$judul = "Infaq Dari ".$ndetail_angg_nama;

		$ndetail = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM perpanjangan_janaiz WHERE id_anggota = '$id_anggota' ORDER BY id DESC LIMIT 1"));
		$ndetail_id = $ndetail['id'];
		$ndetail_batas = $ndetail['batas_infaq'];

		mysqli_query($conn, "UPDATE anggota_janaiz SET due_date = '$ndetail_batas' WHERE id = '$id_anggota'");

		mysqli_query($conn, "INSERT INTO keuangan_janaiz(judul,nominal,tanggal,kategori_keuangan,status_keuangan) VALUES('$judul','$nominal','$tanggal_transaksi','Infaq Kematian','Pemasukan')");

		mysqli_query($conn, "INSERT INTO transaksi_janaiz(id_anggota,id_donasi,id_perpanjangan,nama_pengirim,nomor_rekening,gambar,tanggal_transaksi,status_transaksi) VALUES('$id_anggota','0','$ndetail_id','','','','$tanggal_transaksi','Diterima')");

	}else{
		$response['param'] = 0;
	}

	echo json_encode($response);
	mysqli_close($conn);