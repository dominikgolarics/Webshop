<?php
session_start();
require "database/db_connect.php";
$token = $_POST["token"];

$token_hash = hash("sha256", $token);

$sql = "SELECT * FROM felhasznalo
        WHERE token = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $token_hash);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$errors = [];
if ($user === null) {
    $errors[] = "Nem található a token";
}

if (strtotime($user["token_lejarat"]) <= time()) {
    $errors[] = "A token lejárt.";
}

if (strlen($_POST["password"]) < 8) {
    $errors[] = "A jelszónak legalább 8 karakter hosszúnak kell lennie!";
}

if ( ! preg_match("/[A-Z]/", $_POST["password"])) {
    $errors[] = "A jelszónak legalább egy nagybetűt tartalmaznia kell!";
}

if ( ! preg_match("/[0-9]/", $_POST["password"])) {
    $errors[] = "A jelszónak legalább egy számot tartalmaznia kell!";
}

if ($_POST["password"] !== $_POST["password_confirmation"]) {
    $errors[] = "A jelszavaknak egyezniük kell!";
}

if (!empty($errors)) {
    $_SESSION['jel_error'] = $errors[0]; // csak az első hiba jelenik meg
    header("Location: /jelszovaltoztatas.php?token=$token");
    exit;
}

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

$sql = "UPDATE felhasznalo
        SET jelszo = ?,
            token = NULL,
            token_lejarat = NULL
        WHERE id = ?";

$stmt = $conn->prepare($sql);



$stmt->bind_param("si", $password_hash, $user["id"]);

$stmt->execute();

echo    "<div style='text-align:center; margin-top:50px; font-size:20px;'>
        Sikeres jelszóváltoztatás! Kérjük jelenetkezz be...
        </div>";
echo    "<script>
            setTimeout(function() {
                window.location.href = '/';
            }, 3000);
        </script>";
exit;