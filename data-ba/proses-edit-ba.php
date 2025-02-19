<?php
include("../koneksi.php");

if (isset($_POST['submit'])) {
    // Ambil data dari formulir
    $id = $_POST['id'];
    $ba = $_POST['ba'];
    $perusahaan = $_POST['perusahaan'];
    $nomor_surat = $_POST['nomor_surat'];
    $tanggal = $_POST['tanggal'];
    $customer_name = $_POST['customer_name'];
    $address = $_POST['address'];
    $installation_address = $_POST['installation_address'];
    $person_in_charge = $_POST['person_in_charge'];
    $contact_person = $_POST['contact_person'];
    $working_order = $_POST['working_order'];
    $customer_id = $_POST['customer_id'];
    $circuit_id = $_POST['circuit_id'];
    $jenis_layanan = $_POST['jenis_layanan'];
    $note = $_POST['note'];
    $third_party = $_POST['third_party'];
    $nama_jabatan = $_POST['nama_jabatan'];
    $jabatan = $_POST['jabatan'];
    $site_engineer_jabatan = $_POST['site_engineer_jabatan'];
    $site_engineer = $_POST['site_engineer'];
    $marketing = $_POST['marketing'];
    $marketing_jabatan = $_POST['marketing_jabatan'];
    $lampiran_text = $_POST['lampiran_text'];
    $uploaded_files = [];

    // Periksa jika ada file yang diupload
    if (!empty($_FILES['lampiran_gambar']['name'][0])) {
        // Buat folder baru dengan format timestamp
        $date = new DateTime();
        $folder_name = $date->format('Y-m-d-H-i-s-u');
        $target_dir = "uploads/" . $folder_name . "/";

        // Buat folder jika belum ada
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $file_count = count($_FILES['lampiran_gambar']['name']);

        for ($i = 0; $i < $file_count; $i++) {
            // Nama file berdasarkan nomor urut
            $filename = ($i + 1) . '.png'; // Selalu gunakan format PNG
            $target_file = $target_dir . $filename;

            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($_FILES['lampiran_gambar']['name'][$i], PATHINFO_EXTENSION));

            // Validasi file
            $check = getimagesize($_FILES["lampiran_gambar"]["tmp_name"][$i]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                $uploadOk = 0;
            }

            // Cek jika file sudah ada (seharusnya tidak terjadi karena menggunakan nama urut)
            if (file_exists($target_file)) {
                $uploadOk = 0;
            }

            // Batasi ukuran file (20MB)
            if ($_FILES["lampiran_gambar"]["size"][$i] > 20000000) {
                $uploadOk = 0;
            }

            // Izinkan hanya format gambar yang dapat dikonversi ke PNG
            if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "png") {
                $uploadOk = 0;
            }

            // Upload dan konversi gambar jika valid
            if ($uploadOk == 1) {
                $temp_file = $_FILES["lampiran_gambar"]["tmp_name"][$i];

                // Konversi gambar ke PNG
                switch ($imageFileType) {
                    case 'jpg':
                    case 'jpeg':
                        $image = imagecreatefromjpeg($temp_file);
                        break;
                    case 'gif':
                        $image = imagecreatefromgif($temp_file);
                        break;
                    case 'png':
                        $image = imagecreatefrompng($temp_file);
                        break;
                    default:
                        $image = null;
                }

                if ($image !== null) {
                    imagepng($image, $target_file); // Simpan sebagai PNG
                    imagedestroy($image);
                    $uploaded_files[] = $target_file; // Simpan nama file yang berhasil diupload
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        }
    }

    // Gabungkan semua file yang diupload menjadi satu string yang dipisahkan oleh koma
    $lampiran_gambar = $target_dir;

    // Simpan ke database
    $query = "UPDATE ba 
SET ba = '$ba', 
    perusahaan = '$perusahaan', 
    nomor_surat = '$nomor_surat', 
    tanggal = '$tanggal', 
    customer_name = '$customer_name', 
    address = '$address', 
    installation_address = '$installation_address', 
    person_in_charge = '$person_in_charge', 
    contact_person = '$contact_person', 
    working_order = '$working_order', 
    customer_id = '$customer_id', 
    circuit_id = '$circuit_id', 
    jenis_layanan = '$jenis_layanan', 
    note = '$note', 
    third_party = '$third_party', 
    nama_jabatan = '$nama_jabatan', 
    jabatan = '$jabatan', 
    site_engineer = '$site_engineer', 
    site_engineer_jabatan = '$site_engineer_jabatan', 
    lampiran_gambar = '$lampiran_gambar', 
    lampiran_text = '$lampiran_text', 
    marketing = '$marketing', 
    marketing_jabatan = '$marketing_jabatan' 
WHERE id = '$id'";

    // Eksekusi query
    if ($conn->query($query) === TRUE) {
        echo "<script>alert('Data Berhasil Di edit');</script>";
        echo "<script>window.location.href = 'lihat-ba.php';</script>";
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }

    // Tutup koneksi
    $conn->close();
}

?>
