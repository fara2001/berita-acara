<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
    exit;
}

require_once('../koneksi.php');

$username = $_SESSION['username'];
$old_password = $_POST['old_password'];
$new_password = $_POST['new_password'];
$confirm_password = $_POST['confirm_password'];

$query = "SELECT password FROM user WHERE username = '$username'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if ($_POST['old_password'] == $data['password']) {
    if ($_POST['new_password'] == $_POST['confirm_password']) {
        $query = "UPDATE user SET password = '$new_password' WHERE username = '$username'";
        if (mysqli_query($conn, $query)) {
            echo "<script>
                    alert('Password berhasil di ubah');
                    window.location.href='../data-ba/lihat-ba.php';
                  </script>";
            
            exit;
        } else {
            echo "<script>
                    alert('Penggantian password gagal, silahkan coba kembali');
                    window.location.href='../user/ganti-password.php';
                  </script>";
            
            exit;
        }
    } else {
        echo "<script>
                    alert('Penggantian password gagal, password tidak sama');
                    window.location.href='../user/ganti-password.php';
                  </script>";
            
        exit;
    }
} else {
    echo "<script>
                    alert('Penggantian password gagal, password lama salah');
                    window.location.href='../user/ganti-password.php';
                  </script>";
            
    exit;
}

mysqli_close($conn);
?>
