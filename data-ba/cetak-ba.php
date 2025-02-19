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
    $site_engineer = $_POST['site_engineer'];
    $jabatan = $_POST['jabatan'];
    $site_engineer_jabatan = $_POST['site_engineer_jabatan'];
    $lampiran_gambar = $_POST['lampiran_gambar'];
    $lampiran_text = $_POST['lampiran_text'];
    $marketing = $_POST['marketing'];
    $marketing_jabatan = $_POST['marketing_jabatan'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita Acara <?= $nomor_surat ?></title>

    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        table {
            width: 100%;
        }
        th {
            width: 30%;
            text-align: left;
        }
        td {
            width: 70%;
        }
        .tanda_tangan {
            border: 1px solid black;
            text-align: center;
            width: 100%;
        }
        .tanda_tangan td{
            width: 33%;
        }
        .tanda_tangan th{
            text-align: center;
            border-bottom: 1px solid white;
            padding-bottom: 70px;
        }
    </style>
<style type="text/css" media="print">
    @page 
    {
        size: auto;   /* auto is the initial value */
        margin: 0mm;  /* this affects the margin in the printer settings */
    }
    @media print {
     @page {
        margin-left: 0.5in;
        margin-right: 0.5in;
        margin-top: 0;
        margin-bottom: 0;
      }
}
</style>
</head>
<body>
    <style>
        .cetak{
            position: fixed;
            top: 10px;
            right: 10px;
            padding: 5px 10px;
            font-size: 12px;
        }
        @media print {
            @page {
                margin: 2.54cm;
            }
        }
        
        @page {
            margin: 2.54cm;
        }
    </style>

    
    <button type="button" class="btn btn-primary cetak" onclick="printDiv('container')">
        Cetak
    </button>
    <script>
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
        setTimeout(function () {
         printDiv('container');
     }, 1000);
    </script>
<div class="container" id="container">
<?php
        $ba = $_POST['ba'];
        $perusahaan = $_POST['perusahaan'];
    ?>
    <br>
    <?php
         if ($perusahaan == "PT DIGITAL SATELLITE INDONESIA") {
            ?>
            <img width="25%" src="../img/logo-digisat.png" alt="" srcset="">
            <?php
        }
        else if ($perusahaan == "PT DIGITAL WIRELESS INDONESIA") {
            ?>
            <img width="25%" src="../img/logo-diginet.png" alt="" srcset="">
            <?php
        }
        else if ($perusahaan == "PT DIGITAL KOMUNIKASI LINTAS SARANA") {
            ?>
            <img width="25%" src="../img/logo_dkls.png" alt="" srcset="">
            <?php
        }
        else if ($perusahaan == "TELCO ALLIED SINGAPORE Pte. Ltd.") {
            ?>
            <img width="25%" src="../img/logo-telco.jpg" alt="" srcset="">
            <?php
        }
        else {
        
        }
        
    ?>
    
    
        <?php if (in_array($ba, ["Pasang Baru", "Upgrade", "Downgrade"])) { ?>
        <h4 align="center">
            ORDER COMPLETION<br/>No. <?= $nomor_surat ?>
        </h4>
        <?php } else if ($ba == "De-Aktivasi") { ?>
        <h4 align="center">
            Berita Acara Terminasi<br/>No. <?= $nomor_surat ?>
        </h4>
        <?php } ?>

        <p align="justify">
    
<?php
function terbilang($angka) {
    $angka = (float)$angka;
    $bilangan = [
        "", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam",
        "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas"
    ];

    if ($angka < 12) {
        return $bilangan[$angka];
    } elseif ($angka < 20) {
        return $bilangan[$angka - 10] . " Belas";
    } elseif ($angka < 100) {
        return $bilangan[floor($angka / 10)] . " Puluh" . ($angka % 10 > 0 ? " " . $bilangan[$angka % 10] : "");
    } elseif ($angka < 200) {
        return "Seratus" . ($angka - 100 > 0 ? " " . terbilang($angka - 100) : "");
    } elseif ($angka < 1000) {
        return $bilangan[floor($angka / 100)] . " Ratus" . ($angka % 100 > 0 ? " " . terbilang($angka % 100) : "");
    } elseif ($angka < 2000) {
        return "Seribu" . ($angka - 1000 > 0 ? " " . terbilang($angka - 1000) : "");
    } elseif ($angka < 1000000) {
        return terbilang(floor($angka / 1000)) . " Ribu" . ($angka % 1000 > 0 ? " " . terbilang($angka % 1000) : "");
    } elseif ($angka < 1000000000) {
        return terbilang(floor($angka / 1000000)) . " Juta" . ($angka % 1000000 > 0 ? " " . terbilang($angka % 1000000) : "");
    }
}

function bulanIndo($bulan) {
    $namaBulan = [
        "01" => "Januari", "02" => "Februari", "03" => "Maret",
        "04" => "April", "05" => "Mei", "06" => "Juni",
        "07" => "Juli", "08" => "Agustus", "09" => "September",
        "10" => "Oktober", "11" => "November", "12" => "Desember"
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

// Contoh penggunaan
$tanggal_akhir = $tanggal; // Format input sekarang adalah YYYY-MM-DD
$hasil = pisahTanggal($tanggal_akhir);

// Memasukkan nilai-nilai tersebut dalam kalimat
$nama_hari = $hasil['nama_hari'];
$tanggal = $hasil['tanggal'];
$bulan = $hasil['bulan'];
$tahun = $hasil['tahun'];
echo "Pada hari <b>$nama_hari</b> tanggal <b>$tanggal</b> bulan <b>$bulan</b> tahun <b>$tahun</b> telah selesai dilaksanakan pekerjaan $ba $jenis_layanan, sesuai dengan parameter dan data-data sebagai berikut :";
?>
        </p>
        <h4><b><i><u>1. Data Pelanggan :</u></i></b></h4>
        <table class="table table-bordered">
            <tr>
                <th>&nbsp; Customer Name</th>
                <td>&nbsp; <?=$customer_name ?></td>
            </tr>
            <tr>
                <th>&nbsp; Address & City</th>
                <td>&nbsp; <?= $address ?></td>
            </tr>
            <tr>
                <th>&nbsp; Installation Address & City</th>
                <td>&nbsp; <?= $installation_address ?></td>
            </tr>
            <tr>
                <th>&nbsp; Person in Charge</th>
                <td>&nbsp; <?= $person_in_charge ?></td>
            </tr>
            <tr>
                <th>&nbsp; Contact Person name<br>&nbsp; /Jabatan/Phone/email</th>
                <td>&nbsp; <?= $contact_person ?></td>
            </tr>
            <tr>
                <th>&nbsp; Working Order No.</th>
                <td>&nbsp; <?= $working_order ?></td>
            </tr>
            <tr>
                <th>&nbsp; Customer ID</th>
                <td>&nbsp; <?= $customer_id ?></td>
            </tr>
            <tr>
                <th>&nbsp; Circuit ID</th>
                <td>&nbsp; <?= $circuit_id ?></td>
            </tr>
        </table>
        <h4><b><i><u>2. Detail Layanan :</u></i></b></h4>
        <table class="table table-bordered">
            <tr>
                <th>&nbsp; Jenis Layanan / Kapasitas</th>
                <td>&nbsp; <?= $jenis_layanan ?></td>
            </tr>
            <tr>
                <th>&nbsp; Spesifikasi Layanan</th>
                <td>&nbsp; <?= $note ?></td>
            </tr>
            <tr>
                <th>&nbsp; 3rd Party</th>
                <td>&nbsp; <?= $third_party ?></td>
            </tr>
        </table>
        <h4><b><i><u>3. Data Contact :</u></i></b></h4>
        <?php
        if ($perusahaan == "PT DIGITAL SATELLITE INDONESIA") {
            ?>
            <b>DIGISAT PIC (Sebagai yang mewakili DIGISAT) :</b>
            <?php
        }
        elseif ($perusahaan == "PT DIGITAL WIRELESS INDONESIA") {
            ?>
            <b>DIGINET PIC (Sebagai yang mewakili DIGINET) :</b>
            <?php
        }
        elseif ($perusahaan == "PT DIGITAL KOMUNIKASI LINTAS SARANA") {
            ?>
            <b>DKLS PIC (Sebagai yang mewakili DKLS) :</b>
            <?php
        }
        elseif($perusahaan == "TELCO ALLIED SINGAPORE Pte. Ltd.") {
            ?>
            <b>TELCO ALLIED PIC (Sebagai yang mewakili TELCO ALLIED) :</b>
            <?php
        }
        else {
        
        }
        ?>
        <table class="table table-bordered">
            <tr>
                <th>&nbsp; Nama/Jabatan</th>
                <td>&nbsp; <?= $nama_jabatan ?></td>
            </tr>
            <tr>
                <th>&nbsp; Site Engineer</th>
                <td>&nbsp; <?= $site_engineer ?></td>
            </tr>
        </table>
        
        <p align="justify">
            Pekerjaan tersebut telah selesai 100% dan terhitung dari tanggal <?php echo "<b>$tanggal</b> bulan <b>$bulan</b> tahun <b>$tahun</b>" ?>, telah diserahkan dari <b>Operation Departement ke Sales & Marketing Departement</b> dengan hasil baik dan layak di operasikan.
        </p>
        <p>
            Demikian Berita Acara ini dibuat berdasarkan keadaan yang sebenarnya dan dipertanggung jawabkan.
        </p>
        <table class="tanda_tangan">
            <tr>
                <th><?= $site_engineer_jabatan ?></th>
                <th><?= $jabatan ?></th>
                <th><?= $marketing_jabatan ?></th>
            </tr>
            <tr>
                <td><?= $site_engineer ?></td>
                <td><?= $nama_jabatan ?></td>
                <td><?= $marketing ?></td>
            </tr>
        </table>
        <footer align="center">
            
            <p><b><?php echo $perusahaan ?></b><br>Cyber Building 7th Floor, Jl. Kuningan Barat No.8 Jakarta 12710 - INDONESIA <br>Phone : +62.21.52211908, Fax : +62.21.5223368</p>
        </footer>
        <br>
        <br>
        <br>
        <div style='page-break-before: always;'>
        <center>
            <br>
            <br>
            <br>
        <?php
        echo $lampiran_text;
        ?>
        <br>
        <?php
        $i = 1;
        foreach (array('png', 'jpg', 'jpeg', 'gif') as $ext) {
            for ($i = 1; $i <= 5; $i++) {
                $file = "$lampiran_gambar"."$i.$ext";
                if (file_exists($file)) {
                    ?>
                    <img style="margin-top: 30px;" width="50%" src="<?= $file ?>" alt="" srcset="">
                    <br>
                    <?php
                }
            }
        }
        ?>
        
        </center>
        <style>
            footer {
                position: fixed;
                left: 0;
                bottom: 0;
                width: 100%;
                background-color: white;
                color: black;
                text-align: center;
            }
        </style>
        <footer>
        <p><b><?php echo $perusahaan ?></b><br>Cyber Building 7th Floor, Jl. Kuningan Barat No.8 Jakarta 12710 - INDONESIA <br>Phone : +62.21.52211908, Fax : +62.21.5223368</p>
        </footer>
    </div>
    </div>
    <input type="button" value="Cetak" onclick="printDiv('container')">
    <style>
        .kembali{
            position: fixed;
            bottom: 10px;
            right: 10px;
        }
    </style>
    <a href="lihat-ba.php" class="btn btn-primary kembali">
        <button type="button">
        Kembali
        </button>
    </a>
    </body>
    <script>
        function printDiv(divId) {
     var printContents = document.getElementById(divId).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;

     
}
    </script>
</html>