<?php
session_start();

include '../koneksi.php';

$cekUsername = isset($_SESSION['username']);
                        $querySession = "SELECT role FROM user WHERE username = '$cekUsername'";
                        $resultSession = $conn->query($querySession);
                        $rowSession = $resultSession->fetch_assoc();
                        if ($rowSession == NULL) {
                            $cekRole = "0";
                        }
                        else{
                        $cekRole = $rowSession['role'];
                        }


if (!isset($_SESSION['username']) && $cekRole != "admin") {
    echo "<script>alert('Anda tidak berhak akses ke halaman ini!');
     window.location.replace('../login.php');</script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Pencarian Data BA</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <style type="text/css">
        * {
            font-family: "Trebuchet MS";
        }

        h1 {
            text-transform: uppercase;
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
<?php
    // echo ($_SESSION['username'])
?>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="">Data User</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../tampil2.php">Data Number</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../data-ba/lihat-ba.php">Data BA</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../logout.php"><button type="button" class="btn btn-danger">Logout</button></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <h1 align="center">Lihat Data User</h1>

        <!-- Form Pencarian -->
        <form method="GET" action="lihat-ba.php" class="d-flex">
            <input class="form-control me-2" type="search" name="cari" placeholder="Cari Username atau Role" aria-label="Search" value="<?php echo isset($_GET['cari']) ? $_GET['cari'] : ''; ?>">
            <button class="btn btn-success" type="submit">Search</button>
            &nbsp;
            
            <button class="btn btn-secondary" type="button" onclick="location.href='lihat-ba.php'">Reset</button>
            
        </form>
        <br>

        <div class="d-grid gap-2 d-md-flex justify-content-md-start">
            <a href="tambah-user.php" class="btn btn-primary">Tambah Data</a>
        </div>
        <br>

        <?php
        // Pencarian
        $cari = isset($_GET['cari']) ? $_GET['cari'] : '';
        $halaman = isset($_GET['halaman']) ? $_GET['halaman'] : 1;
        $limit = 10;
        $offset = ($halaman - 1) * $limit;

        // Query dengan filter pencarian jika ada
        $query = "SELECT username, role FROM user 
                  WHERE username LIKE '%$cari%' OR role LIKE '%$cari%' 
                  ORDER BY username DESC 
                  LIMIT $limit OFFSET $offset";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            echo "<table class='table table-bordered table-hover mx-auto'>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>";
            $no = 1 + $offset;
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $no . "</td>
                        <td>" . $row['username'] . "</td>
                       
                        <td>" . $row['role'] . "</td>
                        <td style='width: 20%;'>
                            <a href='detail-user.php?username=" . $row['username'] . "' class='btn btn-success btn-sm' title='Lihat'><i class='fa fa-eye'>Detail</i></a>
                            <a href='edit-user.php?username=" . $row['username'] . "' class='btn btn-primary btn-sm' title='Edit'><i class='fa fa-edit'>Edit</i></a>
                            <a href='proses-hapus-user.php?username=" . $row['username'] . "' class='btn btn-danger btn-sm' title='Hapus' onclick='return confirmDelete();'><i class='fa fa-trash'>Hapus</i></a>
                        </td>
                    </tr>";
                $no++;
            }
            echo "</tbody>
                </table>";
        } else {
            echo "<p class='text-center'>Data tidak ditemukan</p>";
        }

        // Pagination
        $queryJumlah = "SELECT COUNT(*) AS jumlah FROM user WHERE username LIKE '%$cari%' OR role LIKE '%$cari%'";
        $resultJumlah = $conn->query($queryJumlah);
        $rowJumlah = $resultJumlah->fetch_assoc();
        $jumlahData = intval($rowJumlah['jumlah']);
        $jumlahHalaman = ceil($jumlahData / $limit);

        echo "<nav aria-label='Page navigation example'>
            <ul class='pagination justify-content-center'>";
        if ($halaman > 1) {
            echo "<li class='page-item'><a class='page-link' href='lihat-ba.php?halaman=" . ($halaman - 1) . "&cari=$cari'><i class='fa fa-chevron-left'></i> Previous</a></li>";
        }

        for($i = 1; $i <= $jumlahHalaman; $i++) {
            if ($i == $halaman) {
                echo "<li class='page-item active'><a class='page-link' href='lihat-ba.php?halaman=$i&cari=$cari'>$i</a></li>";
            } else {
                echo "<li class='page-item'><a class='page-link' href='lihat-ba.php?halaman=$i&cari=$cari'>$i</a></li>";
            }
        }

        if ($halaman < $jumlahHalaman) {
            echo "<li class='page-item'><a class='page-link' href='lihat-ba.php?halaman=" . ($halaman + 1) . "&cari=$cari'>Next <i class='fa fa-chevron-right'></i></a></li>";
        }
        echo "</ul>
            </nav>";

        ?>
    </div>
</body>
</html>
