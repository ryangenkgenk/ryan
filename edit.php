<?php
include 'koneksi.php'; // Pastikan Anda sudah menghubungkan ke database

// Ambil data siswa berdasarkan ID yang di-edit
$id = $_GET['id'];
$sql = "SELECT * FROM siswa WHERE id = ?";
$stmt = mysqli_prepare($koneksi, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Siswa</title>
    <link rel="stylesheet" type="text/css" href="style.css"> 
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
    <h1>Edit Siswa</h1>
    <form method="post" action="update.php?id=<?php echo $row['id']; ?>" class="form-container">
        <div class="form-group">
            <label for="nama">Nama:</label>
            <input type="text" name="nama" value="<?php echo $row['nama']; ?>" required>
        </div>

        <div class="form-group">
            <label for="kelas">Kelas:</label>
            <input type="text" name="kelas" value="<?php echo $row['kelas']; ?>" required>
        </div>

        <div class="form-group">
            <label for="nilai_rata_rata">Nilai Rata-rata:</label>
            <input type="number" step="0.01" name="nilai_rata_rata" value="<?php echo $row['nilai_rata_rata']; ?>" required>
        </div>
        
        <input type="submit" value="Update">
    </form>
    
    <a href="index.php">Kembali</a> <!-- Tautan "Kembali" di bawah form -->
</body>
</html>