<?php
include("koneksi.php");
// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil ID dari URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // Query untuk mengambil data berdasarkan ID
    $query = "SELECT * FROM data_nomor WHERE id = $id";
    $result = $conn->query($query);

    // Periksa apakah data ditemukan
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Data tidak ditemukan.";
        exit;
    }
} else {
    echo "ID tidak disediakan.";
    exit;
}

// Update data setelah form disubmit
if (isset($_POST['submit'])) {
    $geo_number = $_POST['geo_number'];
    $toll_free_number = $_POST['toll_free_number'];
    $number_translasi = $_POST['number_translasi'];
    $customer = $_POST['customer'];
    $tanggal_aktif = $_POST['tanggal_aktif'];
    $server = $_POST['server'];
    $status = $_POST['status'];

    // Query untuk update data
    $update_query = "UPDATE data_nomor SET 
        geo_number = '$geo_number', 
        toll_free_number = '$toll_free_number', 
        number_translasi = '$number_translasi', 
        customer = '$customer', 
        tanggal_aktif = '$tanggal_aktif', 
        server = '$server', 
        status = '$status' 
        WHERE id = $id";

    if ($conn->query($update_query) === TRUE) {
        echo "Data berhasil diperbarui.";
        header("Location: tampil2.php"); // Kembali ke halaman daftar
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}

// Tutup koneksi
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Nomor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>    
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Edit Data Nomor</h1>
        <form action="" method="POST">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="geo_number" class="form-label">Geo Number:</label>
                        <input type="text" id="geo_number" name="geo_number" value="<?php echo $row['geo_number']; ?>" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="toll_free_number" class="form-label">Toll Free Number:</label>
                        <input type="text" id="toll_free_number" name="toll_free_number" value="<?php echo $row['toll_free_number']; ?>" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="number_translasi" class="form-label">Number Translasi:</label>
                        <select id="number_translasi" name="number_translasi" class="form-select" required>
                            <option value="Yes" <?php echo ($row['number_translasi'] == 'Yes') ? 'selected' : ''; ?>>Yes</option>
                            <option value="No" <?php echo ($row['number_translasi'] == 'No') ? 'selected' : ''; ?>>No</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="customer" class="form-label">Customer:</label>
                        <input type="text" id="customer" name="customer" value="<?php echo $row['customer']; ?>" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="tanggal_aktif" class="form-label">Tanggal Aktif:</label>
                        <input type="date" id="tanggal_aktif" name="tanggal_aktif" value="<?php echo $row['tanggal_aktif']; ?>" class="form-control">
                    </div>
                    
                    <div class="mb-3">
                        <label for="server" class="form-label">Server:</label>
                        <input type="text" id="server" name="server" value="<?php echo $row['server']; ?>" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="status" class="form-label">Status:</label>
                        <select id="status" name="status" class="form-select" required>
                            <option value="Aktif" <?php if ($row['status'] == 'Aktif') echo 'selected'; ?>>Aktif</option>
                            <option value="Available" <?php if ($row['status'] == 'Available') echo 'selected'; ?>>Available</option>
                        </select>
                    </div>
                </div>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Perbarui Data</button>
            <a href="tampil2.php" class="btn btn-secondary">Kembali ke Daftar</a>
        </form>
    </div>
</body>
</html>