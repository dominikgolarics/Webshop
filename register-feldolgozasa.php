<?php
session_start();
require "database/db_connect.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $uname = trim($_POST['uname'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $psw = trim($_POST['psw'] ?? '');
    $psw_again = $_POST['psw_again'] ?? '';
    $num = $_POST['num'] ?? '';

    $errors = [];

    // Felhasználónév ellenőrzés
    if (empty($uname)) {
        $errors[] = "A felhasználónév megadása kötelező!";
        
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $uname)) {
        $errors[] = "A felhasználónév csak betűket, számokat és alulvonást tartalmazhat!";
    } else {
        $sql = "SELECT felhasznalo_nev FROM felhasznalo WHERE felhasznalo_nev = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $uname);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $errors[] = "Ez a felhasználónév már foglalt!";
        }
    }

    // Email ellenőrzés
    if (empty($email)) {
        $errors[] = "Adj meg egy emailt!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Hibás email szerkezet!";
    } else {
        $sql = "SELECT email FROM felhasznalo WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $errors[] = "Ez az email már használatban van!";
        }
    }

    // Jelszó ellenőrzés
    if (strlen($psw) < 8) {
        $errors[] = "A jelszónak legalább 8 karakter hosszúnak kell lennie!";
    }

    if (!preg_match("/[A-Z]/", $psw)) {
        $errors[] = "A jelszónak legalább egy nagybetűt tartalmaznia kell!";
    }

    if (!preg_match("/[0-9]/", $psw)) {
        $errors[] = "A jelszónak legalább egy számot tartalmaznia kell!";
    }

    if ($psw !== $psw_again) {
        $errors[] = "A jelszavaknak egyezniük kell!";
    }

    if (empty($num)) {
        $errors[] = "A telefonszám megadása kötelező!";
    }
    elseif (!preg_match('/^\+36\d{9}$/', $num)) {
        $errors[] = "A telefonszám formátuma nem megfelelő! Példa: +36301234567";
    }

    // Ha van hiba, mentsük el
    if (!empty($errors)) {
        $_SESSION['reg_error'] = $errors[0]; // csak az első hiba jelenik meg
        $_SESSION['reg_data'] = [
            'uname' => $uname,
            'email' => $email,
            'num' => $num
        ];
        header("Location: /regisztracio");
        exit;
    }

    // Minden oké, mehet a mentés
    $psw = password_hash($psw, PASSWORD_DEFAULT);
    $sql = "INSERT INTO felhasznalo(felhasznalo_nev, email, jelszo, telefonszam) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $uname, $email, $psw, $num);

    if ($stmt->execute()) {
        unset($_SESSION['reg_data']);
        $_SESSION['reg_success'] = "Sikeres regisztráció!";
        header("Location: /");
        exit;
    } else {
        echo "Hiba: " . $stmt->error;
    }

    $conn->close();
}
