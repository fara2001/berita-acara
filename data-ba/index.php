<?php
session_start();
if (isset($_SESSION['username'])) {
    header('Location: lihat-ba.php');
    exit();
} else {
    header('Location: ../login.php');
    exit();
}
