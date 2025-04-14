<?php
    require "database/db_connect.php";

    $sql = "SELECT * FROM felhasznalo WHERE id = '".$_SESSION["user_id"]."'";
	$result = $conn->query($sql);
	$user = $result->fetch_assoc();
?>
<div id="profil">
    <div id="profil-tartalom">
        <div id="profil-profilmenu">
            <a href="/profil/beallitas" class="profil-altabok">Beállítások</a>
            <a href="/profil/rendelesek" class="profil-altabok">Rendelések</a>
            <a href="/profil/szallitas" class="profil-altabok">Szállítási címek</a>
        </div>
        <div id="profil-menutartalom">
            <?php
                if($_GET['altab'] == 'beallitas'){
                   require 'beallitasok.php';
                }
                else if($_GET['altab'] == 'rendelesek'){
                    require 'rendelesek.php';
                }
                else if($_GET['altab'] == 'szallitas'){
                    require 'szallitasok.php';
                }
            ?>
        </div>
    </div>
</div>