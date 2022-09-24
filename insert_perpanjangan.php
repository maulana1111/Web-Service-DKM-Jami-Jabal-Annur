<?php 

	require("koneksi.php");
	$response = array();
	$part = "./upload/";
	$filename = "img".rand(99,999999999999999999999999999).".jpg";

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		if($_FILES['imageupload'])
		{
			$destination = $part.$filename;
			if(move_uploaded_file($_FILES['imageupload']['tmp_name'], $destination))
			{
				$id_anggota = $_POST["id_anggota"];

				$lama_infaq = $_POST["lama_infaq"];
				$nominal_donasi = $_POST["nominal_donasi"];
				$total_nominal_infaq = $_POST["total_nominal_infaq"];
				$nama_anggota = "Donasi Dari ".$_POST["nama_anggota"];
				$nama_pengirim = $_POST["nama_pengirim"];
				$nomor_rekening = $_POST["nomor_rekening"];
				$imageupload = $filename;
				$tanggal_transaksi = $_POST["tanggal_transaksi"];
				$status_transaksi = $_POST["status_transaksi"];
				$catatan_donatur = $_POST["catatan_donatur"];

				// $judul = "Donasi Dari "+$nama_anggota;

				$cek = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM perpanjangan_janaiz WHERE id_anggota = '$id_anggota' ORDER BY id DESC"));

				if($cek > 0)
				{
					$detail = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM perpanjangan_janaiz WHERE id_anggota = '$id_anggota' ORDER BY id DESC LIMIT 1"));
					$detail_batas = $detail['batas_infaq'];

					$batas_waktu = date("Y-m", strtotime($detail_batas));
					$now_date = date("Y-m", strtotime($_POST["tanggal_transaksi"]));
					if($now_date >= $batas_waktu)
					{
						mysqli_query($conn, "INSERT INTO perpanjangan_janaiz(id_anggota, lama_infaq, nominal, tanggal_infaq, batas_infaq) VALUES('$id_anggota','$lama_infaq','$total_nominal_infaq', '$tanggal_transaksi',DATE_ADD('$tanggal_transaksi', INTERVAL '$lama_infaq' YEAR))");

						$response['param_perpanjangan'] = 1;
					}else{
						mysqli_query($conn, "INSERT INTO perpanjangan_janaiz(id_anggota, lama_infaq, nominal, tanggal_infaq, batas_infaq) VALUES('$id_anggota','$lama_infaq','$total_nominal_infaq', '$tanggal_transaksi',DATE_ADD('$detail_batas', INTERVAL '$lama_infaq' YEAR))");

						$response['param_perpanjangan'] = 1;
					}
				}else{
					mysqli_query($conn, "INSERT INTO perpanjangan_janaiz(id_anggota, lama_infaq, nominal, tanggal_infaq, batas_infaq) VALUES('$id_anggota','$lama_infaq','$total_nominal_infaq', '$tanggal_transaksi',DATE_ADD('$tanggal_transaksi', INTERVAL '$lama_infaq' YEAR))");

					$response['param_perpanjangan'] = 1;
				}

				$detPer = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM perpanjangan_janaiz WHERE id_anggota = '$id_anggota' ORDER BY id DESC LIMIT 1"));
				$id_perpanjangan = $detPer['id'];

				// $id_donasi = 0;

				if($nominal_donasi != 0)
				{
					mysqli_query($conn, "INSERT INTO donasi_janaiz(id_anggota, judul, nominal, tanggal, catatan) VALUES('$id_anggota','$nama_anggota','$nominal_donasi','$tanggal_transaksi', '$catatan_donatur')");

					$detDon = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM donasi_janaiz WHERE id_anggota = '$id_anggota' ORDER BY id DESC LIMIT 1"));

					$id_donasi = $detDon['id'];
					$response['param_donasi'] = 1;
				}else{
					$id_donasi = 0;
					$response['param_donasi'] = 0;
				}

				mysqli_query($conn, "INSERT INTO transaksi_janaiz(id_anggota, id_donasi, id_perpanjangan, nama_pengirim, nomor_rekening, gambar, tanggal_transaksi, status_transaksi) VALUES('$id_anggota','$id_donasi','$id_perpanjangan','$nama_pengirim','$nomor_rekening','$imageupload','$tanggal_transaksi','$status_transaksi')");

				$response['param_transaksi'] = 1;

			}else{
				$response['param_transaksi'] = 0;
			}
		}else{
			$response['param_transaksi'] = 0;
		}
	}else{
		$response['param_transaksi'] = 0;
	}

	echo json_encode($response);
	mysqli_close($conn);