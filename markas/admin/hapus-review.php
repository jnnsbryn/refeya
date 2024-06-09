<?php
session_start();
if(isset($_SESSION['role'])){ // Jika tidak ada session role berarti dia belum login
	if ($_SESSION['role'] != "admin"){
		header("location: ../");
	}
} else {
	header("location: ../");
}
// Load file koneksi.php
include "../koneksi.php";

// Ambil data NIS yang dikirim oleh index.php melalui URL
$id = $_GET['id'];

// Check if the query was successful
if ($sql = mysqli_query($connect, "DELETE FROM tbl_review WHERE id_review='".$id."'")) {
    // Query successful, close the database connection
    mysqli_close($connect);
    header("location: ./manajemen-review.php");
} else {
    echo "Data gagal dihapus. <a href='./manajemen-review.php'>Kembali</a>";
}
?>