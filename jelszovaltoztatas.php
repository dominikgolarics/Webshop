<?php
session_start();
require "database/db_connect.php";
$token = $_GET["token"] ?? null;

if (!$token) {
    $hiba = "Hiányzó token!";
} else {
    $token_hash = hash("sha256", $token);

    $sql = "SELECT * FROM felhasznalo WHERE token = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $token_hash);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (!$user) {
        $hiba = "Érvénytelen vagy ismeretlen token!";

    } elseif (strtotime($user["token_lejarat"]) <= time()) {
        $hiba = "A token lejárt. Kérj új jelszó-visszaállítást.";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Jelszó megváltoztatása</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="/style/style.css" />
    <meta charset="UTF-8">
    <?php if (isset($hiba)): ?>
        <meta http-equiv="refresh" content="5;url=/" />
    <?php endif; ?>
</head>
<body>
<div id="error-container">
            <?php if (isset($_SESSION['jel_error'])): ?>
                <div class="alert alert-danger text-center"><?= htmlspecialchars($_SESSION['jel_error']) ?></div>
                <?php unset($_SESSION['jel_error']); ?>
            <?php endif; ?>
        </div>
    <div class="jelszocsomag">
        <h1>Jelszó megváltoztatása</h1>

        <?php if (isset($hiba)): ?>
            <div class="hiba-uzenet">
                <?= htmlspecialchars($hiba) ?><br><br>
                Átirányítás a főoldalra 5 másodperc múlva...
            </div>
        <?php else: ?>
        
            <form method="post" action="jelszovaltoztatas-feldolgozasa.php">
                <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
                <label for="password">Új jelszó</label>
                <input type="password" id="password" name="password">

                <label for="password_confirmation">Új jelszó ismét</label>
                <input type="password" id="password_confirmation" name="password_confirmation">

                <button>Küldés</button>
            </form>
        <?php endif; ?>
    </div>


</body>
</html>