<?php
require('../fpdf/fpdf.php');

// Koneksi ke database atau ambil data dari form
include("../koneksi.php");

$id = $_GET['id']; // Asumsikan id dikirim melalui URL
$query = "SELECT * FROM ba WHERE id = '$id'";
$result = $conn->query($query);
$data = $result->fetch_assoc();

     // Ambil data dari formulir
     $ba = $data['ba'];
     $perusahaan = $data['perusahaan'];
     $nomor_surat = $data['nomor_surat'];
     $tanggal = $data['tanggal'];
     $customer_name = $data['customer_name'];
     $address = $data['address'];
     $installation_address = $data['installation_address'];
     $person_in_charge = $data['person_in_charge'];
     $contact_person = $data['contact_person'];
     $working_order = $data['working_order'];
     $customer_id = $data['customer_id'];
     $circuit_id = $data['circuit_id'];
     $jenis_layanan = $data['jenis_layanan'];
     $note = $data['note'];
     $third_party = $data['third_party'];
     $nama_jabatan = $data['nama_jabatan'];
     $site_engineer = $data['site_engineer'];
     $jabatan = $data['jabatan'];
     $site_engineer_jabatan = $data['site_engineer_jabatan'];
     $lampiran_gambar = $data['lampiran_gambar'];
     $lampiran_text = $data['lampiran_text'];
     $marketing = $data['marketing'];
     $marketing_jabatan = $data['marketing_jabatan'];

     class PDF extends FPDF
{
    // Menambahkan metode untuk Footer
    function Footer()
    {
        // Posisi 15 mm dari bawah
        $this->SetY(-15);

        // Set font untuk footer
        $this->SetFont('times', 'B', 10);

        // Nama perusahaan dicetak tebal
        global $perusahaan;
        $this->Cell(0, 5, $perusahaan, 0, 1, 'C');

        // Alamat perusahaan
        $this->SetFont('times', '', 10);
        $this->Cell(0, 5, 'Cyber Building 7th Floor, Jl. Kuningan Barat No.8 Jakarta 12710 - INDONESIA', 0, 1, 'C');
        
        // Informasi kontak perusahaan
        $this->Cell(0, 5, 'Phone: +62.21.52211908, Fax: +62.21.5223368', 0, 1, 'C');

        // Tambahkan space 5 mm dibawah footer
        $this->Cell(0, 5, '', 0, 1, 'C');
    }

}

function terbilang($angka) {
    $angka = (float)$angka;
    $bilangan = [
        "", "satu", "dua", "tiga", "empat", "lima", "enam",
        "tujuh", "delapan", "sembilan", "sepuluh", "sebelas"
    ];

    if ($angka < 12) {
        return $bilangan[$angka];
    } elseif ($angka < 20) {
        return $bilangan[$angka - 10] . " belas";
    } elseif ($angka < 100) {
        return $bilangan[floor($angka / 10)] . " puluh" . ($angka % 10 > 0 ? " " . $bilangan[$angka % 10] : "");
    } elseif ($angka < 200) {
        return "seratus" . ($angka - 100 > 0 ? " " . terbilang($angka - 100) : "");
    } elseif ($angka < 1000) {
        return $bilangan[floor($angka / 100)] . " ratus" . ($angka % 100 > 0 ? " " . terbilang($angka % 100) : "");
    } elseif ($angka < 2000) {
        return "seribu" . ($angka - 1000 > 0 ? " " . terbilang($angka - 1000) : "");
    } elseif ($angka < 1000000) {
        return terbilang(floor($angka / 1000)) . " ribu" . ($angka % 1000 > 0 ? " " . terbilang($angka % 1000) : "");
    } elseif ($angka < 1000000000) {
        return terbilang(floor($angka / 1000000)) . " juta" . ($angka % 1000000 > 0 ? " " . terbilang($angka % 1000000) : "");
    }
}

function bulanIndo($bulan) {
    $namaBulan = [
        "01" => "januari", "02" => "februari", "03" => "maret",
        "04" => "april", "05" => "mei", "06" => "juni",
        "07" => "juli", "08" => "agustus", "09" => "september",
        "10" => "oktober", "11" => "november", "12" => "desember"
    ];

    return $namaBulan[$bulan];
}

function hariIndo($tanggal_akhir) {
    $namaHari = [
        'Sunday' => 'Minggu',
        'Monday' => 'Senin',
        'Tuesday' => 'Selasa',
        'Wednesday' => 'Rabu',
        'Thursday' => 'Kamis',
        'Friday' => 'Jumat',
        'Saturday' => 'Sabtu'
    ];

    $hariInggris = date('l', strtotime($tanggal_akhir)); // Mengambil hari dalam bahasa Inggris
    return $namaHari[$hariInggris]; // Mengubahnya menjadi bahasa Indonesia
}

function pisahTanggal($tanggal_akhir) {
    $parts = explode('-', $tanggal_akhir); // Format input sekarang YYYY-MM-DD
    $tahun = terbilang((int)$parts[0]);    // Tahun diambil dari bagian pertama
    $bulan = bulanIndo($parts[1]);         // Bulan diambil dari bagian kedua
    $hari = terbilang((int)$parts[2]);     // Hari diambil dari bagian ketiga
    $namaHari = hariIndo($tanggal_akhir);  // Mengambil nama hari

    return [
        'nama_hari' => $namaHari,
        'tanggal' => $hari,
        'bulan' => $bulan,
        'tahun' => $tahun
    ];
}


    // Buat dokumen PDF
    // $pdf = new FPDF('P', 'mm', 'A4');
    $pdf = new PDF('P', 'mm', 'A4');


    $pdf->SetMargins(25.54, 0, 25.54);


    $pdf->AddPage();

    // Judul
    $pdf->Ln(15); // Spasi setelah logo
    $pdf->SetFont('times', 'B', 12);
    if (in_array($ba, ["Pasang Baru", "Upgrade", "Downgrade"])) {
    $pdf->Cell(160, 10, 'ORDER COMPLETION', 0, 1, 'C');
    $pdf->Ln(5);
    $pdf->SetFont('times', 'B', 12);
    $pdf->Cell(160, 10, 'No. ' . $nomor_surat, 0, 1, 'C');
    } else if ($ba == "De-Aktivasi") {
    $pdf->Cell(160, 10, 'Berita Acara Terminasi', 0, 1, 'C');
    $pdf->Ln(5);
    $pdf->SetFont('times', 'B', 12);
    $pdf->Cell(160, 10, 'No. ' . $nomor_surat, 0, 1, 'C');
    }
    // $pdf->SetFont('times', 'B', 12);
    // $pdf->Cell(160, 5, 'No. ' . $nomor_surat, 0, 1, 'C');

    // Tambahkan gambar logo perusahaan
    $pdf->Ln(5); // Spasi setelah judul
    if ($perusahaan == "PT DIGITAL SATELLITE INDONESIA") {
        $pdf->Image('../img/logo-digisat-24.jpg', 10, 10, 40, 0, 'JPG'); // Logo Digisat
    } elseif ($perusahaan == "PT DIGITAL WIRELESS INDONESIA") {
        $pdf->Image('../img/logo-diginet.png', 10, 10, 50, 0, 'PNG'); // Logo Diginet
    } elseif ($perusahaan == "PT DIGITAL KOMUNIKASI LINTAS SARANA") {
        $pdf->Image('../img/logo_dkls.png', 10, 10, 50, 0, 'PNG'); // Logo DKLS
    } elseif ($perusahaan == "TELCO ALLIED SINGAPORE Pte. Ltd.") {
        $pdf->Image('../img/logo-telco.jpg', 10, 10, 50, 0, 'JPG'); // Logo Telco
    }

    // Kalimat deskripsi
    $pdf->Ln(1); // Spasi setelah logo
    $pdf->SetFont('times', '', 12);
    $pdf->MultiCell(0, 5, "Pada hari " . hariIndo($tanggal) . " tanggal " . terbilang((int)date('d', strtotime($tanggal))) . " bulan " . bulanIndo(date('m', strtotime($tanggal))) . " tahun " . terbilang((int)date('Y', strtotime($tanggal))) . " telah selesai dilaksanakan pekerjaan $ba $jenis_layanan, sesuai dengan parameter dan data-data sebagai berikut :");
    
    // Data Pelanggan
    $pdf->Ln(2);
    $pdf->SetFont('times', 'BIU', 12);
    $pdf->Cell(0, 10, '1. Data Pelanggan :', 0, 1);
    $pdf->SetFont('times', 'B', 12);
    $pdf->Cell(50, 7, 'Nama Pelanggan', 1, 0);
    $pdf->SetFont('times', '', 12);
    $pdf->Cell(109, 7, $customer_name, 1, 1);
    $pdf->SetFont('times', 'B', 12);
    $pdf->Cell(50, 7, 'Alamat', 1, 0);
    $pdf->SetFont('times', '', 12);
    $pdf->Cell(109, 7, $address, 1, 1);
    $pdf->SetFont('times', 'B', 12);
    $pdf->Cell(50, 7, 'Alamat Instalasi', 1, 0);
    $pdf->SetFont('times', '', 12);
    $pdf->Cell(109, 7, $installation_address, 1, 1);
    $pdf->SetFont('times', 'B', 12);
    $pdf->Cell(50, 7, 'Person in Charge', 1, 0);
    $pdf->SetFont('times', '', 12);
    $pdf->Cell(109, 7, $person_in_charge, 1, 1);
    $pdf->SetFont('times', 'B', 12);
    $pdf->Cell(50, 7, 'Contact Person', 1, 0);
    $pdf->SetFont('times', '', 12);
    $pdf->Cell(109, 7, $contact_person, 1, 1);
    $pdf->SetFont('times', 'B', 12);
    $pdf->Cell(50, 7, 'Working Order', 1, 0);
    $pdf->SetFont('times', '', 12);
    $pdf->Cell(109, 7, $working_order, 1, 1);
    $pdf->SetFont('times', 'B', 12);
    $pdf->Cell(50, 7, 'ID Pelanggan', 1, 0);
    $pdf->SetFont('times', '', 12);
    $pdf->Cell(109, 7, $customer_id, 1, 1);
    $pdf->SetFont('times', 'B', 12);
    $pdf->Cell(50, 7, 'ID Sirkuit', 1, 0);
    $pdf->SetFont('times', '', 12);
    $pdf->Cell(109, 7, $circuit_id, 1, 1);

    // Detail Layanan
    $pdf->Ln(2);
    $pdf->SetFont('times', 'BIU', 12);
    $pdf->Cell(0, 10, '2. Detail Layanan :', 0, 1);
    $pdf->SetFont('times', '', 12);
    $pdf->SetFont('times', 'B', 12);
    $pdf->Cell(50, 7, 'Jenis Layanan', 1, 0);
    $pdf->SetFont('times', '', 12);
    $pdf->Cell(109, 7, $jenis_layanan, 1, 1);
    $pdf->SetFont('times', 'B', 12);
    $pdf->Cell(50, 7, 'Note', 1, 0);
    $pdf->SetFont('times', '', 12);
    $pdf->Cell(109, 7, $note, 1, 1);
    $pdf->SetFont('times', 'B', 12);
    $pdf->Cell(50, 7, 'Third Party', 1, 0);
    $pdf->SetFont('times', '', 12);
    $pdf->Cell(109, 7, $third_party, 1, 1);

    // Kontak PIC
    $pdf->Ln(2);
    $pdf->SetFont('times', 'BIU', 12);
    $pdf->Cell(0, 10, '3. Data Kontak :', 0, 1);
    $pdf->SetFont('times', '', 12);
    $pdf->Cell(190, 7, "PIC (Sebagai yang mewakili $perusahaan) :", 0, 1);
    $pdf->SetFont('times', 'B', 12);
    $pdf->Cell(50, 7, 'Nama/Jabatan', 1, 0);
    $pdf->SetFont('times', '', 12);
    $pdf->Cell(109, 7, $nama_jabatan, 1, 1);
    $pdf->SetFont('times', 'B', 12);
    $pdf->Cell(50, 7, 'Site Engineer', 1, 0);
    $pdf->SetFont('times', '', 12);
    $pdf->Cell(109, 7, $site_engineer, 1, 1);

    //Kalimat Penutup
    $pdf->Ln(5);
    $pdf->MultiCell(0, 5, "Pekerjaan tersebut telah selesai 100% dan terhitung dari" . " tanggal " . terbilang((int)date('d', strtotime($tanggal))) . " bulan " . bulanIndo(date('m', strtotime($tanggal))) . " tahun " . terbilang((int)date('Y', strtotime($tanggal))) . " telah diserahkan dari Operation Departement ke Sales & Marketing Departement dengan hasil baik dan layak di operasikan. ", 0, 'J', 0, 1);
    $pdf->Ln(5);
    $pdf->MultiCell(0, 5, "Demikian Berita Acara ini dibuat berdasarkan keadaan yang sebenarnya dan dipertanggung jawabkan.", 0, 'J', 0, 1);

    $pdf->Ln(10);


// Lebar kolom
$column_width = 53; // Lebar setiap kolom (dibagi 3 kolom untuk A4)
$pdf->SetFont('times', '', 11.2);
// Header tabel tanda tangan (tanpa border bawah)
$pdf->Cell($column_width, 10, $site_engineer_jabatan, 'LTR', 0, 'C'); // Border kiri, atas, kanan (tanpa bawah)
$pdf->Cell($column_width, 10, $jabatan, 'LTR', 0, 'C');
$pdf->Cell($column_width, 10, $marketing_jabatan, 'LTR', 1, 'C');

// Tanda tangan (kosong)
$pdf->Cell($column_width, 10, '', 'LR', 0, 'C'); // Kosong untuk tanda tangan
$pdf->Cell($column_width, 10, '', 'LR', 0, 'C'); // Kosong untuk tanda tangan
$pdf->Cell($column_width, 10, '', 'LR', 1, 'C'); // Kosong untuk tanda tangan

// Nama di bawah tanda tangan (tanpa border atas)
$pdf->Cell($column_width, 10, $site_engineer, 'LRB', 0, 'C'); // Hanya border kiri dan kanan (tanpa atas dan bawah)
$pdf->Cell($column_width, 10, $nama_jabatan, 'LRB', 0, 'C');
$pdf->Cell($column_width, 10, $marketing, 'LRB', 1, 'C');

//Halaman 2
$pdf->AddPage();

    // Tampilkan gambar
    // if ($lampiran_gambar != '') {
    //     $pdf->Image($lampiran_gambar, ($pdf->GetPageWidth() - 100) / 2, 20, 100);
    //     $pdf->Ln(10);
    // }

    // Tampilkan lampiran text
    // if ($lampiran_text != '') {
    //     $pdf->SetFont('times', '', 11.2);
    //     $pdf->MultiCell(0, 5, $lampiran_text, 0, 'J', 0, 1);
    //     $pdf->Ln(10);
    // }


    // Tampilkan lampiran text dan gambar
    $pdf->SetFont('times', '', 11.2);
    $pdf->MultiCell(0, 5, $lampiran_text, 0, 'J', 0, 1);
    $pdf->Ln(10);

    $gap = 5; // Tinggi gap antar gambar
    $imageHeight = ($pdf->GetPageHeight() - ($gap * 5)) / 5; // Tinggi gambar
    $currentY = $pdf->GetY();
    foreach (array('png', 'jpg', 'jpeg', 'gif') as $ext) {
        for ($i = 1; $i <= 5; $i++) {
            $file = "$lampiran_gambar"."$i.$ext";
            if (file_exists($file)) {
                $pdf->Image($file, ($pdf->GetPageWidth() - 100) / 2, $currentY, 100, $imageHeight);
                $currentY += $imageHeight + $gap;
            }
        }
    }

    // Output PDF
    $pdf->Output('I', 'Order_Completion_' . $nomor_surat . '.pdf');


?>
