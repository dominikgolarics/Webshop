<?php
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

if ($user === null) {
    die("token not found");
}

if (strtotime($user["token_lejarat"]) <= time()) {
    die("token has expired");
}

if (strlen($_POST["password"]) < 8) {
    die("Password must be at least 8 characters");
}

if ( ! preg_match("/[a-z]/i", $_POST["password"])) {
    die("Password must contain at least one letter");
}

if ( ! preg_match("/[0-9]/", $_POST["password"])) {
    die("Password must contain at least one number");
}

if ($_POST["password"] !== $_POST["password_confirmation"]) {
    die("Passwords must match");
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