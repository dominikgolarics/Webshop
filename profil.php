<?php
    require "database/db_connect.php";
    if(!isset($_SESSION['user_id'])){
        header("Location: /");
    }
?>
<div id="profil">
    <div id="profil-tartalom">
        <div id="profil-profilmenu">
            <a href="/profil/beallitasok" class="profil-altabok">Beállítások</a>
            <a href="/profil/ujjelszo" class="profil-altabok">Jelszó Változtatás</a>
            <a href="/profil/rendelesek" class="profil-altabok">Rendelések</a>
            <a href="#" id="torlesGomb" class="profil-altabok" style="color: red">Profil törlése</a>
        </div>
        <div id="profil-menutartalom">
            <?php
                if($_GET['altab'] == 'beallitasok'){
                    require 'beallitasok.php';
                }
                else if($_GET['altab'] == 'ujjelszo'){
                    require 'ujjelszo.php';
                }
                else if($_GET['altab'] == 'rendelesek'){
                    require 'rendelesek.php';
                }
                ?>
        </div>
        <div id="torles-popup" style="display: none;">
        <div id="torles-ablak">
            <p>Biztosan törölni szeretnéd a profilodat?</p>
            <button id="igenGomb">Igen</button>
            <button id="megsemGomb">Mégsem</button>
        </div>
        </div>
    </div>
</div>