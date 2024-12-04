<?php
include 'koneksi.php';

// query untuk mengambil semua data siswa
$sql = "SELECT * FROM siswa";
$result = mysqli_query($koneksi, $sql);
?>

<?php
session_start(); // Memulai session
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Arahkan ke halaman login jika belum login
    exit;
}




// Cek apakah tombol ekspor ditekan
if (isset($_POST['export_excel'])) {
    // Koneksi ke database
    include 'koneksi.php';

    // Buat file Excel
    $fileName = 'daftar_siswa.xls';
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="' . $fileName . '"');
    header('Pragma: no-cache');
    header('Expires: 0');

    // Tampilkan data siswa dalam format Excel
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Nama</th><th>Kelas</th><th>Nilai Rata-rata</th></tr>";

    $sql = "SELECT * FROM siswa";
    $result = mysqli_query($koneksi, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>{$row['id']}</td>";
        echo "<td>{$row['nama']}</td>";
        echo "<td>{$row['kelas']}</td>";
        echo "<td>{$row['nilai_rata_rata']}</td>";
        echo "</tr>";
    }

    echo "</table>";

    mysqli_close($koneksi);
    exit;
}


?>



<!DOCTYPE html>
<html>
<head>
    <title>Daftar Siswa</title>
    <link rel="stylesheet" type="text/css" href="style.css"> 
    <link rel="stylesheet" href="styles.css">
    <style>
        body, html {
            height: 100%; 
            margin: 0; 
            overflow: hidden; 
        }

        .video-background {
            position: absolute;
            top: 50%;
            left: 50%;
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            z-index: -1; 
            transform: translate(-50%, -50%); 
        }

        .content {
            position: relative; 
            z-index: 1; 
            color: white; 
            text-align: center; 
        }

        
    </style>
</head>
<body>
    <!-- Menambahkan video sebagai latar belakang -->
    <video autoplay muted loop class="video-background">
        <source src="vidio.mp4" type="video/mp4"> 
        Your browser does not support the video tag.
    </video>

    <div class="content">
        <h1>Daftar Siswa</h1>
</div>
   <div class="right-butoon">
<form method="post" action="">
            <button type="submit" name="export_excel" class="btn btn-success">Ekspor ke Excel</button>
        </form>
     </div> 


    <link rel="stylesheet" href="style.css">

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Nilai Rata-rata</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['nama']; ?></td>
                    <td><?php echo $row['kelas']; ?></td>
                    <td><?php echo $row['nilai_rata_rata']; ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
                        <a href="hapus.php?id=<?php echo $row['id']; ?>">Hapus</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

         
<!-- Menambahkan jarak -->
        <a href="tambah.php" style="color: yellow; font-weight: bold;">Tambah Siswa</a> 
    </div>
<br>
       <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>

</body>
</html>