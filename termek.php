<?php
$cipo_id = $_GET['id'] ?? null;

if ($cipo_id) {
    $mysqli = new mysqli("localhost", "root", "", "webshop");

    $sql = "SELECT termek.id, nev, ar, megjelenes, raktaron, tipus.tipus AS tipus, marka.ceg AS marka, meret.meret AS meret
    FROM `termek` 
    INNER JOIN marka ON termek.marka_id = marka.id 
    INNER JOIN tipus ON termek.tipus_id = tipus.id 
    INNER JOIN meret ON termek.meret_id = meret.id
    WHERE termek.id = ?";

    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $cipo_id);
    $stmt->execute();
    $product = $stmt->get_result()->fetch_assoc();
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
    <!-- NINCS MÉRET OPCIÓ csak egyszerű rendelés -->
    <div id="termek-tart">
        <div id="termek-kepek">
            <div id="kis-kepek">
                <img class="kep-elonezet" src="img/cipo/21A282-100_Tenis-Asics-Gel-Kayano-5-OG-Masculino-Multicolor-2.jpg" onclick="showImage(this)">
                <img class="kep-elonezet" src="img/cipo/21A282-100_Tenis-Asics-Gel-Kayano-5-OG-Masculino-Multicolor-3.jpg" onclick="showImage(this)">
                <img class="kep-elonezet" src="img/cipo/21A282-100_Tenis-Asics-Gel-Kayano-5-OG-Masculino-Multicolor-4.jpg" onclick="showImage(this)">
                <img class="kep-elonezet" src="img/cipo/21A282-100_Tenis-Asics-Gel-Kayano-5-OG-Masculino-Multicolor-5.jpg" onclick="showImage(this)">
            </div>
            <div id="nagy-kep">
                <div id="xd">xd</div>
            </div>
        </div>
        <div id="termek-info">
            <?php echo "<p id='termek-marka'>" . $product['marka'] . "</p>"; ?>
            <?php echo "<h1 id='termek-nev'>" . $product['nev'] . "</h1>"; ?>
            <?php echo "<span id='termek-ar'>" . $product['ar'] . "FT</span>" ?>
            <!-- Valszeg nem kell <?php echo "<span>" . $product['meret'] . "</span>"; ?> -->
            <button id="kosar-gomb">Kosárba</button>

            <div class="mennyiseg-gomb">
                <!-- nem szép de használható -->
                <button class="csokkent">-</button>
                <span class="mennyiseg">1</span>
                <button class="noveked">+</button>
            </div>
        </div>
    </div>

</body>

</html>