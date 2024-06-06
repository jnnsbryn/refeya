<?php
	date_default_timezone_set("Asia/Jakarta");
	include "../koneksi.php";

	$id_cafe = $_GET['id_cafe'];
	$current_date = date("Y-m-d");

	$query = "UPDATE tbl_cafe SET updated_date='".$current_date."', status_cafe='1' WHERE id_cafe='".$id_cafe."'";
	$sql = mysqli_query($connect, $query);
	header("location: ./manajemen-cafe.php");
?>
