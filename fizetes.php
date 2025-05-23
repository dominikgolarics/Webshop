<?php
    require "database/db_connect.php";

    if(!isset($_SESSION['user_id'])){
        header("Location: /");
    }

    $sql = "SELECT termek.id, termek.nev, marka.ceg AS marka, meret.meret AS meret, termek.ar, kosar_tetelek.mennyiseg AS darab, ( SELECT cipokepek.url FROM cipokepek WHERE cipokepek.cipoID = termek.id LIMIT 1 ) AS elso_kep FROM `kosarak` INNER JOIN kosar_tetelek ON kosarak.id = kosar_tetelek.kosar_id INNER JOIN termek ON termek.id = kosar_tetelek.termek_id INNER JOIN marka ON termek.marka_id = marka.id INNER JOIN meret on termek.marka_id = meret.id";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    $id=$_SESSION['user_id'];
    $sql_2="SELECT id,nev,felhasznalo_nev,email,telefonszam,cim,iranyitoszam,varos FROM felhasznalo WHERE id=$id";
    $stmt = $conn->prepare($sql_2);
    $stmt->execute();
    $felh = $stmt->get_result()->fetch_assoc();
?>
<div class="fizetes-container">
    <!-- Rendelés összegzése -->
    <div class="order-summary">
        <h2>Rendelés összegzése</h2>
        
        <?php
        foreach($result as $cipo){
            echo '<div class="product-item">';
            echo '<img src="'.$cipo['elso_kep'].'" alt="Termék neve" class="product-image">';
                echo '<div>';
                    echo '<h3>'.$cipo['nev'].'</h3>';
                    echo '<p>Méret: '.$cipo['meret'].'</p>';    
                    echo '<p>'.$cipo['darab'].' db × '.$cipo['ar'].' Ft</p>';
                echo '</div>';
            echo '</div>';
        }
        ?>
        
        <div class="total">
            <p>Összesen: 
                <span style="float: right;">
                    <?php 
                        $összeg = 0;
                        for ($i=0; $i < count($result); $i++) { 
                            $összeg+=($result[$i]['ar']*$result[$i]['darab']);
                        }
                        echo ($összeg+1290)." FT"; ?>
                </span>
            </p>
        </div>
    </div>
    
    <!-- Fizetési űrlap -->
    <div class="checkout-form">
        <h2>Szállítási adatok</h2>

        <div class="form-group">
            <label id="fizetes-label"for="name">Teljes név</label>
            <input type="text" id="fizetes-name" <?php if(!empty($felh['nev'])) { echo 'value="' . htmlspecialchars($felh['nev']) . '" disabled'; } ?> >
        </div>
        
        <div class="form-group">
            <label id="fizetes-label"for="email">E-mail cím</label>
            <input type="email" id="fizetes-email" <?php if(!empty($felh['email'])) { echo 'value="' . htmlspecialchars($felh['email']) . '" disabled'; } ?> >
        </div>
        
        <div class="form-group">
            <label id="fizetes-label"for="phone">Telefonszám</label>
            <input type="text" id="fizetes-phone" <?php if(!empty($felh['telefonszam'])) { echo 'value="' . htmlspecialchars($felh['telefonszam']) . '" disabled'; } ?> >
        </div>
        
        <h2>Szállítási cím</h2>
        
            <div class="form-group">
                <label id="fizetes-label">Cím</label>
                <input type="text" id="fizetes-cim" <?php if(!empty($felh['cim'])) { echo 'value="' . htmlspecialchars($felh['cim']) . '" disabled'; } ?> >
            </div>
        
            <div class="form-group">
                <label id="fizetes-label">Város</label>
                <input type="text" id="fizetes-varos" <?php if(!empty($felh['varos'])) { echo 'value="' . htmlspecialchars($felh['varos']) . '" disabled'; } ?> >
            </div>
            
            <div class="form-group">
                <label id="fizetes-label">Irányítószám</label>
                <input type="text" id="fizetes-iranyitoszam" <?php if(!empty($felh['iranyitoszam'])) { echo 'value="' . htmlspecialchars($felh['iranyitoszam']) . '" disabled'; } ?> >
            </div>
        
        <h2>Fizetési mód</h2>
        
        <div class="payment-option selected">
            <input type="radio" name="payment" id="fizetes-card">
            <label id="fizetes-label">Személyesen bankkártyával</label>
        </div>
        
        <div class="payment-option">
            <input type="radio" name="payment" id="fizetes-cash">
            <label id="fizetes-label">Személyesen készpénzzel</label>
        </div>
        <button class="fizetes-btn" id="megrendeles">Megrendelés elküldése</button>
    </div>
</div>