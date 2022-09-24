<?php 

	require("koneksi.php");

	$kueri = "SELECT laporan_keuangan.*, category_laporan_keuangan.nama_category
				FROM laporan_keuangan, category_laporan_keuangan WHERE category_laporan_keuangan.id =
				laporan_keuangan.category_id ORDER BY id DESC";

	$next_kueri = "SELECT * FROM laporan_keuangan";

	$next_query = mysqli_query($conn, $next_kueri);
	$query = mysqli_query($conn, $kueri);
	$cek = mysqli_num_rows($query);

	if($cek > 0)
	{
		$total = 0;

		$response['param'] = 1;
		while($uang = mysqli_fetch_object($next_query))
		{

			if($uang->status_laporan == "Pemasukan")
			{
				$total += $uang->nominal;
			}else if($uang->status_laporan == "Pengeluaran")
			{
				$total -= $uang->nominal;
			}
		}

		$response['total_uang'] = $total;
		$response["data"] = array();

		while($ambil = mysqli_fetch_object($query))
		{

			$F['id'] = $ambil->id;
			$F['judul'] = $ambil->judul;
			$F['tanggal'] = $ambil->tanggal;
			$F['nominal'] = $ambil->nominal;
			$F['nama_kategori'] = $ambil->nama_category;
			$F['status_laporan'] = $ambil->status_laporan;
			array_push($response["data"], $F);
		}
	}else{
		$response['param'] = 0;
	}
	
	echo json_encode($response);
	mysqli_close($conn);