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
   // echo "Metode tidak valid.";
}
?>




<!DOCTYPE html>
<html>
<head>
    <title>Tambah Siswa</title>
    <link rel="stylesheet" type="text/css" href="style.css"> <!-- Menyertakan file CSS -->
    <style>
        body {
            font-family: Arial, sans-serif; /* Mengatur font */
            background-color: #f4f4f4; /* Latar belakang halaman */
            padding: 20px; /* Padding untuk seluruh halaman */
        }

        h1 {
            text-align: center; /* Pusatkan judul */
            color: black; /* Mengatur warna judul menjadi hitam */
        }

        .form-container {
            display: flex; /* Menggunakan flexbox */
            flex-direction: column; /* Susun kolom secara vertikal */
            align-items: center; /* Pusatkan elemen di tengah */
            max-width: 400px; /* Maksimal lebar form */
            margin: 0 auto; /* Pusatkan form */
            background-color: white; /* Latar belakang putih untuk form */
            padding: 20px; /* Padding di dalam form */
            border-radius: 8px; /* Sudut membulat */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Bayangan untuk efek 3D */
        }

        .form-group {
            display: flex; /* Menggunakan flexbox untuk grup input */
            justify-content: space-between; /* Menjaga jarak antar label dan input */
            width: 100%; /* Lebar penuh */
            margin-bottom: 15px; /* Jarak antar grup */
        }

        label {
            width: 30%; /* Lebar label */
            color: black; /* Mengatur warna label menjadi hitam */
        }

        input[type="text"],
        input[type="number"] {
            width: 65%; /* Lebar input */
            padding: 8px; /* Padding di dalam input */
            border: 1px solid #ccc; /* Border input */
            border-radius: 4px; /* Sudut membulat untuk input */
            color: black; /* Mengatur warna teks input menjadi hitam */
        }

        input[type="submit"] {
            background-color: #28a745; /* Warna latar belakang tombol */
            color: white; /* Warna teks tombol */
            border: none; /* Menghilangkan border */
            padding: 10px 15px; /* Padding di dalam tombol */
            border-radius: 4px; /* Sudut membulat untuk tombol */
            cursor: pointer; /* Menunjukkan kursor saat hover */
            margin-top: 10px; /* Jarak atas untuk tombol */
        }

        input[type="submit"]:hover {
            background-color: #218838; /* Warna latar belakang saat hover */
        }

        a {
            display: block; /* Menjadikan tautan sebagai blok agar mudah di klik */
            text-align: center; /* Pusatkan teks tautan */
            margin-top: 20px; /* Jarak atas untuk tautan */
            color: black; /* Mengatur warna tautan menjadi hitam */
            text-decoration: none; /* Menghapus garis bawah */
        }

        a:hover {
            text-decoration: underline; /* Menambahkan garis bawah saat hover */
        }
    </style>
</head>
<body>
    <h1>Tambah Siswa</h1>
    <form method="post" action="simpan.php" class="form-container">
        <div class="form-group">
            <label for="nama">Nama:</label>
            <input type="text" name="nama" required>
        </div>

        <div class="form-group">
            <label for="kelas">Kelas:</label>
            <input type="text" name="kelas" required>
        </div>

        <div class="form-group">
            <label for="nilai_rata_rata">Nilai Rata-rata:</label>
            <input type="number" step="0.01" name="nilai_rata_rata" required>
        </div>
        
        <input type="submit" value="Simpan">
    </form>
    
    <a href="index.php">Kembali</a> <!-- Tautan "Kembali" di bawah form -->
</body>
</html>