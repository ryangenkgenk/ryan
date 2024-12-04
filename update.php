<?php
include 'koneksi.php'; // Pastikan Anda sudah menghubungkan ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_GET['id'];
    $nama = $_POST["nama"];
    $kelas = $_POST["kelas"];
    $nilai_rata_rata = $_POST["nilai_rata_rata"];

    // Prepare statement untuk mencegah SQL Injection
    $sql = "UPDATE siswa SET nama = ?, kelas = ?, nilai_rata_rata = ? WHERE id = ?";
    $stmt = mysqli_prepare($koneksi, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssdi", $nama, $kelas, $nilai_rata_rata, $id); // "ssdi" berarti 2 string, 1 double, dan 1 integer

        if (mysqli_stmt_execute($stmt)) {
            // Redirect ke halaman index setelah berhasil memperbarui
            header("Location: index.php");
            exit;
        } else {
            echo "Error saat memperbarui data: " . mysqli_error($koneksi);
        }
    } else {
        echo "Error dalam persiapan statement: " . mysqli_error($koneksi);
    }
} else {
    echo "Metode tidak valid.";
}
?>