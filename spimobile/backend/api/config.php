<?php
$host = "localhost";   // host database, biasanya localhost
$db   = "db_spi";      // nama database kamu
$user = "root";        // username database
$pass = "";            // password database

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
