<?php 

	require("koneksi.php");
	$response = array();

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$nama = $_POST["nama"];
		$no_telp = $_POST["no_telp"];
		$alamat = $_POST["alamat"];
		$rw = $_POST["rw"];
		$username = $_POST["username"];
		$password = $_POST["password"];
		$date = $_POST["date"];
		$status_keanggotaan = "aktif";

		$status_transaksi = "Diterima";
		$id_donasi = 0;

		$lama_infaq = $_POST['lama_infaq'];
		$nominal = $_POST['nominal'];
		$tanggal_transaksi = $_POST['tanggal_transaksi'];

		mysqli_query($conn, "INSERT INTO anggota_janaiz(id_transaksi,nama,no_telp,alamat,rw,username,password,status_keanggotaan, due_date) VALUES(0,'$nama','$no_telp','$alamat','$rw','$username','$password','$status_keanggotaan', '$date')");

		$detail_anggota = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM anggota_janaiz ORDER BY id DESC LIMIT 1"));
		$detail_id_anggota = $detail_anggota['id'];
		$detail_nama_anggota = $detail_anggota['nama'];
		$judul = "Infaq Dari ".$detail_nama_anggota;

		mysqli_query($conn, "INSERT INTO perpanjangan_janaiz(id_anggota,lama_infaq,nominal,tanggal_infaq,batas_infaq) VALUES('$detail_id_anggota', '$lama_infaq', '$nominal', '$tanggal_transaksi', DATE_ADD('$tanggal_transaksi', INTERVAL '$lama_infaq' YEAR))");

		$detai_per = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM perpanjangan_janaiz WHERE id_anggota = '$detail_id_anggota' ORDER BY id DESC LIMIT 1"));
		$detail_per_id = $detai_per['id'];
		$detail_per_batas = $detai_per['batas_infaq'];

		mysqli_query($conn, "UPDATE anggota_janaiz SET due_date = '$detail_per_batas' WHERE id = '$detail_id_anggota'");


		mysqli_query($conn, "INSERT INTO keuangan_janaiz(judul,nominal,tanggal,kategori_keuangan,status_keuangan) VALUES('$judul','$nominal','$tanggal_transaksi','Infaq Kematian','Pemasukan')");

		mysqli_query($conn, "INSERT INTO transaksi_janaiz(id_anggota,id_donasi,id_perpanjangan,nama_pengirim,nomor_rekening,gambar,tanggal_transaksi,status_transaksi) VALUES('$detail_id_anggota','0','$detail_per_id','','','','$tanggal_transaksi','Diterima')");

		// $response['param_perpanjangan'] = 1;

		$response['param'] = 1;
	
	}else{
		$response['param'] = 0;
	}

	echo json_encode($response);
	mysqli_close($conn);
