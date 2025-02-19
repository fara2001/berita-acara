<?php
session_start();
include("koneksi.php");

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil ID dari URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
}
// Cek apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<?php
include('koneksi.php');

$cekUsername = $_SESSION['username'];
                        $querySession = "SELECT role FROM user WHERE username = '$cekUsername'";
                        $resultSession = $conn->query($querySession);
                        $rowSession = $resultSession->fetch_assoc();
                        $cekRole = $rowSession['role'];

if (isset($_POST['hapus'])) {
    // Ambil ID dari array $_POST['id']
    $id = $_POST['id'];
    
    // Query untuk update kolom is_delete menjadi 1 untuk setiap ID yang dipilih
    foreach ($id as $row) {
        $delete_query = "UPDATE data_nomor SET is_delete = 1 WHERE id = " . intval($row);
        if ($conn->query($delete_query) === TRUE) {
            echo "Data berhasil dihapus.";
        } else {
            echo "Error: " . $conn->error;
        }
    }
    
    header("Location: tampil2.php"); // Kembali ke halaman daftar
    exit;
} else {
    echo "Tidak ada data yang dipilih.";
    exit;
}

// Tutup koneksi
$conn->close();
?>

