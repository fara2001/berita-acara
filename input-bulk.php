<?php
session_start();

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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Tambah Data Nomor</h1>
        <form action="proses-input-bulk.php" method="POST">
        <label for="geo_number_awal" class="form-label">Geo Number Awal:</label>
            <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">0</span>
                    <input type="text" name="geo_number_awal" class="form-control" placeholder="Geo Number Awal" aria-label="Geo Number Awal" aria-describedby="basic-addon1"  required pattern="^[1-9][0-9]*$" oninput="this.value = this.value.replace(/^0+/, '');">
            </div>
        <label for="geo_number_akhir" class="form-label">Geo Number Akhir:</label>
            <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">0</span>
                    <input type="text" name="geo_number_akhir" class="form-control" placeholder="Geo Number Akhir" aria-label="Geo Number Akhir" aria-describedby="basic-addon1"  required pattern="^[1-9][0-9]*$" oninput="this.value = this.value.replace(/^0+/, '');">       
            </div>
            
        <label for="toll_free_number_awal" class="form-label">Toll Free Number Awal:</label>
            <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">0</span>
                    <input type="text" name="toll_free_number_awal" class="form-control" value="800" placeholder="Toll Free Number Awal" aria-label="Toll Free Number Awal" aria-describedby="basic-addon1"  required pattern="^[1-9][0-9]*$" oninput="this.value = this.value.replace(/^0+/, '');">
            </div>

            <div class="input-group mb-3">
                <button type="button" class="btn btn-secondary" onclick="hitungTollFree()">Hitung</button>
            </div>
            <script>
                function hitungTollFree() {
                    var geo_number_awal = document.querySelector('input[name="geo_number_awal"]').value;
                    var geo_number_akhir = document.querySelector('input[name="geo_number_akhir"]').value;
                    var toll_free_number_awal = document.querySelector('input[name="toll_free_number_awal"]').value;
                    var toll_free_number_akhir = parseInt(toll_free_number_awal) + (parseInt(geo_number_akhir) - parseInt(geo_number_awal));
                    document.querySelector('input[name="toll_free_number_akhir"]').value = toll_free_number_akhir;
                }
            </script>
            <p id="hasilHitung" style="font-weight:bold;color:red;"></p>
            <script>
                function hitungTollFree() {
                    var geo_number_awal = document.querySelector('input[name="geo_number_awal"]').value;
                    var geo_number_akhir = document.querySelector('input[name="geo_number_akhir"]').value;
                    var toll_free_number_awal = document.querySelector('input[name="toll_free_number_awal"]').value;
                    var toll_free_number_akhir = parseInt(toll_free_number_awal) + (parseInt(geo_number_akhir) - parseInt(geo_number_awal));
                    document.querySelector('input[name="toll_free_number_akhir"]').value = toll_free_number_akhir;
                    document.querySelector('#hasilHitung').innerHTML = "Hasil hitungan rentang jumlah selisih nomor adalah " + (parseInt(geo_number_akhir) - parseInt(geo_number_awal)) + " nomor";
                }
            </script>

        <label for="toll_free_number_akhir" class="form-label">Toll Free Number Akhir:</label>
            <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1">0</span>
                    <input type="text" name="toll_free_number_akhir" class="form-control" placeholder="Toll Free Number Akhir" aria-label="Toll Free Number Akhir" aria-describedby="basic-addon1"  required readonly pattern="^[1-9][0-9]*$" oninput="this.value = this.value.replace(/^0+/, '');">
                    <script>
                        var geo_number_awal = document.querySelector('input[name="geo_number_awal"]');
                        var geo_number_akhir = document.querySelector('input[name="geo_number_akhir"]');
                        var toll_free_number_awal = document.querySelector('input[name="toll_free_number_awal"]');
                        var toll_free_number_akhir = document.querySelector('input[name="toll_free_number_akhir"]');

                        geo_number_akhir.addEventListener('input', function(){
                            var cek_selisih = parseInt(geo_number_akhir.value) - parseInt(geo_number_awal.value);
                            toll_free_number_akhir.value = parseInt(toll_free_number_awal.value) + cek_selisih;
                        });
                    </script>
            </div>
            
            
            <div class="mb-3">
                <label for="customer" class="form-label">Customer:</label>
                <input type="text" id="customer" name="customer" class="form-control" required>
            </div>
            
            <div class="mb-3">
                <label for="tanggal_aktif" class="form-label">Tanggal Aktif:</label>
                <input type="date" id="tanggal_aktif" name="tanggal_aktif" class="form-control">
            </div>
            
            <div class="mb-3">
                <label for="server" class="form-label">Server:</label>
                <input type="text" id="server" name="server" class="form-control" required>
            </div>
            
            <div class="mb-3">
                <label for="status" class="form-label">Status:</label>
                <select id="status" name="status" class="form-select" required>
                    <option value="Available">Available</option>
                    <option value="Aktif">Aktif</option>
                </select>
            </div>
            
            <button type="submit" name="submit" class="btn btn-primary">Tambah Data Secara Massal</button>
            <a href="index.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

    </body>
</html>
