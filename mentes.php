<?php
    session_start();
    require "database/db_connect.php";

    $id = $_SESSION['user_id'];

    $frissitesek = [];

    if(isset($_POST['nev'])){
        $nev = trim($_POST['nev']);
        $frissitesek[] = "nev = ".($nev=== '' ? "NULL" : "'". mysqli_real_escape_string($conn, $nev))."'";
    }
    if(isset($_POST['iranyitoszam'])){
        $iranyitoszam = trim($_POST['iranyitoszam']);
        $frissitesek[] = "iranyitoszam = ".($iranyitoszam=== '' ? "NULL" : "'". mysqli_real_escape_string($conn, $iranyitoszam)."'");
    }
    if(isset($_POST['cim'])){
        $cim = trim($_POST['cim']);
        $frissitesek[] = "cim = ".($cim=== '' ? "NULL" : "'". mysqli_real_escape_string($conn, $cim)."'");
    }
    if(isset($_POST['varos'])){
        $varos = trim($_POST['varos']);
        $frissitesek[] = "varos = ".($varos=== '' ? "NULL" : "'". mysqli_real_escape_string($conn, $varos)."'");
    }
    if(isset($_POST['email'])){
        $email = trim($_POST['email']);
        $frissitesek[] = "email = ".($email=== '' ? "NULL" : "'". mysqli_real_escape_string($conn, $email)."'");
    }
    if(isset($_POST['telefonszam'])){
        $telefonszam = trim($_POST['telefonszam']);
        $frissitesek[] = "telefonszam = ".($telefonszam=== '' ? "NULL" : "'". mysqli_real_escape_string($conn, $telefonszam)."'");
    }

    if(!empty($frissitesek)){
        $sql = "UPDATE felhasznalo SET " . implode(", ", $frissitesek) . " WHERE id = $id";
        if(mysqli_query($conn, $sql)){
            echo "Sikeres!!!";
        }
        else{
            echo "Hiba: ".mysqli_error($conn);
        }
    }
    else{
        echo "Nincs mit frissiteni";
    }
?>