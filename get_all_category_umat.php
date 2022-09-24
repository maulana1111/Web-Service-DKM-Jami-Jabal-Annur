<?php 

	require("koneksi.php");
	$query = mysqli_query($conn, "SELECT * FROM category_umat");
	$cek = mysqli_num_rows($query);

	if($cek > 0)
	{
		$response['param'] = 1;
		$response["data"] = array();

		while($ambil = mysqli_fetch_object($query))
		{
			$F['id'] = $ambil->id;
			$F['nama_category'] = $ambil->nama_category;

			array_push($response["data"], $F);
		}
	}
	
	echo json_encode($response);
	mysqli_close($conn);