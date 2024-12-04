<?php
include 'koneksi.php';

$id = $_GET['id'];

$sql = "DELETE FROM siswa WHERE id = ?";
$stmt = mysqli_prepare($koneksi, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
if (mysqli_stmt_execute($stmt)) {
    header("Location: index.php");
    exit;
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>