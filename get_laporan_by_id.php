<?php 

	require("koneksi.php");
	$response = array();

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{

		$id = $_POST['id'];

		$kueri = "SELECT laporan_keuangan.*, category_laporan_keuangan.nama_category
				FROM laporan_keuangan, category_laporan_keuangan WHERE category_laporan_keuangan.id = laporan_keuangan.category_id AND laporan_keuangan.id = '$id' ";
		$query = mysqli_query($conn, $kueri);
		$cek = mysqli_num_rows($query);

		if($cek > 0)
		{
			$response['param'] = 1;
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
	}else{
		$response['param'] = 0;
	}

	echo json_encode($response);
	mysqli_close($conn);