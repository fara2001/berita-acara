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
        <form action="proses-tambah-data.php" method="POST">
            <div class="mb-3">
                <label for="geo_number" class="form-label">Geo Number:</label>
                <input type="text" id="geo_number" name="geo_number" class="form-control" required>
            </div>
            
            <div class="mb-3">
                <label for="toll_free_number" class="form-label">Toll Free Number:</label>
                <input type="text" id="toll_free_number" name="toll_free_number" class="form-control" required>
            </div>
            
            <div class="mb-3">
                <label for="number_translasi" class="form-label">Number Translasi:</label>
                <select id="number_translasi" name="number_translasi" class="form-select" required>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
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
            
            
            
            <button type="submit" name="submit" class="btn btn-primary">Tambah Data</button>
            <a href="index.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

    </body>
</html>
