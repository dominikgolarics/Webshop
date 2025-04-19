<?php
session_start();
require_once 'database/db_connect.php'; // az adatbázis kapcsolat fájlod

$felhasznalo = $_POST['felhasznalo'] ?? '';
$jelszo = $_POST['jelszo'] ?? '';

$felhasznalo = trim($felhasznalo);
$jelszo = trim($jelszo);

if ($felhasznalo === '' || $jelszo === '') {
    echo "hiba";
    exit;
}

$stmt = $conn->prepare("SELECT * FROM felhasznalo WHERE felhasznalo_nev = ?");
$stmt->bind_param("s", $felhasznalo);
$stmt->execute();
$eredmeny = $stmt->get_result();

if ($sor = $eredmeny->fetch_assoc()) {
    if (password_verify($jelszo, $sor['jelszo'])) {
        $_SESSION['user_id'] = $sor['id'];
        $_SESSION["sikeres_bejelentkezes"] = true;
        unset($_POST['uname']);
        echo "ok";
    } else {
        echo "hiba";
    }
} else {
    echo "hiba";
}