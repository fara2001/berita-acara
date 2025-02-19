<?php
include '../koneksi.php';

if (isset($_POST['simpan'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $query_cek = "SELECT * FROM user WHERE username = '$username'";
    $result_cek = $conn->query($query_cek);

    if ($result_cek->num_rows > 0) {
        ?>
        <script>
            alert("Username sudah digunakan, silahkan pilih username lain");
            window.location.replace("tambah-user.php");
        </script>
    <?php
    } else {
        $query = "INSERT INTO user (username, password, role) VALUES ('$username', '$password', '$role')";
        $result = $conn->query($query);

        if ($result) {
            ?>
            <script>
                alert("Data Berhasil Ditambahkan");
                window.location.replace("index.php");
            </script>
        <?php
        } else {
            echo "Error: " . $query . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>

