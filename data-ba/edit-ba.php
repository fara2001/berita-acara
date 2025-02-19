<?php
include '../koneksi.php';
$id = $_GET['id'];
$query = "SELECT * FROM ba WHERE id = '$id'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit BA</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="../data-ba/">Data BA</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../tampil2.php">Data Number</a>
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
        <div class="row">
            <div class="col">
                <h3 class="text-center">Edit BA</h3>
                <hr>
                <form action="proses-edit-ba.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="ba" id="pasang-baru" value="Pasang Baru" <?php if($data['ba'] == 'Pasang Baru'){ echo "checked"; } ?>>
                        <label class="form-check-label" for="pasang-baru"> New Installation </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="ba" id="deaktivasi" value="De-Aktivasi" <?php if($data['ba'] == 'De-Aktivasi'){ echo "checked"; } ?>>
                        <label class="form-check-label" for="deaktivasi"> De-activation </label>
                    </div>
                    <div class="form-group">
                        <label for="perusahaan">Perusahaan:</label>
                        <select class="form-control" name="perusahaan" id="perusahaan">
                            <option value="PT DIGITAL SATELLITE INDONESIA" <?php if($data['perusahaan'] == 'PT DIGITAL SATELLITE INDONESIA'){ echo "selected"; } ?>>PT DIGITAL SATELLITE INDONESIA</option>
                            <option value="PT DIGITAL WIRELESS INDONESIA" <?php if($data['perusahaan'] == 'PT DIGITAL WIRELESS INDONESIA'){ echo "selected"; } ?>>PT DIGITAL WIRELESS INDONESIA</option>
                            <option value="PT DIGITAL KOMUNIKASI LINTAS SARANA" <?php if($data['perusahaan'] == 'PT DIGITAL KOMUNIKASI LINTAS SARANA'){ echo "selected"; } ?>>PT DIGITAL KOMUNIKASI LINTAS SARANA</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nomor_surat">Nomor Surat:</label>
                        <input type="text" class="form-control" id="nomor_surat" name="nomor_surat" value="<?php echo $data['nomor_surat']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="tanggal">Tanggal:</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo $data['tanggal']; ?>">
                    </div>
                    <h4><b><i><u>1. Data Pelanggan :</u></i></b></h4>
                    <div class="form-group">
                        <label for="customer_name">Customer Name:</label>
                        <input type="text" class="form-control" id="customer_name" name="customer_name" value="<?php echo $data['customer_name']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="address">Address & City:</label>
                        <input type="text" class="form-control" id="address" name="address" value="<?php echo $data['address']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="installation_address">Installation Address & City:</label>
                        <input type="text" class="form-control" id="installation_address" name="installation_address" value="<?php echo $data['installation_address']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="person_in_charge">Person in Charge:</label>
                        <input type="text" class="form-control" id="person_in_charge" name="person_in_charge" value="<?php echo $data['person_in_charge']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="contact_person">Contact Person name / Jabatan / Phone / Email:</label>
                        <input type="text" class="form-control" id="contact_person" name="contact_person" value="<?php echo $data['contact_person']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="working_order">Working Order No. :</label>
                        <input type="text" class="form-control" id="working_order" name="working_order" value="<?php echo $data['working_order']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="customer_id">Customer ID:</label>
                        <input type="text" class="form-control" id="customer_id" name="customer_id" value="<?php echo $data['customer_id']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="circuit_id">Circuit ID:</label>
                        <input type="text" class="form-control" id="circuit_id" name="circuit_id" value="<?php echo $data['circuit_id']; ?>">
                    </div>
                    <h4><b><i><u>2. Jenis Layanan / kapasitas :</u></i></b></h4>
                    <div class="form-group">
                        <label for="jenis_layanan">Jenis Layanan / Kapasitas:</label>
                        <input type="text" class="form-control" id="jenis_layanan" name="jenis_layanan" value="<?php echo $data['jenis_layanan']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="note">Spesifikasi Layanan:</label>
                        <textarea class="form-control" id="note" name="note" rows="3"><?php echo $data['note']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="third_party">3rd Party:</label>
                        <input type="text" class="form-control" id="third_party" name="third_party" value="<?php echo $data['third_party']; ?>">
                    </div>
                    <h4><b><i><u>3. Data Contact :</u></i></b></h4>
                    <div class="form-group">
                        <label for="nama_jabatan">Nama Jabatan:</label>
                        <input type="text" class="form-control" id="nama_jabatan" name="nama_jabatan" value="<?php echo $data['nama_jabatan']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="jabatan">Jabatan:</label>
                        <select name="jabatan" id="jabatan" class="form-select" required>
                        <option value="Manager Operation" <?php if ($data['jabatan'] == "Manager Operation") { echo "selected"; } ?>>Manager Operation</option>
                    </select>
                    </div>
                    <div class="form-group">
                        <label for="site_engineer">Site Engineer:</label>
                        <input type="text" class="form-control" id="site_engineer" name="site_engineer" value="<?php echo $data['site_engineer']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="site_engineer_jabatan">Jabatan:</label>
                    <select name="site_engineer_jabatan" id="site_engineer_jabatan" class="form-select" required>
                        <option value="Network Operation Center" <?php if ($data['site_engineer_jabatan'] == "Network Operation Center") { echo "selected"; } ?>>Network Operation Center</option>
                        <option value="Project Manager" <?php if ($data['site_engineer_jabatan'] == "Project Manager") { echo "selected"; } ?>>Project Manager</option>
                        <option value="Technical Support" <?php if ($data['site_engineer_jabatan'] == "Technical Support") { echo "selected"; } ?>>Technical Support</option>
                    </select>
                    </div>
                    <div class="form-group">
                        <label for="marketing">Marketing:</label>
                        <input type="text" class="form-control" id="marketing" name="marketing" value="<?php echo $data['marketing']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="marketing_jabatan">Marketing Jabatan:</label>
                        <input type="text" class="form-control" id="marketing_jabatan" name="marketing_jabatan" value="<?php echo $data['marketing_jabatan']; ?>">
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
                        <input type="file" class="form-control" id="lampiran_gambar" name="lampiran_gambar[]" multiple onchange="previewImages()">
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
                        <input type="text" class="form-control" id="lampiran_text" name="lampiran_text" value="<?php echo $data['lampiran_text']; ?>">
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    <a href="lihat-ba.php" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
    <!-- <footer class="py-5 bg-dark">
      <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2022</p></div>
    </footer> -->
    
  </body>
</html>
