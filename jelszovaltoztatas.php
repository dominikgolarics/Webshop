<?php
require "database/db_connect.php";
$token = $_GET["token"];

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

?>
<!DOCTYPE html>
<html>
<head>
    <title>Jelszó megváltoztatása</title>
    <meta charset="UTF-8">
</head>
<body>

    <h1>Jelszó megváltoztatása</h1>

    <form method="post" action="jelszovaltoztatas-feldolgozasa.php">

        <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

        <label for="password">New password</label>
        <input type="password" id="password" name="password">

        <label for="password_confirmation">Repeat password</label>
        <input type="password" id="password_confirmation"
               name="password_confirmation">

        <button>Send</button>
    </form>

</body>
</html>