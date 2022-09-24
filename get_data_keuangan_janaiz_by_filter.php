<?php 

	require("koneksi.php");
	$response = array();

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{

		$fromDate = $_POST['fromDate'];
		$toDate = $_POST['toDate'];
		$category = $_POST['category'];
		$opsi = $_POST['opsi'];

		if($category != "Semua")
		{
			$kueri = "SELECT * FROM keuangan_janaiz WHERE (tanggal BETWEEN '$fromDate' AND '$toDate') AND kategori_keuangan = '$category' AND status_keuangan = '$opsi' ORDER BY id DESC ";

			$query = mysqli_query($conn, $kueri);
			$cek = mysqli_num_rows($query);

			if($cek > 0)
			{
				$total = 0;
				$response['param'] = 1;
				$response["data"] = array();

				while($ambil = mysqli_fetch_object($query))
				{
					
					$F['id'] = $ambil->id;
					$F['judul'] = $ambil->judul;
					$F['tanggal'] = $ambil->tanggal;
					$F['nominal'] = $ambil->nominal;
					$F['kategori_keuangan'] = $ambil->kategori_keuangan;
					$F['status_keuangan'] = $ambil->status_keuangan;

					if($ambil->status_keuangan == "Pemasukan")
					{
						$total += $ambil->nominal;
					}else if($ambil->status_keuangan == "Pengeluaran")
					{
						$total -= $ambil->nominal;
					}

					array_push($response["data"], $F);
				}
				$response['total_uang'] = $total;
			}
		}else{
			$kueri = "SELECT * FROM keuangan_janaiz WHERE (tanggal BETWEEN '$fromDate' AND '$toDate') AND status_keuangan = '$opsi' ORDER BY id DESC ";

			$query = mysqli_query($conn, $kueri);
			$cek = mysqli_num_rows($query);

			if($cek > 0)
			{
				$total = 0;
				$total_donasi = 0;
				$total_infaq = 0;
				$response['param'] = 1;
				$response["data_donasi"] = array();
				$response["data_infaq"] = array();

				while($ambil = mysqli_fetch_object($query))
				{
					
					$F['id'] = $ambil->id;
					$F['judul'] = $ambil->judul;
					$F['tanggal'] = $ambil->tanggal;
					$F['nominal'] = $ambil->nominal;
					$F['kategori_keuangan'] = $ambil->kategori_keuangan;
					$F['status_keuangan'] = $ambil->status_keuangan;
					if($ambil->kategori_keuangan == "Donasi")
					{
						array_push($response["data_donasi"], $F);
					}else{
						array_push($response["data_infaq"], $F);
					}

					if($ambil->kategori_keuangan == "Donasi")
					{
						$total_donasi += $ambil->nominal;
					}else{
						$total_infaq += $ambil->nominal;
					}

					if($ambil->status_keuangan == "Pemasukan")
					{
						$total += $ambil->nominal;
					}else if($ambil->status_keuangan == "Pengeluaran")
					{
						$total -= $ambil->nominal;
					}

				}
				$response['total_uang'] = $total;
				$response['total_donasi'] = $total_donasi;
				$response['total_infaq'] = $total_infaq;
			}
		}
	}else{
		$response['param'] = 0;
	}

	echo json_encode($response);
	mysqli_close($conn);