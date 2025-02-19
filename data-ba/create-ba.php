<?php
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header('Location: ../login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<?php
include('../koneksi.php');
?>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Tambah Data BA</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->

    <style type="text/css">
        * {
            font-family: "Trebuchet MS";
        }

        h1 {
            text-transform: uppercase;
            color: blue;
        }

        table {
            border: 1px solid #ddeeee;
            border-collapse: collapse;
            border-spacing: 0;
            width: 90%;
            margin: 10px auto 10px auto;
        }

        th,
        td {
            border: 1px solid #ddeeee;
            padding: 20px;
            text-align: left;
        }

        .pencet:hover {
            background-color: cyan;
        }
    </style>
    <script>
        function confirmDelete() {
            return confirm("Apakah Anda yakin ingin menghapus data ini?");
        }
    </script>
</head>

<body>
    
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="lihat-ba.php">Data BA</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../tampil2.php">Data Number</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php"><button type="button" class="btn btn-danger">Logout</button></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Kategori BA
                </div>
                <div class="card-body">
                    <form action="proses-ba.php" method="post">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="ba" id="pasang-baru" value="Pasang Baru">
                            <label class="form-check-label" for="pasang-baru"> New Installation </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="ba" id="deaktivasi" value="De-Aktivasi" required>
                            <label class="form-check-label" for="deaktivasi"> De-activation </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="ba" id="upgrade" value="Upgrade" required>
                            <label class="form-check-label" for="upgrade"> Upgrade </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="ba" id="downgrade" value="Downgrade" required>
                            <label class="form-check-label" for="downgrade"> Downgrade </label>
                        </div>
                        <div class="form-group">
                            <label for="perusahaan">Perusahaan:</label>
                            <select class="form-select" name="perusahaan" id="perusahaan">
                                <option value="PT DIGITAL SATELLITE INDONESIA">PT DIGITAL SATELLITE INDONESIA</option>
                                <option value="PT DIGITAL WIRELESS INDONESIA">PT DIGITAL WIRELESS INDONESIA</option>
                                <option value="PT DIGITAL KOMUNIKASI LINTAS SARANA">PT DIGITAL KOMUNIKASI LINTAS SARANA</option>
                                <option value="TELCO ALLIED SINGAPORE Pte. Ltd.">TELCO ALLIED SINGAPORE Pte. Ltd.</option>
                            </select>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Buat sekarang</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>