<?php 

	require("koneksi.php");
	$response = array();

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{

		$category_id = $_POST['category_id'];
		$opsi = $_POST['opsi'];
		$fromDate = $_POST['fromDate'];
		$toDate = $_POST['toDate'];

		$kueri = "SELECT laporan_keuangan.*, category_laporan_keuangan.nama_category FROM laporan_keuangan, category_laporan_keuangan WHERE category_laporan_keuangan.id = laporan_keuangan.category_id AND laporan_keuangan.category_id = '$category_id' AND (tanggal BETWEEN '$fromDate' AND '$toDate') AND status_laporan = '$opsi'";
		$query = mysqli_query($conn, $kueri);
		$cek = mysqli_num_rows($query);

		if($cek > 0)
		{
			$response["data"] = array();
			$total = 0;

			while($ambil = mysqli_fetch_object($query))
			{
				$total += $ambil->nominal;
				$F['id'] = $ambil->id;
				$F['judul'] = $ambil->judul;
				$F['tanggal'] = $ambil->tanggal;
				$F['nominal'] = $ambil->nominal;
				$F['nama_kategori'] = $ambil->nama_category;
				$F['status_laporan'] = $ambil->status_laporan;
				array_push($response["data"], $F);
			}

			$response['total_uang'] = $total;
			$response['param'] = 1;
		}else{
			$response['param'] = 0;
		}
	}else{
		$response['param'] = 0;
	}

	echo json_encode($response);
	mysqli_close($conn);