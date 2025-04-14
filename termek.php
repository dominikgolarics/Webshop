<?php
require "database/db_connect.php";
$cipo_id = $_GET['id'] ?? null;

if ($cipo_id) {
    $conn = new mysqli("localhost", "root", "", "webshop");

    $sql = "SELECT 
            termek.id, 
            termek.nev, 
            termek.ar, 
            termek.megjelenes, 
            termek.raktaron, 
            tipus.tipus AS tipus, 
            marka.ceg AS marka, 
            meret.meret AS meret,
            GROUP_CONCAT(cipokepek.url SEPARATOR '|||') AS kepek
        FROM `termek` 
        INNER JOIN marka ON termek.marka_id = marka.id 
        INNER JOIN tipus ON termek.tipus_id = tipus.id 
        INNER JOIN meret ON termek.meret_id = meret.id
        LEFT JOIN cipokepek ON termek.id = cipokepek.cipoID
        WHERE termek.id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $cipo_id);
    $stmt->execute();
    $product = $stmt->get_result()->fetch_assoc();

    foreach ($product as $cipo) {
        $kepek=!empty($product['kepek']) ? explode('|||',$product['kepek']):[];
    }
}

?>
<body style="background-color: #fdf8e1">    
    <!-- NINCS MÉRET OPCIÓ csak egyszerű rendelés -->
    <div id="termek-tart">
    <div id="termek-kepek">
        <div id="nagy-kep">
            <img id='nagy-nezet' class="img-fluid" src="<?php echo $kepek[0] ?>">
        </div>
        <div id="kis-kepek">
            <?php for ($i = 0; $i < min(4, count($kepek)); $i++): ?>
                <img class="kep-elonezet" src="<?php echo $kepek[$i] ?>" onclick="showImage(this)">
            <?php endfor; ?>
        </div>
    </div>
    <div id="termek-info">
        <p id='termek-marka'><?php echo $product['marka'] ?></p>
        <h1 id='termek-nev'><?php echo $product['nev'] ?></h1>
        <div id="termek-ar"><?php echo number_format($product['ar'], 0, ',', ' ') ?> FT</div>
        
        <div class="mennyiseg-gomb">
            <button class="csokkent">-</button>
            <span class="mennyiseg">1</span>
            <button class="noveked">+</button>
        </div>
        
        <button id="kosar-gomb">Kosárba</button>
        
        <div class="termek-details">
            <div class="detail-item">
                <span class="detail-label">Méret:</span>
                <span class="detail-value"><?php echo $product['meret'] ?></span>
            </div>
            <div class="detail-item">
                <span class="detail-label">Raktáron:</span>
                <span class="detail-value"><?php echo $product['raktaron'] ?> db</span>
            </div>
        </div>
    </div>
</div>

</body>