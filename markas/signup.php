<?php
date_default_timezone_set("Asia/Jakarta");
session_start();

if(isset($_SESSION['role'])){ // Jika tidak ada session role berarti dia belum login
    if ($_SESSION['role'] == "admin"){
        header("location: ./admin");
    } else if ($_SESSION['role'] == "user"){
        header("location: ./user");
    }
}

include "koneksi.php";

if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

    // Check if email is not available in database
    $email = $_POST['email'];
    $query = "SELECT * FROM tbl_user WHERE email_user = ?";
    $stmt = mysqli_prepare($connect, $query);
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($result) > 0) {
        // If email is available, return to buat-akun.php
        header("Location: ./buat-akun.php");
        exit();
    } else {
        // Check if password meets the criteria
        $password = $_POST['password'];
        if (strlen($password) < 8 || strlen($password) > 16) {
            // If password does not meet the criteria, return to buat-akun.php
            header("Location: ./buat-akun.php");
            exit();
        }
        
        // Hash the password
        $options = [
            'cost' => 10,
        ];
        $hashed_password = password_hash($password, PASSWORD_DEFAULT, $options);
        
        // Insert data into database
        $query = "INSERT INTO tbl_user (email_user, pwd_user) VALUES (?, ?)";
        $stmt = mysqli_prepare($connect, $query);
        mysqli_stmt_bind_param($stmt, 'ss', $email, $hashed_password);
        mysqli_stmt_execute($stmt);
        
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            // If data is inserted successfully, redirect to index.php for login
            header("Location: ./index.php");
            exit();
        } else {
            echo "Error inserting data: " . mysqli_stmt_error($stmt);
        }
    }

// Close database connection
mysqli_close($connect);

?>