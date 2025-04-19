<?php
session_start();
require "database/db_connect.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: /");
    exit;
}

$user_id = $_SESSION['user_id'];

// Felhasználó törlése
$stmt = $conn->prepare("DELETE FROM felhasznalo WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();

// Kijelentkezés és visszairányítás
$_SESSION['torles_sikeres'] = true;
unset($_SESSION['user_id']);
header("Location: /");
exit;
?>