<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['username'])) {
    header('Location: ../login.php');
    exit();
}

$cekUsername = $_SESSION['username'];
$querySession = "SELECT role FROM user WHERE username = '$cekUsername'";
$resultSession = $conn->query($querySession);
$rowSession = $resultSession->fetch_assoc();
$cekRole = $rowSession['role'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencarian Data BA</title>
    <style>
        * { font-family: "Trebuchet MS"; }
        h1 { text-transform: uppercase; }
        table { border: 1px solid #ddeeee; border-collapse: collapse; border-spacing: 0; width: 90%; margin: 10px auto; }
        th, td { border: 1px solid #ddeeee; padding: 20px; text-align: left; }
        .pencet:hover { background-color: cyan; }
    </style>
    <script>
        function confirmDelete() {
            return confirm("Apakah Anda yakin ingin menghapus data ini?");
        }
        
        // JavaScript untuk ceklis semua
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById('check-all').addEventListener('click', function(event) {
                let checkboxes = document.querySelectorAll ('input[name="id[]"]');
                checkboxes.forEach(checkbox => checkbox.checked = event.target.checked);
            });
        });
    </script>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="lihat-ba.php">Data BA</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link active" href="../tampil2.php">Data Number</a></li>
                    <?php if ($cekRole == "admin") { ?>
                    <li class="nav-item"><a class="nav-link active" href="../user/index.php">Data User</a></li>
                    <?php } ?>
                </ul>
                <!-- <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="../logout.php"><button type="button" class="btn btn-danger">Logout</button></a></li>
                </ul> -->
            </div>
<?php
// Tambahkan query untuk mengambil nama pengguna dari database
$queryProfile = "SELECT username FROM user WHERE username = '$cekUsername'";
$resultProfile = $conn->query($queryProfile);
$rowProfile = $resultProfile->fetch_assoc();
$namaPengguna = $rowProfile['username'];
?>

<!-- Tambahkan elemen lingkaran profil di navbar -->
<ul class="navbar-nav ms-auto">
    <li class="nav-item">
        <div class="d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#modalProfile">
            <img src="../img/naruto.png" alt="Profile" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover; cursor: pointer;">
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="../logout.php"><button type="button" class="btn btn-danger">Logout</button></a>
    </li>
</ul>

<!-- Modal -->
<div class="modal fade" id="modalProfile" tabindex="-1" aria-labelledby="modalProfileLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalProfileLabel">Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Tambahkan elemen foto profil di kiri dengan ukuran sedang -->
                <div class="d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#modalProfile">
                    <img src="../img/naruto.png" alt="Profile" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover; cursor: pointer;">
                </div>
                <br>
                <p>Username: <?php echo $namaPengguna; ?></p>
                <p>Role: <?php echo $cekRole; ?></p>
                <a href="../user/ganti-password.php" class="btn btn-danger">Ganti Password</a>
            </div>
        </div>
    </div>
</div>
        </div>
    </nav>

    <!-- Container -->
    <div class="container">
        <h1 align="center">Lihat Data BA</h1>
        
        <!-- Form Pencarian -->
        <form method="GET" action="lihat-ba.php" class="d-flex">
            <input class="form-control me-2" type="search" name="cari" placeholder="Cari BA, Nomor Surat, atau Perusahaan" aria-label="Search" value="<?php echo isset($_GET['cari']) ? $_GET['cari'] : ''; ?>">
            <button class="btn btn-success" style="margin-right: 5px;" type="submit">Search</button>
            <button class="btn btn-secondary" type="button" onclick="location.href='lihat-ba.php'">Reset</button>
        </form>
        <br>

        <?php if ($cekRole == "admin" || $cekRole == "editor") { ?>
        <div class="d-grid gap-2 d-md-flex justify-content-md-start">
            <a href="create-ba.php" class="btn btn-primary">Tambah Data</a>
        </div>
        <br>
        <?php } ?>

        <?php
        // Pencarian dan Pagination
        $cari = isset($_GET['cari']) ? $_GET['cari'] : '';
        $halaman = isset($_GET['halaman']) ? $_GET['halaman'] : 1;
        $limit = 10;
        $offset = ($halaman - 1) * $limit;

        $query = "SELECT id, ba, nomor_surat, tanggal, perusahaan FROM ba WHERE ba LIKE '%$cari%' OR nomor_surat LIKE '%$cari%' OR perusahaan LIKE '%$cari%' ORDER BY id DESC LIMIT $limit OFFSET $offset";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            echo "<form method='POST' action='bulk-delete.php'>
                    <table class='table table-bordered table-hover'>
                    <thead>
                        <tr>";
                        if ($cekRole == "admin" || $cekRole == "editor") {
                            echo "<th style='width: 2%;'><input type='checkbox' id='check-all'></th>";
                        }
                        echo "<th style='width: 2%;'>No</th>
                            <th>BA</th>
                            <th>Nomor Surat</th>
                            <th>Tanggal</th>
                            <th>Perusahaan</th>";
                        if ($cekRole == "admin" || $cekRole == "editor") {
                            echo "<th>Aksi</th>";
                        }
                        echo "</tr>
                    </thead>
                    <tbody>";

            $no = 1 + $offset;
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                if ($cekRole == "admin" || $cekRole == "editor") {
                    echo "<td><input type='checkbox' name='id[]' value='" . $row['id'] . "'></td>";
                }
                echo "<td style='text-align: center'>" . $no . "</td>
                    <td>" . $row['ba'] . "</td>
                    <td>" . $row['nomor_surat'] . "</td>
                    <td>" . $row['tanggal'] . "</td>
                    <td>" . $row['perusahaan'] . "</td>
                    <td>
                        <a style='margin-right: 5px' href='lihat-ba-detail.php?id=" . $row['id'] . "' class='btn btn-success'>Lihat</a>";
                if ($cekRole == "admin" || $cekRole == "editor") {
                    echo "<a href='edit-ba.php?id=" . $row['id'] . "' class='btn btn-primary'>Edit</a>
                          <a href='hapus-ba.php?id=" . $row['id'] . "' class='btn btn-danger' onclick='return confirmDelete();'>Hapus</a>";
                }
                echo "</td></tr>";
                $no++;
            }
            if ($cekRole == "admin" || $cekRole == "editor") {
                echo "<tr><td colspan='7'>
                        <button type='submit' class='btn btn-danger' name='hapus-check' onclick='return confirmDelete();'>Hapus yang dipilih</button>
                      </td></tr>";
            }
            echo "</tbody></table></form>";
        } else {
            echo "<p class='text-center'>Data tidak ditemukan</p>";
        }

        // Pagination
        $queryJumlah = "SELECT COUNT(*) AS jumlah FROM ba WHERE ba LIKE '%$cari%' OR nomor_surat LIKE '%$cari%' OR perusahaan LIKE '%$cari%'";
        $resultJumlah = $conn->query($queryJumlah);
        $rowJumlah = $resultJumlah->fetch_assoc();
        $jumlahData = intval($rowJumlah['jumlah']);
        $jumlahHalaman = ceil($jumlahData / $limit);

        echo "<nav aria-label='Page navigation'>
                <ul class='pagination justify-content-center'>";
        if ($halaman > 1) {
            echo "<li class='page-item'><a class='page-link' href='lihat-ba.php?halaman=" . ($halaman - 1) . "&cari=$cari'>Previous</a></li>";
        }

        for ($i = 1; $i <= $jumlahHalaman; $i++) {
            if ($i == $halaman) {
                echo "<li class='page-item active'><a class='page-link' href='lihat-ba.php?halaman=$i&cari=$cari'>$i</a></li>";
            } else {
                echo "<li class='page-item'><a class='page-link' href='lihat-ba.php?halaman=$i&cari=$cari'>$i</a></li>";
            }
        }

        if ($halaman < $jumlahHalaman) {
            echo "<li class='page-item'><a class='page-link' href='lihat-ba.php?halaman=" . ($halaman + 1) . "&cari=$cari'>Next</a></li>";
        }

        echo "</ul></nav>";
        ?>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
