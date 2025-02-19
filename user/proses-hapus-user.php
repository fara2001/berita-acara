<?php
include "../koneksi.php";

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil ID dari URL
if (isset($_GET['username'])) {
    $username = $_GET['username'];
    
    // Query untuk menghapus data user
    $delete_query = "DELETE FROM user WHERE username = '$username'";

    if ($conn->query($delete_query) === TRUE) {
        ?>
        <script>
            alert("Data Berhasil Dihapus");
            window.location.replace("index.php");
        </script>
    <?php
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Username tidak disediakan.";
    exit;
}

// Tutup koneksi
$conn->close();
?>
