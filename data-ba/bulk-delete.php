<?php
include '../koneksi.php';

if (isset($_POST['hapus-check'])) {
    $ids = $_POST['id'];
    if (!empty($ids)) {
        foreach ($ids as $id) {
            $query = "DELETE FROM ba WHERE id = $id";
            if ($conn->query($query) === TRUE) {
                ?>
                <script>
                    alert("Data Berhasil Terhapus");
                    window.location.href = "lihat-ba.php";
                </script>
                <?php
            } else {
                ?>
                <script>
                    alert("Data Gagal Dihapus");
                    window.location.href = "lihat-ba.php";
                </script>
                <?php
            }
        }
    }
}

exit();
?>

