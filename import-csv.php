<?php
include("koneksi.php");
// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Path ke file CSV
$csvFile = 'C:\Users\Fahmi Rasyied\Documents\data-nomor.csv';

// Baca file CSV
if (($file = fopen($csvFile, 'r')) !== FALSE) {
    // Lewati header jika ada
    fgetcsv($file);

    // Siapkan pernyataan SQL
    $stmt = $conn->prepare("INSERT INTO data_nomor (geo_number, toll_free_number, number_translasi, customer, tanggal_aktif, server, status, is_delete) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    // Baca baris data dan masukkan ke tabel
    while (($row = fgetcsv($file)) !== FALSE) {
        // Sanitasi dan atur nilai default jika perlu
        $geo_number = $row[1] !== null ? $row[1] : '';
        $toll_free_number = $row[2] !== null ? $row[2] : '';
        $number_translasi = $row[3] !== null ? $row[3] : '';
        $customer = $row[4] !== null ? $row[4] : '';
        $tanggal_aktif = $row[5] !== null ? $row[5] : '';
        $server = $row[6] !== null ? $row[6] : '';
        $status = $row[7] !== null ? $row[7] : '';
        $is_delete = $row[8] !== null ? $row[8] : '';

        // Bind parameter dan eksekusi pernyataan
        $stmt->bind_param('ssssssss', $geo_number, $toll_free_number, $number_translasi, $customer, $tanggal_aktif, $server, $status, $is_delete);
        $stmt->execute();
    }

    // Tutup file dan pernyataan
    fclose($file);
    $stmt->close();
}

// Tutup koneksi
$conn->close();
?>
