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

    <title>Pembuatan BA</title>
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
            <a class="navbar-brand" href="../data-ba/">Data Number</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="tampil2.php">Cek Data</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="data-ba/create-ba.php">Create BA</a>
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
    <?php
        $ba = $_POST['ba'];
        $perusahaan = $_POST['perusahaan'];
    ?>
    <?php
        if ($perusahaan == "PT DIGITAL SATELLITE INDONESIA") {
            ?>
            <img width="20%" src="../img/logo-digisat.png" alt="" srcset="">
            <?php
        }
        else if ($perusahaan == "PT DIGITAL WIRELESS INDONESIA") {
            ?>
            <img width="20%" src="../img/logo-diginet.png" alt="" srcset="">
            <?php
        }
        else if ($perusahaan == "PT DIGITAL KOMUNIKASI LINTAS SARANA") {
            ?>
            <img width="20%" src="../img/logo_dkls.png" alt="" srcset="">
            <?php
        }
        else if ($perusahaan == "TELCO ALLIED SINGAPORE Pte. Ltd.") {
            ?>
            <img width="20%" src="../img/logo-telco.jpg" alt="" srcset="">
            <?php
        }
        else {
        
        }
        
    ?>
    
    <form action="proses-input-ba.php" method="post" enctype="multipart/form-data">
    <center>
        <input type="hidden" name="ba" id="" value="<?= $ba ?>">
        <input type="hidden" name="perusahaan" id="" value="<?= $perusahaan ?>">
        <br>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Nomor Surat</span>
            <input type="text" class="form-control" name="nomor_surat" id="" aria-describedby="basic-addon1" required>
        </div>
    </center>    
    
        <h2>Data Pelanggan</h2>
        <table>
            <tr>
                <td>
                    Tanggal
                </td>
                <td>
                    :
                </td>
                <td>
                    <input type="date" name="tanggal" id="" class="form-control" required>
                </td>
            </tr>
            <tr>
                <td>
                    Customer Name
                </td>
                <td>
                    :
                </td>
                <td>
                    <input type="text" name="customer_name" id="" class="form-control" required>
                </td>
            </tr>
            <tr>
                <td>
                    Address
                </td>
                <td>
                    :
                </td>
                <td>
                    <input type="text" name="address" id="" class="form-control" required>
                </td>
            </tr>
            <tr>
                <td>
                    Installation Address & City
                </td>
                <td>
                    :
                </td>
                <td>
                    <input type="text" name="installation_address" id="" class="form-control" required>
                </td>
            </tr>
            <tr>
                <td>
                    Person In Charge 
                </td>
                <td>
                    :
                </td>
                <td>
                    <input type="text" name="person_in_charge" id="" class="form-control" required>
                </td>
            </tr>
            <tr>
                <td>
                Contact Person name
                <br>
                /Jabatan/Phone/email
                </td>
                <td>
                    :
                </td>
                <td>
                    <input type="text" name="contact_person" id="" class="form-control" required>
                </td>
            </tr>
            <tr>
                <td>
                    Working Order No. 
                </td>
                <td>
                    :
                </td>
                <td>
                    <input type="text" name="working_order" id="" class="form-control" required>
                </td>
            </tr>
            <tr>
                <td>
                    Customer ID 
                </td>
                <td>
                    :
                </td>
                <td>
                    <input type="text" name="customer_id" id="" class="form-control" required>
                </td>
            </tr>
            <tr>
                <td>
                    Circuit ID 
                </td>
                <td>
                    :
                </td>
                <td>
                    <input type="text" name="circuit_id" id="" class="form-control" required>
                </td>
            </tr>
        </table>
        <h2>Detail Layanan</h2>
        <table>
            <tr>
                <td>
                    Jenis Layanan
                </td>
                <td>
                    :
                </td>
                <td>
                    <input type="text" name="jenis_layanan" id="" class="form-control" required>
                </td>
            </tr>
            <tr>
                <td>
                    Spesifikasi Layanan
                </td>
                <td>
                    :
                </td>
                <td>
                    <textarea name="note" id="" cols="70"></textarea>
                </td>
            </tr>
            <tr>
                <td>
                    3rd Party
                </td>
                <td>
                    :
                </td>
                <td>
                    <input type="text" name="third_party" id="" class="form-control">
                </td>
            </tr>
        </table>
     <h2><?php
     if ($perusahaan == "PT DIGITAL SATELLITE INDONESIA") {
        echo "DIGISAT";
    } else if($perusahaan == "PT DIGITAL WIRELESS INDONESIA") {
        echo "DIGINET";
    } else if($perusahaan == "PT DIGITAL KOMUNIKASI LINTAS SARANA") {
        echo "DKLS";
    }
    else if($perusahaan == "TELCO ALLIED SINGAPORE Pte. Ltd.") {
        echo "TELCO ALLIED";
    }
    ?> PIC (sebagai yang mewakili <?php
    if ($perusahaan == "PT DIGITAL SATELLITE INDONESIA") {
        echo "PT DIGITAL SATELLITE INDONESIA";
    } else if($perusahaan == "PT DIGITAL WIRELESS INDONESIA") {
        echo "PT DIGITAL WIRELESS INDONESIA";
    } else if($perusahaan == "PT DIGITAL KOMUNIKASI LINTAS SARANA") {
        echo "PT DIGITAL KOMUNIKASI LINTAS SARANA";
    }
    else if($perusahaan == "TELCO ALLIED SINGAPORE Pte. Ltd.") {
        echo "TELCO ALLIED SINGAPORE Pte. Ltd.";
    }
    ?>)</h2>
    <table>
    <tr>
                <td>
                    Nama Site Engineer/PM/TS
                </td>
                <td>
                    :
                </td>
                <td>
                    <input type="text" name="site_engineer" id="" class="form-control" required>
                </td>
            </tr>
            <tr>
                <td>
                    Jabatan
                </td>
                <td>
                    :
                </td>
                <td>
                    <select name="site_engineer_jabatan" id="site_engineer_jabatan" class="form-select" required>
                        <option value="Network Operation Center">Network Operation Center</option>
                        <option value="Project Manager">Project Manager</option>
                        <option value="Technical Support">Technical Support</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    Nama Penanggung jawab <?php
                    // if ($perusahaan == "PT DIGITAL SATELLITE INDONESIA") {
                    //     echo "DIGISAT";
                    // } else if($perusahaan == "PT DIGITAL WIRELESS INDONESIA") {
                    //     echo "DIGINET";
                    // } else if($perusahaan == "PT DIGITAL KOMUNIKASI LINTAS SARANA") {
                    //     echo "DKLS";
                    // }
                    // else if($perusahaan == "TELCO ALLIED SINGAPORE Pte. Ltd.") {
                    //     echo "TELCO ALLIED";
                    // }
                    ?>
                </td>
                <td>
                    :
                </td>
                <td>
                    <input type="text" name="nama_jabatan" id="" class="form-control" required>
                </td>
            </tr>
            <tr>
                <td>
                    Jabatan
                </td>
                <td>
                    :
                </td>
                <td>
                    <select name="jabatan" id="jabatan" class="form-select" required>
                        <option value="Manager Operation">Manager Operation</option>
                    </select>
                    
                </td>
            </tr>
            
            <tr>
                <td>
                    PIC Sales & Marketing
                </td>
                <td>
                    :
                </td>
                <td>
                    <input type="text" name="marketing" id="" class="form-control" required>
                </td>
            </tr>
            <tr>
                <td>
                    Jabatan PIC Sales & Marketing
                </td>
                <td>
                    :
                </td>
                <td>
                    <select name="marketing_jabatan" id="marketing_jabatan" class="form-select" required>
                        <option value="Sales & Marketing Departement">Sales & Marketing Departement</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    Lampiran Foto (Maksimal 5 foto)
                </td>
                <td>
                    :
                </td>
                <td>
                    <input type="file" accept="image/*" name="lampiran_gambar[]" id="lampiran_foto" class="form-control" multiple>
                </td>
            </tr>
            <tr>
                <td>
                    Lampiran Text
                </td>
                <td>
                    :
                </td>
                <td>
                    <input type="text" name="lampiran_text" id="lampiran_text" class="form-control">
                </td>
            </tr>
    </table>
    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    <a href="javascript:window.history.back()" class="btn btn-secondary">Kembali</a>
    </form>
    </div>
</body>
</html>