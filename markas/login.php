<?php
session_start();
include "koneksi.php";

$email = $_POST['email'];
$password = $_POST['password'];

// Use prepared statements to prevent SQL injection
$stmt = $connect->prepare("SELECT * FROM tbl_user WHERE email_user=?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['pwd_user'])) {
        $_SESSION['username'] = $row['name_user'];
        $_SESSION['role'] = $row['role_user'];
        
        if ($row['role_user'] == "admin") {
            header("location: ./admin");
        } else {
            header("location: ./user");
        }
    } else {
        echo '<script language="javascript">
            window.alert("PASSWORD SALAH! Silakan coba lagi");
            window.location.href="./";
          </script>';
    }
} else {
    echo '<script language="javascript">
        window.alert("EMAIL TIDAK DITEMUKAN! Silakan coba lagi");
        window.location.href="./";
      </script>';
}