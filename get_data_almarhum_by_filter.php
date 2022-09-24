<?php 

	require("koneksi.php");
	$response = array();

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{

		$fromDate = $_POST['fromDate'];
		$toDate = $_POST['toDate'];

		$kueri = "SELECT * FROM data_almarhum WHERE (tanggal_meninggal BETWEEN '$fromDate' AND '$toDate') ORDER BY id DESC";
		$query = mysqli_query($conn, $kueri);
		$cek = mysqli_num_rows($query);

		if($cek > 0)
		{
			$response['param'] = 1;
			$response["data"] = array();

			while($ambil = mysqli_fetch_object($query))
			{
				// $total += 1;
				$F['id'] = $ambil->id;
				$F['nama'] = $ambil->nama;
				$F['alamat'] = $ambil->alamat;
				$F['tanggal_meninggal'] = $ambil->tanggal_meninggal;
				$F['sebab_meninggal'] = $ambil->sebab_meninggal;
				$F['pemakaman'] = $ambil->pemakaman;
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