<?php
include 'koneksi.php'; // Pastikan Anda sudah menghubungkan ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST["nama"];
    $kelas = $_POST["kelas"];
    $nilai_rata_rata = $_POST["nilai_rata_rata"];

    // Prepare statement untuk mencegah SQL Injection
    $sql = "INSERT INTO siswa (nama, kelas, nilai_rata_rata) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($koneksi, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssd", $nama, $kelas, $nilai_rata_rata); // "ssd" berarti 2 string dan 1 double

        if (mysqli_stmt_execute($stmt)) {
            // Redirect ke halaman index setelah berhasil menyimpan
            header("Location: index.php");
            exit;
        } else {
            echo "Error saat menyimpan data: " . mysqli_error($koneksi);
        }
    } else {
        echo "Error dalam persiapan statement: " . mysqli_error($koneksi);
    }
} else {
    echo "Metode tidak valid.";
}
?>