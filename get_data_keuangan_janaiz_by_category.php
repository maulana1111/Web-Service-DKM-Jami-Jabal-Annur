<?php 

	require("koneksi.php");
	$response = array();

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{

		$category_name = $_POST['kategori'];

		$kueri = "SELECT * FROM keuangan_janaiz WHERE kategori_keuangan = '$category_name' ORDER BY id DESC";

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

		}else{
			$response['param'] = 0;
		}
	}else{
		$response['param'] = 0;
	}

	echo json_encode($response);
	mysqli_close($conn);