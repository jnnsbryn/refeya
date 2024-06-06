<?php
date_default_timezone_set("Asia/Jakarta");

// Load file koneksi.php
include "../koneksi.php";

// Ambil Data yang Dikirim dari Form
$nama = $_POST['nama'];
$deskripsi = $_POST['deskripsi'];
$lokasi = $_POST['lokasi'];
$fasilitas = $_POST['fasilitas'];
$foto = $_FILES['foto']['name'];
$tmp = $_FILES['foto']['tmp_name'];
$current_date = date("Y-m-d");

// Rename nama fotonya dengan menambahkan tanggal dan jam upload
$fotobaru = date('dmYHis').$foto;

// Set path folder tempat menyimpan fotonya
$path = "../photos/".$fotobaru;

// Proses upload
if(move_uploaded_file($tmp, $path)) {
    // Proses simpan ke Database
    $query = "INSERT INTO tbl_cafe (nama_cafe, deskripsi_cafe, lokasi_cafe, fasilitas_cafe, foto_cafe, input_date, updated_date)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($connect, $query);
    mysqli_stmt_bind_param($stmt, 'sssssss', $nama, $deskripsi, $lokasi, $fasilitas, $fotobaru, $current_date, $current_date);
    mysqli_stmt_execute($stmt);

    if(mysqli_stmt_affected_rows($stmt) > 0) {
        // Jika Sukses, Lakukan :
        header("location: ./");
    } else {
        // Jika Gagal, Lakukan :
        echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
        echo "<br><a href='./manajemen_cafe.php'>Kembali Ke Form</a>";
    }
} else {
    // Jika gambar gagal diupload, Lakukan :
    echo "Maaf, Gambar gagal untuk diupload.";
    echo "<br><a href='./manajemen_cafe.php'>Kembali Ke Form</a>";
}

// Error handling
if(mysqli_error($connect)) {
    echo "Error: " . mysqli_error($connect);
}
?>