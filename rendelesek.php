<?php
    $sql = 
    "SELECT
        *,
        (SELECT cipokepek.url 
        FROM cipokepek 
        WHERE cipokepek.cipoID = termek.id 
        LIMIT 1) AS elso_kep
    FROM
        rendeles_tetel
    INNER JOIN rendeles ON rendeles_tetel.rendeles_id = rendeles.id
    INNER JOIN termek ON rendeles_tetel.termek_id = termek.id
    WHERE
        felhasznalo_id = ".$_SESSION['user_id']."
    ORDER BY rendeles.datum DESC";

	$result = $conn->query($sql);
	$rendelesek = $result->fetch_all(MYSQLI_ASSOC);
?>

<div id='rendelesek-tartalom'>

    <?php if (count($rendelesek) === 0): ?>
        <p class="ures-szoveg">Jelenleg nincs leadott rendelésed.</p>
    <?php else: ?>
        <?php 
        $aktualis_id = 0;
        $osszeg = 0;
        foreach ($rendelesek as $index => $r): 
            if ($aktualis_id !== $r['rendeles_id']) {
                if ($aktualis_id !== 0) {
                    // előző rendelés végösszegének kiírása
                    echo "<div class='rendeles-osszeg'><strong>Végösszeg:</strong> " . number_format($osszeg, 0, ',', ' ') . " Ft</div>";
                    echo "</div>"; // előző rendelés lezárása
                }
                echo "<div class='rendeles-kartya'>";
                echo "<div class='rendeles-fejlec'>";
                $datum = date_parse($r['datum']);
                echo "<span>📄 Rendelés #NILE-".substr($datum['year'],2).sprintf('%02d', $datum['month']).sprintf('%02d', $datum['month']).sprintf('%02d', $datum['hour']).sprintf('%02d', $datum['minute']).sprintf('%02d', $datum['second'])."</span>";
                echo "<span class='rendeles-datum'>🗓 ".$datum['year']."-".sprintf('%02d', $datum['month']).'-'.sprintf('%02d', $datum['day'])."</span>";
                echo "</div>";
                $aktualis_id = $r['rendeles_id'];
                $osszeg = 0; // új rendelésnél nullázás
            }
        
            $termek_osszar = $r['mennyiseg'] * $r['ar'];
            $osszeg += $termek_osszar + 1290;
        ?>
            <div class='rendelt-termek'>
                <img src='/<?= $r['elso_kep'] ?>' alt='termék' class='rendeles-kep'>
                <div class='rendeles-info'>
                    <div class='termek-nev'><?= $r['nev'] ?></div>
                    <div class='termek-ar'><?= $r['mennyiseg'] ?> db × <?= number_format($r['ar'], 0, '', ' ') ?> Ft</div>
                </div>
            </div>
        <?php 
        endforeach;
        // utolsó rendelés zárása + összegzése
        if ($aktualis_id !== 0) {
            echo "<div class='rendeles-osszeg'><strong>Végösszeg:</strong> " . number_format($osszeg, 0, ',', ' ') . " Ft</div>";
            echo "</div>";
        }
        ?>        
    <?php endif; ?>
</div>

