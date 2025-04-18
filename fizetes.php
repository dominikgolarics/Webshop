<?php
    require "database/db_connect.php";

    $sql = "SELECT termek.id, termek.nev, marka.ceg AS marka, meret.meret AS meret, termek.ar, kosar_tetelek.mennyiseg AS darab, ( SELECT cipokepek.url FROM cipokepek WHERE cipokepek.cipoID = termek.id LIMIT 1 ) AS elso_kep FROM `kosarak` INNER JOIN kosar_tetelek ON kosarak.id = kosar_tetelek.kosar_id INNER JOIN termek ON termek.id = kosar_tetelek.termek_id INNER JOIN marka ON termek.marka_id = marka.id INNER JOIN meret on termek.marka_id = meret.id";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
?>
<div class="container">
    <!-- Rendelés összegzése -->
    <div class="order-summary">
        <h2>Rendelés összegzése</h2>
        
        <?php
        foreach($result as $cipo){
            echo '<div class="product-item">';
            echo '<img src="'.$cipo['elso_kep'].'" alt="Termék neve" class="product-image">';
                echo '<div>';
                    echo '<h3>'.$cipo['nev'].'</h3>';
                    echo '<p>'.$cipo['meret'].'</p>';
                    echo '<p>'.$cipo['darab'].' db × '.$cipo['ar'].' Ft</p>';
                echo '</div>';
            echo '</div>';
        }
        ?>
        
        <div class="total">
            <p>Összesen: <span style="float: right;"><?php 
                        $összeg = 0;
                        for ($i=0; $i < count($result); $i++) { 
                            $összeg+=($result[$i]['ar']*$result[$i]['darab']);
                        }
                        echo $összeg; ?>
                        </span></p>
        </div>
    </div>
    
    <!-- Fizetési űrlap -->
    <div class="checkout-form">
        <h2>Szállítási adatok</h2>
        
        <div class="form-group">
            <label for="name">Teljes név</label>
            <input type="text" id="name" required>
        </div>
        
        <div class="form-group">
            <label for="email">E-mail cím</label>
            <input type="email" id="email" required>
        </div>
        
        <div class="form-group">
            <label for="phone">Telefonszám</label>
            <input type="text" id="phone" required>
        </div>
        
        <h2>Szállítási cím</h2>
        
        <div class="address-option selected">
            <input type="radio" name="address" id="home-address" checked>
            <label for="home-address">Lakcím</label>
            <p>1234 Budapest, Példa utca 12.</p>
        </div>
        
        <div class="address-option">
            <input type="radio" name="address" id="other-address">
            <label for="other-address">Más cím</label>
            <div id="other-address-fields" style="display: none; margin-top: 10px;">
                <textarea rows="4" placeholder="Írja be a teljes címet"></textarea>
            </div>
        </div>
        
        <h2>Fizetési mód</h2>
        
        <div class="payment-option selected">
            <input type="radio" name="payment" id="card" checked>
            <label for="card">Bankkártya</label>
        </div>
        
        <div class="payment-option">
            <input type="radio" name="payment" id="transfer">
            <label for="transfer">Átutalás</label>
        </div>
        
        <div class="payment-option">
            <input type="radio" name="payment" id="cash">
            <label for="cash">Utánvét</label>
        </div>
        
        <button type="submit" class="fizetes-btn">Megrendelés elküldése</button>
    </div>
</div>