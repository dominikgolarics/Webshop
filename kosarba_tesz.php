<?php
session_start();
require "database/db_connect.php";

$termek_id = $_POST['termek_id'] ?? null;
$mennyiseg = $_POST['mennyiseg'] ?? 1;
$user_id = $_SESSION['user_id'] ?? null;

if (!$user_id) {
    // Nem bejelentkezett felhasználó
    header("Location: /");
    exit;
}

// Kosár keresése vagy létrehozása
$stmt = $conn->prepare("SELECT id FROM kosarak WHERE felhasznalo_id = ? AND fizetve = 0 LIMIT 1");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$kosar = $result->fetch_assoc();

if (!$kosar) {
    // Ha nincs, új kosár
    $stmt = $conn->prepare("INSERT INTO kosarak (felhasznalo_id) VALUES (?)");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $kosar_id = $conn->insert_id;
} else {
    $kosar_id = $kosar['id'];
}

// Tétel hozzáadása vagy frissítése
$stmt = $conn->prepare("SELECT id, mennyiseg FROM kosar_tetelek WHERE kosar_id = ? AND termek_id = ?");
$stmt->bind_param("ii", $kosar_id, $termek_id);
$stmt->execute();
$result = $stmt->get_result();
$tetel = $result->fetch_assoc();

if ($tetel) {
    $uj_mennyiseg = $tetel['mennyiseg'] + $mennyiseg;
    $stmt = $conn->prepare("UPDATE kosar_tetelek SET mennyiseg = ? WHERE id = ?");
    $stmt->bind_param("ii", $uj_mennyiseg, $tetel['id']);
} else {
    $stmt = $conn->prepare("INSERT INTO kosar_tetelek (kosar_id, termek_id, mennyiseg) VALUES (?, ?, ?)");
    $stmt->bind_param("iii", $kosar_id, $termek_id, $mennyiseg);
}
$stmt->execute();

echo json_encode(["status" => "ok"]); // Vagy vissza redirect a termék oldalra
exit;
