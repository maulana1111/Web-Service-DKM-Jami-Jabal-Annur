<?php 

	require("koneksi.php");
	$response = array();

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$param_id = $_POST["id"];

		mysqli_query($conn, "DELETE FROM kajian WHERE id = '$param_id'");
		$response['param'] = 1;

	}else{
		$response['param'] = 0;
	}

	echo json_encode($response);
	mysqli_close($conn);