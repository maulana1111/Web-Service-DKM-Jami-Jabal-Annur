<?php 

	require("koneksi.php");
	$response = array();
	$part = "/upload/";
	$filename = "img".rand(9,9999).".jpg";

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		if($_FILES['imageupload'])
		{
			$destination = $part.$filename;
			if(move_uploaded_file($_FILES['imageupload']['tmp_name'], $destination))
			{
				$imageupload = $filename;
				$query = mysqli_query($conn, "SELECT id FROM transaksi_janaiz ORDER BY id DESC LIMIT 1");
				$detail = mysqli_fetch_array($query);
				$id = $detail['id'];
				mysqli_query($conn, "UPDATE transaksi_janaiz SET gambar = '$imageupload' WHERE id = '$id'");
				$response['param'] = 1;
			}
		}else{
			$response['param'] = 0;
		}
	}else{
		$response['param'] = 0;
	}

	echo json_encode($response);
	mysqli_close($conn);