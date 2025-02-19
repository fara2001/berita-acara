<?php
include("../koneksi.php");

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil ID dari URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // Query untuk hapus data
    $delete_query = "DELETE FROM ba WHERE id = $id";

    if ($conn->query($delete_query) === TRUE) {
        echo "<script>alert('Data berhasil dihapus');
        window.location.href='lihat-ba.php';
        </script>";
        // header("Location: lihat-ba.php"); 
        // Kembali ke halaman daftar
        exit;
    } else {
        echo "Error: " . $delete_query . "<br>" . $conn->error;
    }
} else {
    echo "ID tidak disediakan.";
    exit;
}

// Tutup koneksi
$conn->close();
?>
