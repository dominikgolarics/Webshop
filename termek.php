<?php
$cipo_id = $_GET['id'] ?? null;

if ($cipo_id) {
    $mysqli = new mysqli("localhost", "root", "", "webshop");
    $mysqli = new mysqli("localhost", "username", "password", "webshop");
    
    // Get product details
    $stmt = $mysqli->prepare("
        SELECT t.*, m.ceg AS marka, ti.tipus, me.meret 
        FROM termek t
        JOIN marka m ON t.marka_id = m.id
        JOIN tipus ti ON t.tipus_id = ti.id
        JOIN meret me ON t.meret_id = me.id
        WHERE t.id = ?
    ");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $product = $stmt->get_result()->fetch_assoc();
    var_dump($product);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style/style.css" />
    <link rel="icon" type="image/x-icon" href="img/menu/favicon.ico" />
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="script.js"></script>
    <title>Nile</title>
</head>

<body style="background-color: #fdf8e1">

    <div id="fejlec">
        <header id="fej">
            <div id="logo">
                <h2><a id="logo_link" href="#">Nile</a></h2>
            </div>
            <ul id="fej_tart">
                <li><a class="fej_link" href="friss.php">Új kiadás</a></li>
                <li><a class="fej_link" href="legkel.php">Legkelendőbbek</a></li>
                <li><a class="fej_link" href="termekek.php">Termékek</a></li>
            </ul>
            <div id="fej_tool">
                <img id="kosar" src="img/menu/kosar.png" alt="kosar" />
                <img id="profil" src="img/menu/icon.png" alt="ikon" />
            </div>
        </header>
    </div>

    <div id="termek-tart">
        
    </div>

</body>

</html>

