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

    <title>Detail User</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <style type="text/css">
        * {
            font-family: "Trebuchet MS";
        }

        h1 {
            text-transform: uppercase;
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
            <a class="navbar-brand" href="lihat-ba.php">Data User</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../tampil2.php">Data Number</a>
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
        <h1 align="center">Detail User</h1>
        <?php
        $username = $_GET['username'];
        $sql = "SELECT * FROM user WHERE username = '$username'";
        $query = mysqli_query($conn, $sql);
        $data = mysqli_fetch_array($query);
        ?>

        <table class="table table-bordered table-striped">
            <tr>
                <th>Username</th>
                <td><input type="text" class="form-control" value="<?php echo $data['username']; ?>" readonly></td>
            </tr>
            <tr>
                <th>Password</th>
                <td>
                    <div class="input-group">
                        <input class="form-control" type="password" name="password" id="password" value="<?php echo $data['password']; ?>" readonly>
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button" onclick="showPassword()">Tampilkan</button>
                        </div>
                    </div>
                    <script>
                        function showPassword() {
                            var x = document.getElementById("password");
                            if (x.type === "password") {
                                x.type = "text";
                            } else {
                                x.type = "password";
                            }
                        }
                    </script>
                </td>
            </tr>
            <tr>
                <th>Role</th>
                <td><?php echo $data['role']; ?></td>
            </tr>
            <tr>
                <td colspan="2">
                    <a href="index.php"><button type="button" class="btn btn-primary">Tutup</button></a>
                </td>
            </tr>
        </table>
    </div>
</body>
