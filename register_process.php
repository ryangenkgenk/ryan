<?php
include 'koneksi.php'; // Pastikan koneksi ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password

    // Menyimpan data ke database
    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = mysqli_prepare($koneksi, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $username, $password);

    if (mysqli_stmt_execute($stmt)) {
        header("Location: login.php?message=registrasi_berhasil");
        exit;
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }

    mysqli_close($koneksi); // Menutup koneksi
} else {
    echo "Metode tidak valid.";
}
?>