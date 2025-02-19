<?php
include("koneksi.php");
if (isset($_POST['submit'])) {
    // Ambil data dari formulir
    $geo_number = $_POST['geo_number'];
    $toll_free_number = $_POST['toll_free_number'];
    $number_translasi = $_POST['number_translasi'];
    $customer = $_POST['customer'];
    $tanggal_aktif = $_POST['tanggal_aktif'];
    $server = $_POST['server'];
    $status = $_POST['status'];

    // Query untuk menambahkan data
    $query = "INSERT INTO data_nomor (geo_number, toll_free_number, number_translasi, customer, tanggal_aktif, server, status) 
              VALUES ('$geo_number', '$toll_free_number', '$number_translasi', '$customer', '$tanggal_aktif', '$server', '$status')";

    // Eksekusi query
    if ($conn->query($query) === TRUE) {
        echo "Data berhasil ditambahkan.";
        ?>
        <script>
            alert("Data Berhasil Ditambahkan");
            window.location.replace("tampil2.php");
        </script>
        <?php
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
}

// Tutup koneksi
$conn->close();
?>
