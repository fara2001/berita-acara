<?php
include("koneksi.php");

if (isset($_POST['submit'])) {
    $geo_number_awal = $_POST['geo_number_awal'];
    $geo_number_akhir = $_POST['geo_number_akhir'];
    $toll_free_number_awal = $_POST['toll_free_number_awal'];
    $toll_free_number_akhir = $_POST['toll_free_number_akhir'];
    $customer = $_POST['customer'];
    $server = $_POST['server'];
    $status = $_POST['status'];
    $tanggal_aktif = $_POST['tanggal_aktif'];

    if (($geo_number_akhir - $geo_number_awal) != ($toll_free_number_akhir - $toll_free_number_awal)) {
        echo "<script>alert('Rentang nomor tidak sesuai');
        history.back()</script>";
    } else {
        for ($i = $geo_number_awal; $i <= $geo_number_akhir; $i++) {
            $geo_number = $i;
            $toll_free_number = $toll_free_number_awal + ($i - $geo_number_awal);
            $number_translasi = "No";
            $is_delete = 0;

            $geo_number = "0" . $geo_number;
            $toll_free_number = "0" . $toll_free_number;
            $query = "INSERT INTO data_nomor (geo_number, toll_free_number, number_translasi, customer, tanggal_aktif, server, status, is_delete) VALUES ('$geo_number', '$toll_free_number', '$number_translasi', '$customer', '$tanggal_aktif', '$server', '$status', '$is_delete')";            $conn->query($query);
        }

        echo "Data Berhasil Diinput Secara Massal";
        ?>
        <script>
            alert("Data Berhasil Diinput Secara Massal");
            window.location.replace("tampil2.php");
        </script>
        <?php
    }
}


