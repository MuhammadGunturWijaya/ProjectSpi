<?php
header("Access-Control-Allow-Origin: *"); 
header("Content-Type: application/json; charset=UTF-8");

include __DIR__ . '/../config.php'; // koneksi database

$user_id = $_GET['user_id'] ?? '';

if (empty($user_id)) {
    echo json_encode([
        "status" => "error",
        "message" => "user_id tidak ditemukan"
    ]);
    exit;
}

$sql = "SELECT 
          COUNT(*) AS total_laporan,
          SUM(CASE WHEN status != 'selesai' THEN 1 ELSE 0 END) AS total_proses,
          SUM(CASE WHEN status = 'selesai' THEN 1 ELSE 0 END) AS total_selesai
        FROM pengaduans
        WHERE user_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_id); // gunakan "s" untuk BIGINT
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

echo json_encode([
    "status" => "success",
    "data" => $data
]);
?>
