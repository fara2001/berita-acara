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

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Pencarian Data Number</title>
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
<?php
    // echo $rowSession['role'];
?>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="tampil2.php">Data Number</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <!-- <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="tampil2.php">Cek Data</a>
                    </li> -->
                    <!-- <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="data-ba/create-ba.php">Create BA</a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="data-ba/lihat-ba.php">Data BA</a>
                    </li>
                    <?php if ($cekRole == "admin") { ?>
                    
                    <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="user/index.php">Data User</a>
                        </li>
                        
                    <?php } ?>

                </ul>
                
                
                <!-- <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <span class="nav-link">Login As : <?php echo $_SESSION['username'] . "<br> Role :"; ?> (<?php echo $cekRole; ?>)</span>
                    </li> -->

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
                <a href="/user/ganti-password.php" class="btn btn-danger">Ganti Password</a>
            </div>
        </div>
    </div>
</div>
        </div>
    </nav>
    <div class="container">

        <!-- Membangun Parameter Dinamis -->

        <!-- Akhir Membangun Parameter Dinamis -->
        <?php
        $JumlahDataPerHalaman = 10;
        $queryJumlahData = "SELECT COUNT(*) AS jumlah FROM data_nomor WHERE is_delete=0";
        $result = $conn->query($queryJumlahData);

        // Langkah 3: Ambil hasil query
        if ($result) {
            $row = $result->fetch_assoc();
            $jumlahData = intval($row['jumlah']);
            echo "Jumlah data: " . $jumlahData;
        } else {
            echo "Error: " . $conn->error;
        }

        if (isset($_GET['halaman'])) {
            $HalamanAktif = $_GET['halaman'];
        } else {
            $HalamanAktif = 1;
        }
        $JumlahHalaman = ceil($jumlahData / $JumlahDataPerHalaman);
        $awalData = ($JumlahDataPerHalaman * $HalamanAktif) - $JumlahDataPerHalaman;
        ?>

        <center>
            <h1>Data Number</h1>
        </center>
        <form method="GET" action="tampil2.php" style="text-align: center;">
            <div class="input-group mb-3">
                <input name="kata_cari" value="<?php if (isset($_GET['kata_cari'])) {
                                                    echo $_GET['kata_cari'];
                                                } ?>" type="text" class="form-control" placeholder="Masukan Pencarian" aria-label="Masukkan Pencarian" aria-describedby="button-addon2">
                <button class="btn btn-primary" type="submit" id="button-addon2">Cari</button>
            </div>
        </form>

        <?php if ($cekRole == "admin" || $cekRole == "editor") { ?>
        <a href="tambah-data.php">
            <button class="btn btn-primary">
                + Tambah Data
            </button>
        </a>
        <a href="input-bulk.php">
            <button class="btn btn-primary">
                + Tambah Data (BULK INPUT)
            </button>
        </a>
        <?php } ?>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="bi bi-filter-circle-fill"></i>
            Sortir Data
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Sortir Data</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form method="GET" action="tampil2.php" style="text-align: center;">
                            <table class="table">
                                <tr>
                                    <td>Sortir ID</td>
                                    <td><button class="btn btn-primary" type="submit" name="sortir_id_naik" value="yes" <?php if (isset($_GET['sortir_id_naik'])) {
                                                                                                                            echo $_GET['sortir_id_naik'];
                                                                                                                        } ?>>Sortir ID Naik
                                        </button></td>
                                    <td><button class="btn btn-primary" type="submit" name="sortir_id_turun" value="yes" <?php if (isset($_GET['sortir_id_turun'])) {
                                                                                                                                echo $_GET['sortir_id_turun'];
                                                                                                                            } ?>>Sortir ID Turun
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Sortir Geo Number </td>
                                    <td><button class="btn btn-primary" type="submit" name="sortir_geo_naik" value="yes" <?php if (isset($_GET['sortir_geo_naik'])) {
                                                                                                                                echo $_GET['sortir_geo_naik'];
                                                                                                                            } ?>>Sortir Geo Number Naik
                                        </button></td>
                                    <td><button class="btn btn-primary" type="submit" name="sortir_geo_turun" value="yes" <?php if (isset($_GET['sortir_geo_turun'])) {
                                                                                                                                echo $_GET['sortir_geo_turun'];
                                                                                                                            } ?>>Sortir Geo Number Turun
                                        </button></td>
                                </tr>
                                <tr>
                                    <td>Sortir Toll Free Number </td>
                                    <td><button class="btn btn-primary" type="submit" name="sortir_toll_naik" value="yes" <?php if (isset($_GET['sortir_toll_naik'])) {
                                                                                                                                echo $_GET['sortir_toll_naik'];
                                                                                                                            } ?>>Sortir Toll Free Naik
                                        </button></td>
                                    <td><button class="btn btn-primary" type="submit" name="sortir_toll_turun" value="yes" <?php if (isset($_GET['sortir_toll_turun'])) {
                                                                                                                                echo $_GET['sortir_toll_turun'];
                                                                                                                            } ?>>Sortir Toll Free Turun
                                        </button></td>
                                </tr>
                                <tr>
                                    <td>Sortir Number Translasi </td>
                                    <td><button class="btn btn-primary" type="submit" name="sortir_translasi_naik" value="yes" <?php if (isset($_GET['sortir_translasi_naik'])) {
                                                                                                                                    echo $_GET['sortir_translasi_naik'];
                                                                                                                                } ?>>Sortir Number Translasi Naik
                                        </button></td>
                                    <td><button class="btn btn-primary" type="submit" name="sortir_translasi_turun" value="yes" <?php if (isset($_GET['sortir_translasi_turun'])) {
                                                                                                                                    echo $_GET['sortir_translasi_turun'];
                                                                                                                                } ?>>Sortir Number Translasi Turun
                                        </button></td>
                                </tr>
                                <tr>
                                    <td>Sortir Customer </td>
                                    <td><button class="btn btn-primary" type="submit" name="sortir_customer_naik" value="yes" <?php if (isset($_GET['sortir_customer_naik'])) {
                                                                                                                                    echo $_GET['sortir_customer_naik'];
                                                                                                                                } ?>>Sortir Customer Naik
                                        </button></td>
                                    <td><button class="btn btn-primary" type="submit" name="sortir_customer_turun" value="yes" <?php if (isset($_GET['sortir_customer_turun'])) {
                                                                                                                                    echo $_GET['sortir_customer_turun'];
                                                                                                                                } ?>>Sortir Customer Turun
                                        </button></td>
                                </tr>
                                <tr>
                                    <td>Sortir Server </td>
                                    <td><button class="btn btn-primary" type="submit" name="sortir_server_naik" value="yes" <?php if (isset($_GET['sortir_server_naik'])) {
                                                                                                                                echo $_GET['sortir_server_naik'];
                                                                                                                            } ?>>Sortir Server Naik
                                        </button></td>
                                    <td><button class="btn btn-primary" type="submit" name="sortir_server_turun" value="yes" <?php if (isset($_GET['sortir_server_turun'])) {
                                                                                                                                    echo $_GET['sortir_server_turun'];
                                                                                                                                } ?>>Sortir Server Turun
                                        </button></td>
                                </tr>
                                <tr>
                                    <td>Sortir Tanggal Aktif </td>
                                    <td><button class="btn btn-primary" type="submit" name="sortir_tanggal_aktif_naik" value="yes" <?php if (isset($_GET['sortir_tanggal_aktif_naik'])) {
                                                                                                                                        echo $_GET['sortir_tanggal_aktif_naik'];
                                                                                                                                    } ?>>Sortir Tanggal Aktif Naik
                                        </button></td>
                                    <td><button class="btn btn-primary" type="submit" name="sortir_tanggal_aktif_turun" value="yes" <?php if (isset($_GET['sortir_tanggal_aktif_turun'])) {
                                                                                                                                        echo $_GET['sortir_tanggal_aktif_turun'];
                                                                                                                                    } ?>>Sortir Tanggal Turun
                                        </button></td>
                                </tr>
                                <tr>
                                    <td>Sortir Tanggal Aktif </td>
                                    <td><button class="btn btn-primary" type="submit" name="sortir_status_naik" value="yes" <?php if (isset($_GET['sortir_tanggal_aktif_naik'])) {
                                                                                                                                echo $_GET['sortir_tanggal_aktif_naik'];
                                                                                                                            } ?>>Sortir Status Naik
                                        </button></td>
                                    <td><button class="btn btn-primary" type="submit" name="sortir_status_turun" value="yes" <?php if (isset($_GET['sortir_status_turun'])) {
                                                                                                                                    echo $_GET['sortir_status_turun'];
                                                                                                                                } ?>>Sortir Status Turun
                                        </button></td>
                                </tr>
                            </table>
                            <br>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>        </div>

        <form action="hapus-data.php" method="post">
        <div style="float:right;">
            <button type="submit" name="hapus" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data?');">Hapus Terpilih</button>
        
        </div>
            <div style="float:right;margin-right:10px;">
            <button type="button" class="btn btn-success" onclick="pilihSemua()">Pilih Semua</button>
            <button type="button" class="btn btn-secondary" onclick="batalPilihSemua()">Batal Pilih Semua</button>
            <script>
                function pilihSemua() {
                    var checkBoxes = document.getElementsByTagName('input');
                    for (var i = 0; i < checkBoxes.length; i++) {
                        if (checkBoxes[i].type == 'checkbox') {
                            checkBoxes[i].checked = true;
                        }
                    }
                }

                function batalPilihSemua() {
                    var checkBoxes = document.getElementsByTagName('input');
                    for (var i = 0; i < checkBoxes.length; i++) {
                        if (checkBoxes[i].type == 'checkbox') {
                            checkBoxes[i].checked = false;
                        }
                    }
                }
            </script>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Pilih</th>
                        <th>No.</th> <!-- Kolom nomor urut -->
                        <th>ID</th>
                        <th>Geo Number</th>
                        <th>Toll Free Number</th>
                        <th>Number Translasi</th>
                        <th>Customer</th>
                        <th>Server</th>
                        <th>Tanggal Aktif</th>
                        <th>Status</th>
                        <?php if ($cekRole == "admin" || $cekRole == "editor") { ?>
                        <th>Aksi</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Mengatur nomor urut mulai dari 1
                    $no = $awalData + 1;

                    if (isset($_GET['kata_cari'])) {
                        $kata_cari = $_GET['kata_cari'];
                        $query = "SELECT * FROM data_nomor WHERE is_delete=0 AND geo_number like '%" . $kata_cari . "%' OR toll_free_number like '%" . $kata_cari . "%' OR number_translasi like '%" . $kata_cari . "%' OR customer like '%" . $kata_cari . "%' OR tanggal_aktif like '%" . $kata_cari . "%' OR status like '%" . $kata_cari . "%' OR server like '%" . $kata_cari . "%' ORDER BY id desc";
                    } else if (isset($_GET['sortir_id_naik'])) {
                        $query = "SELECT * FROM data_nomor WHERE is_delete=0 ORDER BY id ASC";
                    } else if (isset($_GET['sortir_geo_naik'])) {
                        $query = "SELECT * FROM data_nomor WHERE is_delete=0 ORDER BY geo_number ASC";
                    } else if (isset($_GET['sortir_id_turun'])) {
                        $query = "SELECT * FROM data_nomor WHERE is_delete=0 ORDER BY id DESC";
                    } else if (isset($_GET['sortir_geo_turun'])) {
                        $query = "SELECT * FROM data_nomor WHERE is_delete=0 ORDER BY geo_number DESC";
                    } else if (isset($_GET['sortir_toll_naik'])) {
                        $query = "SELECT * FROM data_nomor WHERE is_delete=0 ORDER BY toll_free_number ASC";
                    } else if (isset($_GET['sortir_toll_turun'])) {
                        $query = "SELECT * FROM data_nomor WHERE is_delete=0 ORDER BY toll_free_number DESC";
                    } else if (isset($_GET['sortir_translasi_naik'])) {
                        $query = "SELECT * FROM data_nomor WHERE is_delete=0 ORDER BY number_translasi ASC";
                    } else if (isset($_GET['sortir_translasi_turun'])) {
                        $query = "SELECT * FROM data_nomor WHERE is_delete=0 ORDER BY number_translasi DESC";
                    } else if (isset($_GET['sortir_customer_naik'])) {
                        $query = "SELECT * FROM data_nomor WHERE is_delete=0 ORDER BY customer ASC";
                    } else if (isset($_GET['sortir_customer_turun'])) {
                        $query = "SELECT * FROM data_nomor WHERE is_delete=0 ORDER BY customer DESC";
                    } else if (isset($_GET['sortir_server_naik'])) {
                        $query = "SELECT * FROM data_nomor WHERE is_delete=0 ORDER BY server ASC";
                    } else if (isset($_GET['sortir_server_turun'])) {
                        $query = "SELECT * FROM data_nomor WHERE is_delete=0 ORDER BY server DESC";
                    } else if (isset($_GET['sortir_status_naik'])) {
                        $query = "SELECT * FROM data_nomor WHERE is_delete=0 ORDER BY status ASC";
                    } else if (isset($_GET['sortir_status_turun'])) {
                        $query = "SELECT * FROM data_nomor WHERE is_delete=0 ORDER BY status DESC";
                    } else {
                        $query = "SELECT * FROM data_nomor WHERE is_delete=0 ORDER BY id DESC LIMIT $awalData, $JumlahDataPerHalaman";
                    }

                    // Jalankan query
                    $result = $conn->query($query);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td align='center'><input type='checkbox' name='id[]' value='" . $row['id'] . "'></td>";
                            echo "<td>" . $no++ . "</td>"; // Menampilkan nomor urut
                            echo "<td>" . $row["id"] . "</td>";
                            echo "<td>" . $row["geo_number"] . "</td>";
                            echo "<td>" . $row["toll_free_number"] . "</td>";
                            echo "<td>" . $row["number_translasi"] . "</td>";
                            echo "<td>" . $row["customer"] . "</td>";
                            echo "<td>" . $row["server"] . "</td>";
                            if ($row["status"] == "Aktif") {
                                echo "<td>" . date("d-m-Y", strtotime($row["tanggal_aktif"])) . "</td>";
                            } else {
                                echo "<td> Nomor Available </td>";
                            }
                            // echo "<td>" . $row["tanggal_aktif"] . "</td>";
                            
                            echo "<td>" . $row["status"] . "</td>";
                            if ($cekRole == "admin" || $cekRole == "editor") {
                                echo "<td style='white-space: nowrap'><a href='edit-data.php?id=" . $row["id"] . "' class='btn btn-warning'>Edit</a></td>";
                            }
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='10'>Tidak ada data</td></tr>";
                    }
                    ?>
                </tbody>
            </table>            
        </form>

        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <?php
                for ($i = 1; $i <= $JumlahHalaman; $i++) {
                    if ($i == $HalamanAktif) {
                ?>
                        <li class="page-item active">
                            <a class="page-link" href="?halaman=<?php echo ($i); ?>">
                                <?php echo ($i); ?></a>
                            </a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li class="page-item">
                            <a class="page-link" href="?halaman=<?php echo ($i); ?>">
                                <?php echo ($i); ?></a>
                            </a>
                        </li>
                <?php
                    }
                }
                ?>
            </ul>
        </nav>



    </div>
</body>

</html>