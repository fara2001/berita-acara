<?php
include("../koneksi.php");
if (isset($_POST['submit'])) {
    // Ambil data dari formulir
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
            // Nama file untuk hasil konversi PNG
            $filename = ($i + 1) . '.png';
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

            // Batasi ukuran file (20MB)
            if ($_FILES["lampiran_gambar"]["size"][$i] > 20000000) {
                $uploadOk = 0;
            }

            // Izinkan hanya format tertentu
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                $uploadOk = 0;
            }

            // Upload file jika valid
            if ($uploadOk == 1) {
                // Cek jenis gambar dan buat image resource sesuai dengan tipe filenya
                switch ($imageFileType) {
                    case 'jpg':
                    case 'jpeg':
                        $image = imagecreatefromjpeg($_FILES["lampiran_gambar"]["tmp_name"][$i]);
                        break;
                    case 'gif':
                        $image = imagecreatefromgif($_FILES["lampiran_gambar"]["tmp_name"][$i]);
                        break;
                    case 'png':
                        $image = imagecreatefrompng($_FILES["lampiran_gambar"]["tmp_name"][$i]);
                        break;
                    default:
                        $image = false;
                }

                if ($image !== false) {
                    // Konversi gambar menjadi PNG dan simpan
                    if (imagepng($image, $target_file)) {
                        $uploaded_files[] = $target_file; // Simpan nama file yang berhasil dikonversi
                    } else {
                        echo "Sorry, there was an error converting your file to PNG.";
                    }
                    imagedestroy($image); // Hapus dari memori setelah proses
                } else {
                    echo "Sorry, there was an error processing your file.";
                }
            }
        }
    }

    // Gabungkan semua file yang diupload menjadi satu string yang dipisahkan oleh koma
    $lampiran_gambar = $target_dir;

    // Simpan ke database
    $query = "INSERT INTO ba (ba, perusahaan, nomor_surat, tanggal, customer_name, address, installation_address, person_in_charge, contact_person, working_order, customer_id, circuit_id, jenis_layanan, note, third_party, nama_jabatan, jabatan, site_engineer, site_engineer_jabatan, lampiran_gambar, lampiran_text, marketing, marketing_jabatan) 
    VALUES ('$ba','$perusahaan','$nomor_surat', '$tanggal', '$customer_name', '$address', '$installation_address', '$person_in_charge', '$contact_person', '$working_order', '$customer_id', '$circuit_id', '$jenis_layanan', '$note', '$third_party', '$nama_jabatan', '$jabatan', '$site_engineer', '$site_engineer_jabatan','$lampiran_gambar' , '$lampiran_text', '$marketing', '$marketing_jabatan')";

    // Eksekusi query
    if ($conn->query($query) === TRUE) {
        echo "<script>alert('Data Berhasil Ditambahkan'); window.location.href = 'lihat-ba.php';</script>";
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }

    // Tutup koneksi
    $conn->close();
}
?>
