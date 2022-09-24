<?php 

	require("koneksi.php");
	$response = array();

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{

		$id = $_POST['id'];

		$kueri = "SELECT * FROM umat WHERE category_id = '$id'";
		$query = mysqli_query($conn, $kueri);
		$cek = mysqli_num_rows($query);

		if($cek > 0)
		{
			$response['param'] = 1;
			$total = 0;
			while($ambil = mysqli_fetch_object($query))
			{
				$total += 1;
			}
			$response["jumlah"] = $total;
		}else{

			$response['param'] = 0;
			
		}
	}else{
		$response['param'] = 0;
	}

	echo json_encode($response);
	mysqli_close($conn);