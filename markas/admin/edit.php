<?php
date_default_timezone_set("Asia/Jakarta");
// Load file koneksi.php
include "../koneksi.php";

// Ambil data NIS yang dikirim oleh form_ubah.php melalui URL
$id_cafe = $_GET['id_cafe'];

// Ambil Data yang Dikirim dari Form
$nama = $_POST['nama'];
$deskripsi = $_POST['deskripsi'];
$lokasi = $_POST['lokasi'];
$fasilitas = $_POST['fasilitas'];
$status = $_POST['status'];
$current_date = date("Y-m-d");

// Cek apakah user ingin mengubah fotonya atau tidak
if(isset($_POST['ubah_foto'])){ // Jika user menceklis checkbox yang ada di form ubah, lakukan :
	// Ambil data foto yang dipilih dari form
	$foto = $_FILES['foto']['name'];
	$tmp = $_FILES['foto']['tmp_name'];
	
	// Rename nama fotonya dengan menambahkan tanggal dan jam upload
	$fotobaru = date('dmYHis').$foto;
	
	// Set path folder tempat menyimpan fotonya
	$path = "../photos/".$fotobaru;

	// Proses upload
	if(move_uploaded_file($tmp, $path)){ // Cek apakah gambar berhasil diupload atau tidak
		// Query untuk menampilkan data siswa berdasarkan NIS yang dikirim
		$query = "SELECT * FROM tbl_cafe WHERE id_cafe='".$id_cafe."'";
		$sql = mysqli_query($connect, $query); // Eksekusi/Jalankan query dari variabel $query
		$data = mysqli_fetch_array($sql); // Ambil data dari hasil eksekusi $sql

		// Cek apakah file foto sebelumnya ada di folder images
		if(is_file("../photos/".$data['foto_cafe'])) // Jika foto ada
			unlink("../photos/".$data['foto_cafe']); // Hapus file foto sebelumnya yang ada di folder images
		
		// Proses ubah data ke Database
		$query = "UPDATE tbl_cafe SET nama_cafe='".$nama."', deskripsi_cafe='".$deskripsi."', lokasi_cafe='".$lokasi."', fasilitas_cafe='".$fasilitas."', foto_cafe='".$fotobaru."', updated_date='".$current_date."', status_cafe='".$status."' WHERE id_cafe='".$id_cafe."'";
		$sql = mysqli_query($connect, $query); // Eksekusi/ Jalankan query dari variabel $query

		if($sql){ // Cek jika proses simpan ke database sukses atau tidak
			// Jika Sukses, Lakukan :
			header("location: ./"); // Redirect ke halaman index.php
		}else{
			// Jika Gagal, Lakukan :
			echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
			echo "<br><a href='edit-cafe.php'>Kembali Ke Form</a>";
		}
	}else{
		// Jika gambar gagal diupload, Lakukan :
		echo "Maaf, Gambar gagal untuk diupload.";
		echo "<br><a href='edit-cafe.php'>Kembali Ke Form</a>";
	}
}else{ // Jika user tidak menceklis checkbox yang ada di form ubah, lakukan :
	// Proses ubah data ke Database
	$query = "UPDATE tbl_cafe SET nama_cafe='".$nama."', deskripsi_cafe='".$deskripsi."', lokasi_cafe='".$lokasi."', fasilitas_cafe='".$fasilitas."', updated_date='".$current_date."', status_cafe='".$status."' WHERE id_cafe='".$id_cafe."'";
	$sql = mysqli_query($connect, $query); // Eksekusi/ Jalankan query dari variabel $query

	if($sql){ // Cek jika proses simpan ke database sukses atau tidak
		// Jika Sukses, Lakukan :
		header("location: ./"); // Redirect ke halaman index.php
	}else{
		// Jika Gagal, Lakukan :
		echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
		echo "<br><a href='edit-cafe.php'>Kembali Ke Form</a>";
	}
}
?>
