<?php 

	require("koneksi.php");
	$response = array();

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{

		$id = $_POST['id'];
		$time = $_POST['time'];

	
		if($time == 1)// per hari
		{
			$kueri_lalu = "SELECT * FROM laporan_keuangan WHERE category_id = '$id' AND DATE(tanggal) < CURRENT_DATE()";
			$kueri_sekarang = "SELECT * FROM laporan_keuangan WHERE category_id = '$id' AND DATE(tanggal) = CURRENT_DATE()";

			$query_lalu = mysqli_query($conn, $kueri_lalu);
			$query_sekarang1 = mysqli_query($conn, $kueri_sekarang);
			$query_sekarang2 = mysqli_query($conn, $kueri_sekarang);
			$query_sekarang3 = mysqli_query($conn, $kueri_sekarang);

			$total_uang_pengeluaran = 0;
			$total_uang_pemasukan = 0;

			$total_uang_lalu = 0;
			$total_uang_sekarang = 0;

			//ntuk mengambil data uang pemasukan dan uang pengeluaran
			while($uang = mysqli_fetch_object($query_sekarang1))
			{
				if($uang->status_laporan == "Pemasukan")
				{
					$total_uang_pemasukan += $uang->nominal;
				}else if($uang->status_laporan == "Pengeluaran")
				{
					$total_uang_pengeluaran += $uang->nominal;
				}
			}
			$response['total_pengeluaran'] = $total_uang_pengeluaran;
			$response['total_pemasukan'] = $total_uang_pemasukan;

			// //untuk mengambil data uang lalu
			while($data_lalu = mysqli_fetch_object($query_lalu))
			{
				if($data_lalu->status_laporan == "Pemasukan")
				{
					$total_uang_lalu += $data_lalu->nominal;
				}else if($data_lalu->status_laporan == "Pengeluaran")
				{
					$total_uang_lalu -= $data_lalu->nominal;
				}
			}
			$response['total_uang_lalu'] = $total_uang_lalu;

			//untuk mengambil data uang sekarang
			while($data_sekarang = mysqli_fetch_object($query_sekarang2))
			{
				if($data_sekarang->status_laporan == "Pemasukan")
				{
					$total_uang_sekarang += $data_sekarang->nominal;
				}else if($data_sekarang->status_laporan == "Pengeluaran")
				{
					$total_uang_sekarang -= $data_sekarang->nominal;
				}
			}
			$response['total_uang_sekarang'] = $total_uang_sekarang;

			$response['data_pengeluaran'] = array();
			$response['data_pemasukan'] = array();

			//untuk mengambil data pengeluaran dan data pemasukan
			while($data = mysqli_fetch_object($query_sekarang3))
			{
				if($data->status_laporan == "Pemasukan")
				{
					$F['judul'] = $data->judul;
					$F['nominal'] = $data->nominal;
					array_push($response['data_pemasukan'], $F);
				}else if($data->status_laporan == "Pengeluaran")
				{
					$F['judul'] = $data->judul;
					$F['nominal'] = $data->nominal;
					array_push($response['data_pengeluaran'], $F);
				}
			}

		}else if($time == 2)
		{
			$kueri_lalu = "SELECT * FROM laporan_keuangan WHERE category_id = '$id' AND tanggal < now() - interval 1 week";
			$kueri_sekarang = "SELECT * FROM laporan_keuangan WHERE category_id = '$id' AND  tanggal > now() - interval 1 week";

			$query_lalu = mysqli_query($conn, $kueri_lalu);
			$query_sekarang1 = mysqli_query($conn, $kueri_sekarang);
			$query_sekarang2 = mysqli_query($conn, $kueri_sekarang);
			$query_sekarang3 = mysqli_query($conn, $kueri_sekarang);

			$total_uang_pengeluaran = 0;
			$total_uang_pemasukan = 0;

			$total_uang_lalu = 0;
			$total_uang_sekarang = 0;

			//ntuk mengambil data uang pemasukan dan uang pengeluaran
			while($uang = mysqli_fetch_object($query_sekarang1))
			{
				if($uang->status_laporan == "Pemasukan")
				{
					$total_uang_pemasukan += $uang->nominal;
				}else if($uang->status_laporan == "Pengeluaran")
				{
					$total_uang_pengeluaran += $uang->nominal;
				}
			}
			$response['total_pengeluaran'] = $total_uang_pengeluaran;
			$response['total_pemasukan'] = $total_uang_pemasukan;

			// //untuk mengambil data uang lalu
			while($data_lalu = mysqli_fetch_object($query_lalu))
			{
				if($data_lalu->status_laporan == "Pemasukan")
				{
					$total_uang_lalu += $data_lalu->nominal;
				}else if($data_lalu->status_laporan == "Pengeluaran")
				{
					$total_uang_lalu -= $data_lalu->nominal;
				}
			}
			$response['total_uang_lalu'] = $total_uang_lalu;

			//untuk mengambil data uang sekarang
			while($data_sekarang = mysqli_fetch_object($query_sekarang2))
			{
				if($data_sekarang->status_laporan == "Pemasukan")
				{
					$total_uang_sekarang += $data_sekarang->nominal;
				}else if($data_sekarang->status_laporan == "Pengeluaran")
				{
					$total_uang_sekarang -= $data_sekarang->nominal;
				}
			}
			$response['total_uang_sekarang'] = $total_uang_sekarang;

			$response['data_pengeluaran'] = array();
			$response['data_pemasukan'] = array();

			//untuk mengambil data pengeluaran dan data pemasukan
			while($data = mysqli_fetch_object($query_sekarang3))
			{
				if($data->status_laporan == "Pemasukan")
				{
					$F['judul'] = $data->judul;
					$F['nominal'] = $data->nominal;
					array_push($response['data_pemasukan'], $F);
				}else if($data->status_laporan == "Pengeluaran")
				{
					$F['judul'] = $data->judul;
					$F['nominal'] = $data->nominal;
					array_push($response['data_pengeluaran'], $F);
				}
			}
		}else if($time == 3)
		{
			$kueri_lalu = "SELECT * FROM laporan_keuangan WHERE category_id = '$id' AND tanggal < now() - interval 1 month";
			$kueri_sekarang = "SELECT * FROM laporan_keuangan WHERE category_id = '$id' AND  tanggal > now() - interval 1 month";

			$query_lalu = mysqli_query($conn, $kueri_lalu);
			$query_sekarang1 = mysqli_query($conn, $kueri_sekarang);
			$query_sekarang2 = mysqli_query($conn, $kueri_sekarang);
			$query_sekarang3 = mysqli_query($conn, $kueri_sekarang);

			$total_uang_pengeluaran = 0;
			$total_uang_pemasukan = 0;

			$total_uang_lalu = 0;
			$total_uang_sekarang = 0;

			//ntuk mengambil data uang pemasukan dan uang pengeluaran
			while($uang = mysqli_fetch_object($query_sekarang1))
			{
				if($uang->status_laporan == "Pemasukan")
				{
					$total_uang_pemasukan += $uang->nominal;
				}else if($uang->status_laporan == "Pengeluaran")
				{
					$total_uang_pengeluaran += $uang->nominal;
				}
			}
			$response['total_pengeluaran'] = $total_uang_pengeluaran;
			$response['total_pemasukan'] = $total_uang_pemasukan;

			// //untuk mengambil data uang lalu
			while($data_lalu = mysqli_fetch_object($query_lalu))
			{
				if($data_lalu->status_laporan == "Pemasukan")
				{
					$total_uang_lalu += $data_lalu->nominal;
				}else if($data_lalu->status_laporan == "Pengeluaran")
				{
					$total_uang_lalu -= $data_lalu->nominal;
				}
			}
			$response['total_uang_lalu'] = $total_uang_lalu;

			//untuk mengambil data uang sekarang
			while($data_sekarang = mysqli_fetch_object($query_sekarang2))
			{
				if($data_sekarang->status_laporan == "Pemasukan")
				{
					$total_uang_sekarang += $data_sekarang->nominal;
				}else if($data_sekarang->status_laporan == "Pengeluaran")
				{
					$total_uang_sekarang -= $data_sekarang->nominal;
				}
			}
			$response['total_uang_sekarang'] = $total_uang_sekarang;

			$response['data_pengeluaran'] = array();
			$response['data_pemasukan'] = array();

			//untuk mengambil data pengeluaran dan data pemasukan
			while($data = mysqli_fetch_object($query_sekarang3))
			{
				if($data->status_laporan == "Pemasukan")
				{
					$F['judul'] = $data->judul;
					$F['nominal'] = $data->nominal;
					array_push($response['data_pemasukan'], $F);
				}else if($data->status_laporan == "Pengeluaran")
				{
					$F['judul'] = $data->judul;
					$F['nominal'] = $data->nominal;
					array_push($response['data_pengeluaran'], $F);
				}
			}
		}else if($time == 4)
		{
			$kueri_lalu = "SELECT * FROM laporan_keuangan WHERE category_id = '$id' AND tanggal < now() - interval 1 year";
			$kueri_sekarang = "SELECT * FROM laporan_keuangan WHERE category_id = '$id' AND  tanggal > now() - interval 1 year";

			$query_lalu = mysqli_query($conn, $kueri_lalu);
			$query_sekarang1 = mysqli_query($conn, $kueri_sekarang);
			$query_sekarang2 = mysqli_query($conn, $kueri_sekarang);
			$query_sekarang3 = mysqli_query($conn, $kueri_sekarang);

			$total_uang_pengeluaran = 0;
			$total_uang_pemasukan = 0;

			$total_uang_lalu = 0;
			$total_uang_sekarang = 0;

			//ntuk mengambil data uang pemasukan dan uang pengeluaran
			while($uang = mysqli_fetch_object($query_sekarang1))
			{
				if($uang->status_laporan == "Pemasukan")
				{
					$total_uang_pemasukan += $uang->nominal;
				}else if($uang->status_laporan == "Pengeluaran")
				{
					$total_uang_pengeluaran += $uang->nominal;
				}
			}
			$response['total_pengeluaran'] = $total_uang_pengeluaran;
			$response['total_pemasukan'] = $total_uang_pemasukan;

			// //untuk mengambil data uang lalu
			while($data_lalu = mysqli_fetch_object($query_lalu))
			{
				if($data_lalu->status_laporan == "Pemasukan")
				{
					$total_uang_lalu += $data_lalu->nominal;
				}else if($data_lalu->status_laporan == "Pengeluaran")
				{
					$total_uang_lalu -= $data_lalu->nominal;
				}
			}
			$response['total_uang_lalu'] = $total_uang_lalu;

			//untuk mengambil data uang sekarang
			while($data_sekarang = mysqli_fetch_object($query_sekarang2))
			{
				if($data_sekarang->status_laporan == "Pemasukan")
				{
					$total_uang_sekarang += $data_sekarang->nominal;
				}else if($data_sekarang->status_laporan == "Pengeluaran")
				{
					$total_uang_sekarang -= $data_sekarang->nominal;
				}
			}
			$response['total_uang_sekarang'] = $total_uang_sekarang;

			$response['data_pengeluaran'] = array();
			$response['data_pemasukan'] = array();

			//untuk mengambil data pengeluaran dan data pemasukan
			while($data = mysqli_fetch_object($query_sekarang3))
			{
				if($data->status_laporan == "Pemasukan")
				{
					$F['judul'] = $data->judul;
					$F['nominal'] = $data->nominal;
					array_push($response['data_pemasukan'], $F);
				}else if($data->status_laporan == "Pengeluaran")
				{
					$F['judul'] = $data->judul;
					$F['nominal'] = $data->nominal;
					array_push($response['data_pengeluaran'], $F);
				}
			}
		}

	}
	echo json_encode($response);
	mysqli_close($conn);