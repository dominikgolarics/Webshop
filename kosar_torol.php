<?php
session_start();
require "database/db_connect.php";
$termek_id = $_POST['termek_id'] ?? null;
$user_id = $_SESSION['user_id'] ?? null;

if (!$termek_id || !$user_id) {
    echo json_encode(["status" => "error", "msg" => "Hiányzó adat"]);
    exit;
}

// Aktív kosár lekérdezése
$stmt = $conn->prepare("SELECT id FROM kosarak WHERE felhasznalo_id = ? AND fizetve = 0 LIMIT 1");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$kosar = $result->fetch_assoc();

if (!$kosar) {
    echo json_encode(["status" => "error", "msg" => "Nincs aktív kosár"]);
    exit;
}

$kosar_id = $kosar['id'];

// Tétel törlése
$stmt = $conn->prepare("DELETE FROM kosar_tetelek WHERE kosar_id = ? AND termek_id = ?");
$stmt->bind_param("ii", $kosar_id, $termek_id);
$stmt->execute();

echo json_encode(["status" => "ok"]);
