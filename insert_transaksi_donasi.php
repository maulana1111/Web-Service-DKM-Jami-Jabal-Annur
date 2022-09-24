<?php 

	require("koneksi.php");
	$response = array();
	$part = "./upload/";
	$filename = "img".rand(9,9999).".jpg";

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		if($_FILES['imageupload'])
		{
			$destination = $part.$filename;
			if(move_uploaded_file($_FILES['imageupload']['tmp_name'], $destination))
			{
				$id_anggota = $_POST["id_anggota"];

				$nominal_donasi = $_POST["nominal_donasi"];
				$catatan_donatur = $_POST["catatan_donatur"];
				$nama_anggota = "Donasi Dari ".$_POST["nama_anggota"];
				$nama_pengirim = $_POST["nama_pengirim"];
				$nomor_rekening = $_POST["nomor_rekening"];
				$imageupload = $filename;
				$tanggal_transaksi = $_POST["tanggal_transaksi"];
				$status_transaksi = $_POST["status_transaksi"];
				
				$id_perpanjangan = 0;

				mysqli_query($conn, "INSERT INTO donasi_janaiz(id_anggota, judul, nominal, tanggal, catatan) VALUES('$id_anggota','$nama_anggota','$nominal_donasi','$tanggal_transaksi', '$catatan_donatur')");

				$detDon = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM donasi_janaiz WHERE id_anggota = '$id_anggota' ORDER BY id DESC LIMIT 1"));

				$id_donasi = $detDon['id'];

				mysqli_query($conn, "INSERT INTO transaksi_janaiz(id_anggota, id_donasi, id_perpanjangan, nama_pengirim, nomor_rekening, gambar, tanggal_transaksi, status_transaksi) VALUES('$id_anggota','$id_donasi','$id_perpanjangan','$nama_pengirim','$nomor_rekening','$imageupload','$tanggal_transaksi','$status_transaksi')");

				$response['param_donasi'] = 1;
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