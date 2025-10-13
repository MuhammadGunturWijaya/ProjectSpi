<?php
header("Access-Control-Allow-Origin: *"); // Supaya Flutter Web bisa request
header("Content-Type: application/json; charset=UTF-8");

include __DIR__ . '/../config.php'; // koneksi ke database

// Query data dari tabel pengaduans
$sql = "SELECT * FROM pengaduans";
$result = $conn->query($sql);

$data = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Kirim data sebagai JSON
echo json_encode($data);
?>
