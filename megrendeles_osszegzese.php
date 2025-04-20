<?php
    
    if(isset($_SESSION['utolso_rendeles_id']))
    {
        $rend_id=$_SESSION['utolso_rendeles_id'];
        unset($_SESSION['utolso_rendeles_id']);
    }
    else{
        header("Location: /");
    }

    $stmt = $conn->prepare("SELECT
        felhasznalo.nev as fnev,
        felhasznalo.email,
        felhasznalo.telefonszam,
        felhasznalo.cim,
        felhasznalo.iranyitoszam,
        felhasznalo.varos,
        termek.nev as tnev,
        termek.ar,
        rendeles_tetel.mennyiseg,
        rendeles.datum,
        ( SELECT cipokepek.url FROM cipokepek WHERE cipokepek.cipoID = termek.id LIMIT 1 ) AS elso_kep
    FROM `rendeles`
    INNER JOIN rendeles_tetel ON rendeles_tetel.rendeles_id = rendeles.id
    INNER JOIN termek ON termek.id = rendeles_tetel.termek_id
    INNER JOIN felhasznalo on rendeles.felhasznalo_id = felhasznalo.id
    WHERE rendeles_tetel.rendeles_id = ?");
    
    $stmt->bind_param("i", $rend_id);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    $datum=date_parse($result[0]['datum']);
    $kod=substr($datum['year'],2).sprintf('%02d', $datum['month']).sprintf('%02d', $datum['day']).sprintf('%02d', $datum['hour']).sprintf('%02d', $datum['minute']).sprintf('%02d', $datum['second']);

    $datum = new DateTime($result[0]['datum']);
$szallitas = clone $datum;
$szallitas->modify('+1 week');
$szallitasi_datum = $szallitas->format('Y-m-d');

$kod = $datum->format('ymdHis');
$osszar = 0;
$szallitasi_dij = 1290;

echo '<div class="rendeles-kartya">';
echo '<h2 class="rendeles-fejlec">Rendelésed felvettük a rendszerünkbe!</h2>';
echo '<p class="rendeles-kod">#NILE-' . htmlspecialchars($kod) . '</p>';
echo '<ul class="rendelt-termekek">';
$termekSzam = count($result);

foreach ($result as $index => $sor) {
    echo '<li>';
    echo '<img class="rendeles-kep" src="' . htmlspecialchars($sor['elso_kep']) . '" alt="termék kép">';
    echo '<div class="rendeles-szoveg">';
    echo '<strong>' . htmlspecialchars($sor['tnev']) . '</strong><br>';
    echo $sor['mennyiseg'] . ' db - ' . number_format($sor['ar'], 0, ',', ' ') . ' Ft/db';
    echo '</div>';
    echo '</li>';
    $osszar+=$sor['ar']*$sor['mennyiseg'];
    // Ha nem az utolsó termék ÉS legalább 2 van, tegyük közéjük vonalat
    if ($termekSzam > 1 && $index < $termekSzam - 1) {
        echo '<hr class="termek-valaszto">';
    }
}
echo '</ul>';

$vegosszeg = $osszar + $szallitasi_dij;

echo '<div class="rendeles-osszefoglalas">';
echo '<p><strong>Termékek összértéke:</strong> ' . number_format($osszar, 0, ',', ' ') . ' Ft</p>';
echo '<p><strong>Szállítási díj:</strong> ' . number_format($szallitasi_dij, 0, ',', ' ') . ' Ft</p>';
echo '<p><strong>Végösszeg:</strong> ' . number_format($vegosszeg, 0, ',', ' ') . ' Ft</p>';
echo '<p><strong>Várható szállítás:</strong> ' . htmlspecialchars($szallitasi_datum) . '</p>';
echo '</div>';
echo '</div>';
?>
?>