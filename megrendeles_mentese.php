<?php
session_start();
require "database/db_connect.php";
$user_id = $_SESSION['user_id'];

$kosar_sql = "SELECT termek.id AS termekId, termek.nev, marka.ceg AS marka, termek.ar, kosar_tetelek.mennyiseg AS darab, kosarak.id as kosarID, ( SELECT cipokepek.url FROM cipokepek WHERE cipokepek.cipoID = termek.id LIMIT 1 ) AS elso_kep FROM kosarak INNER JOIN kosar_tetelek ON kosarak.id = kosar_tetelek.kosar_id INNER JOIN termek ON termek.id = kosar_tetelek.termek_id INNER JOIN marka ON termek.marka_id = marka.id";
$stmt = $conn->prepare($kosar_sql);
$stmt->execute();
$result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

$sql = "UPDATE felhasznalo SET email = '".$_POST['rendeles_email']."', nev = '".$_POST['rendeles_nev']."', telefonszam = '".$_POST['rendeles_telefonszam']."', cim = '".$_POST['rendeles_cim']."', varos = '".$_POST['rendeles_varos']."', iranyitoszam = '".$_POST['rendeles_iranyitoszam']."' WHERE id = $user_id";
mysqli_query($conn, $sql);

$osszeg = 0;
foreach($result as $item){
    $osszeg += $item['ar'] * $item['darab'];
}
$osszeg += 1290;

$stmt = $conn->prepare("INSERT INTO rendeles (felhasznalo_id, osszeg) VALUES (?, ?)");
$stmt->bind_param("ii", $user_id, $osszeg);
$stmt->execute();
$rendeles_id = $conn->insert_id;

foreach($result as $item){
    $stmt = $conn->prepare("INSERT INTO rendeles_tetel (rendeles_id, termek_id, mennyiseg) VALUES (?, ?, ?)");
    $stmt->bind_param("iii", $rendeles_id, $item['termekId'], $item['darab']);
    $stmt->execute();
}

$_SESSION['utolso_rendeles_id'] = $rendeles_id;

echo $rendeles_id;

