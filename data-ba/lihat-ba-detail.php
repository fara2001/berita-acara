<?php
session_start();
include '../koneksi.php';

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

    <!-- Favicons -->

    <style type="text/css">
        * {
            font-family: "Trebuchet MS";
        }

        h1 {
            text-transform: uppercase;
            /* color: blue; */
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
            <a class="navbar-brand" href="../tampil2.php">Data BA</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../tampil2.php">Cek Data Number</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="create-ba.php">Create BA</a>
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
        <?php
        $id = $_GET['id'];
        $sql = "SELECT * FROM ba WHERE id = '$id'";
        $query = mysqli_query($conn, $sql);
        $data = mysqli_fetch_array($query);

        ?>

<?php
$perusahaan = $data['perusahaan'];
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
        else {
        
        }
        
    ?>

        <h1 align="center">Lihat Data BA</h1>
<form action="cetak-ba.php" method="post" enctype="multipart/form-data">
    <fieldset disabled>
        <input type="hidden" name="perusahaan" value="<?php echo $data['perusahaan']; ?>">
        <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
        
        <div class="form-check">
            <input class="form-check-input" type="radio" name="ba" id="pasang-baru" value="Pasang Baru" 
                <?php if($data['ba'] == 'Pasang Baru'){ echo "checked"; } ?>>
            <label class="form-check-label" for="pasang-baru"> New Installation </label>
        </div>
        
        <div class="form-check">
            <input class="form-check-input" type="radio" name="ba" id="deaktivasi" value="De-Aktivasi" 
                <?php if($data['ba'] == 'De-Aktivasi'){ echo "checked"; } ?>>
            <label class="form-check-label" for="deaktivasi"> De-activation </label>
        </div>
    </fieldset>
</form>
                    <div class="form-group">
                        <label for="perusahaan">Perusahaan:</label>
                        <select class="form-control" name="perusahaan" id="perusahaan" disabled>
                            <option value="PT DIGITAL SATELLITE INDONESIA" <?php if($data['perusahaan'] == 'PT DIGITAL SATELLITE INDONESIA'){ echo "selected"; } ?>>PT DIGITAL SATELLITE INDONESIA</option>
                            <option value="PT DIGITAL WIRELESS INDONESIA" <?php if($data['perusahaan'] == 'PT DIGITAL WIRELESS INDONESIA'){ echo "selected"; } ?>>PT DIGITAL WIRELESS INDONESIA</option>
                            <option value="PT DIGITAL KOMUNIKASI LINTAS SARANA" <?php if($data['perusahaan'] == 'PT DIGITAL KOMUNIKASI LINTAS SARANA'){ echo "selected"; } ?>>PT DIGITAL KOMUNIKASI LINTAS SARANA</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nomor_surat">Nomor Surat:</label>
                        <input readonly type="text" class="form-control" id="nomor_surat" name="nomor_surat" value="<?php echo $data['nomor_surat']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="tanggal">Tanggal:</label>
                        <input readonly type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo $data['tanggal']; ?>">
                    </div>
                    <h4><b><i><u>1. Data Pelanggan :</u></i></b></h4>
                    <div class="form-group">
                        <label for="customer_name">Customer Name:</label>
                        <input readonly type="text" class="form-control" id="customer_name" name="customer_name" value="<?php echo $data['customer_name']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="address">Address & City:</label>
                        <input readonly type="text" class="form-control" id="address" name="address" value="<?php echo $data['address']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="installation_address">Installation Address & City:</label>
                        <input readonly type="text" class="form-control" id="installation_address" name="installation_address" value="<?php echo $data['installation_address']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="person_in_charge">Person in Charge:</label>
                        <input readonly type="text" class="form-control" id="person_in_charge" name="person_in_charge" value="<?php echo $data['person_in_charge']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="contact_person">Contact Person name / Jabatan / Phone / Email:</label>
                        <input readonly type="text" class="form-control" id="contact_person" name="contact_person" value="<?php echo $data['contact_person']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="working_order">Working Order No. :</label>
                        <input readonly type="text" class="form-control" id="working_order" name="working_order" value="<?php echo $data['working_order']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="customer_id">Customer ID:</label>
                        <input readonly type="text" class="form-control" id="customer_id" name="customer_id" value="<?php echo $data['customer_id']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="circuit_id">Circuit ID:</label>
                        <input readonly type="text" class="form-control" id="circuit_id" name="circuit_id" value="<?php echo $data['circuit_id']; ?>">
                    </div>
                    <h4><b><i><u>2. Jenis Layanan / kapasitas :</u></i></b></h4>
                    <div class="form-group">
                        <label for="jenis_layanan">Jenis Layanan / Kapasitas:</label>
                        <input readonly type="text" class="form-control" id="jenis_layanan" name="jenis_layanan" value="<?php echo $data['jenis_layanan']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="note">Spesifikasi Layanan:</label>
                        <textarea readonly class="form-control" id="note" name="note" rows="3"><?php echo $data['note']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="third_party">3rd Party:</label>
                        <input readonly type="text" class="form-control" id="third_party" name="third_party" value="<?php echo $data['third_party']; ?>">
                    </div>
                    <h4><b><i><u>3. Data Contact :</u></i></b></h4>
                    <div class="form-group">
                        <label for="nama_jabatan">Nama Jabatan:</label>
                        <input readonly type="text" class="form-control" id="nama_jabatan" name="nama_jabatan" value="<?php echo $data['nama_jabatan']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="jabatan">Jabatan:</label>
                        <select name="jabatan" id="jabatan" class="form-select" required disabled>
                        <option value="Manager Operation" <?php if ($data['jabatan'] == "Manager Operation") { echo "selected"; } ?>disabled>Manager Operation</option>
                    </select>
                    </div>
                    <div class="form-group">
                        <label for="site_engineer">Site Engineer:</label>
                        <input readonly type="text" class="form-control" id="site_engineer" name="site_engineer" value="<?php echo $data['site_engineer']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="site_engineer_jabatan">Jabatan:</label>
                    <select name="site_engineer_jabatan" id="site_engineer_jabatan" class="form-select" required disabled>
                        <option value="Network Operation Center" <?php if ($data['site_engineer_jabatan'] == "Network Operation Center") { echo "selected"; } ?>>Network Operation Center</option>
                        <option value="Project Manager" <?php if ($data['site_engineer_jabatan'] == "Project Manager") { echo "selected"; } ?>>Project Manager</option>
                        <option value="Technical Support" <?php if ($data['site_engineer_jabatan'] == "Technical Support") { echo "selected"; } ?>>Technical Support</option>
                    </select>
                    </div>
                    <div class="form-group">
                        <label for="marketing">Marketing:</label>
                        <input readonly type="text" class="form-control" id="marketing" name="marketing" value="<?php echo $data['marketing']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="marketing_jabatan">Marketing Jabatan:</label>
                        <input readonly type="text" class="form-control" id="marketing_jabatan" name="marketing_jabatan" value="<?php echo $data['marketing_jabatan']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="lampiran_gambar">Lampiran Gambar: <br>*Maksimal 5 Gambar</label>
                        <input type="hidden" class="form-control" id="lampiran_gambar" value="<?php echo $data['lampiran_gambar']; ?>">
                        
                        <!-- <img width="30%" src="<?= $data['lampiran_gambar']; ?>" alt=""> -->
                        <?php
        ?>
        <br>
        Sebelum :
<br>
        <?php
        $i = 1;
        foreach (array('png', 'jpg', 'jpeg', 'gif') as $ext) {
            for ($i = 1; $i <= 5; $i++) {
                $lampiran_gambar = $data['lampiran_gambar'];
                $file = "$lampiran_gambar"."$i.$ext";
                if (file_exists($file)) {
                    ?>
                    <img style="margin-top: 30px;" width="20%" src="<?= $file ?>" alt="" srcset="">
                    
                    <?php
                }
            }
        }
        ?>
                        
                        <input type="hidden" name="lampiran_gambar" class="form-control" id="" value="<?php echo $data['lampiran_gambar']; ?>">
                        <div id="preview" style="margin-top: 10px;"></div>
                        Sesudah :
                        <br>
                        <script>
                            function previewImages() {
                                var preview = document.querySelector('#preview');
                                preview.innerHTML = '';
                                var files = document.querySelector('input[type=file]').files;

                                for (var i = 0; i < files.length; i++) {
                                    var file = files[i];
                                    var reader = new FileReader();
                                    reader.onload = function(event) {
                                        var img = document.createElement("img");
                                        img.src = event.target.result;
                                        img.width = 100;
                                        preview.appendChild(img);
                                    }
                                    reader.readAsDataURL(file);
                                }
                            }
                        </script>
                    </div>
                    <div class="form-group">
                        <label for="lampiran_text">Lampiran Text:</label>
                        <input readonly type="text" class="form-control" id="lampiran_text" name="lampiran_text" value="<?php echo $data['lampiran_text']; ?>">
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Cetak BA</button>
                    <a href="download-pdf.php?id=<?php echo $data['id']; ?>" class="btn btn-danger">Download PDF</a>
                    <a href="lihat-ba.php" class="btn btn-secondary">Kembali</a>
                </form>

        <!-- <a href="lihat-ba.php" class="btn btn-primary">Kembali</a> -->
    </div>
