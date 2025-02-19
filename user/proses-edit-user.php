<?php
include '../koneksi.php';

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $query = "UPDATE user SET password = '$password', role = '$role' WHERE username = '$username'";
    $result = $conn->query($query);

    if ($result) {
        ?>
        <script>
            alert("Data Berhasil Diubah");
            window.location.replace("index.php");
        </script>
    <?php
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
}

$conn->close();
?>
