<?php
session_start();
require "database/db_connect.php";
$user_id = $_SESSION['user_id'];

$kosar_sql = "SELECT termek.id AS termekId, termek.nev, marka.ceg AS marka, termek.ar, kosar_tetelek.mennyiseg AS darab, kosarak.id as kosarID, ( SELECT cipokepek.url FROM cipokepek WHERE cipokepek.cipoID = termek.id LIMIT 1 ) AS elso_kep FROM kosarak INNER JOIN kosar_tetelek ON kosarak.id = kosar_tetelek.kosar_id INNER JOIN termek ON termek.id = kosar_tetelek.termek_id INNER JOIN marka ON termek.marka_id = marka.id";
$stmt = $conn->prepare($kosar_sql);
$stmt->execute();
$result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

$sql = "UPDATE felhasznalo SET email = '".$_POST['rendeles_email']."', nev = '".$_POST['rendeles_nev']."', telefonszam = '".$_POST['rendeles_telefonszam']."', cim = '".$_POST['rendeles_cim']."', varos = '".$_POST['rendeles_varos']."', iranyitoszam = '".$_POST['rendeles_iranyitoszam']."' WHERE id = $user_id";
mysqli_query($conn, $sql);

$osszeg = 0;
foreach($result as $item){
    $osszeg += $item['ar'] * $item['darab'];
}
$osszeg += 1290;

$fizetes_tipus = $_POST['fizetes_tipus'];

switch ($fizetes_tipus) {
    case 'fizetes-card':
        $fizetes_szoveg = 'Bankkártyás fizetés';
        break;
    case 'fizetes-cash':
        $fizetes_szoveg = 'Készpénzes fizetés';
        break;
    default:
        $fizetes_szoveg = 'Ismeretlen';
}

$stmt = $conn->prepare("INSERT INTO rendeles (felhasznalo_id, osszeg, fizetes_modja) VALUES (?, ?, ?)");
$stmt->bind_param("iis", $user_id, $osszeg, $fizetes_szoveg);
$stmt->execute();
$rendeles_id = $conn->insert_id;

foreach($result as $item){
    $stmt = $conn->prepare("INSERT INTO rendeles_tetel (rendeles_id, termek_id, mennyiseg) VALUES (?, ?, ?)");
    $stmt->bind_param("iii", $rendeles_id, $item['termekId'], $item['darab']);
    $stmt->execute();
}

$_SESSION['utolso_rendeles_id'] = $rendeles_id;

$torles_sql = "DELETE FROM
    `kosar_tetelek`
WHERE
    kosar_id IN(
    SELECT
        id
    FROM
        kosarak
    WHERE
        felhasznalo_id = ?
)";
$stmt = $conn->prepare($torles_sql);
$stmt->bind_param("i", $user_id); // Bind the parameter
$stmt->execute();

include "pdf.php";

$rendeles_sql = "SELECT
    *
FROM
    `rendeles`
INNER JOIN rendeles_tetel ON rendeles_tetel.rendeles_id = rendeles.id
WHERE rendeles_tetel.rendeles_id = ?";
$stmt->bind_param("i", $rendeles_id); // Bind the parameter
$stmt->execute();
$result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

$datum=date_parse($result[0]['datum']);
$kod=substr($datum['year'],2).sprintf('%02d', $datum['month']).sprintf('%02d', $datum['day']).sprintf('%02d', $datum['hour']).sprintf('%02d', $datum['minute']).sprintf('%02d', $datum['second']);

$mail = require __DIR__ . "/mailer.php";

$mail->setFrom("noreply@nile.hu");
$mail->addAddress($_POST['rendeles_email']);
$mail->Subject = "Sikeres rendelés";

// Példa szállítási dátum generálása
$szallitasdatum = date('Y-m-d', strtotime($result[0]['datum'] . ' +1 week'));

// Email tartalom összeállítása
$emailBody = <<<END
<html>
<body>
    <h2>Köszönjük, hogy a Nile-nál rendeltél!</h2>
    <p>A rendelésed (<strong>#NILE-$kod</strong>) feldolgoztuk, és úton van a csomagszállító partnerünkhöz.</p>
    <p><strong>Várható szállítási idő:</strong> $szallitasdatum</p>
    <p><strong>Fizetés módja:</strong>$fizetes_szoveg</p>
    <hr>
    <h3>Rendelésed részletei:</h3>
    <table style="width:100%;border-collapse:collapse;">
        <tr style="background-color:#f0f0f0;">
            <th style="padding:8px;border:1px solid #ddd;">Termék neve</th>
            <th style="padding:8px;border:1px solid #ddd;">Egységár</th>
            <th style="padding:8px;border:1px solid #ddd;">Mennyiség</th>
            <th style="padding:8px;border:1px solid #ddd;">Összesen</th>
        </tr>
END;

$vegosszeg = 0;

foreach($result as $item) {
    $termekOssz = $item['ar'] * $item['mennyiseg'];
    $vegosszeg += $termekOssz;

    $emailBody .= <<<ITEM
        <tr>
            <td style="padding:8px;border:1px solid #ddd;text-align:center;">{$item['tnev']}</td>
            <td style="padding:8px;border:1px solid #ddd;text-align:center;">{$item['ar']} Ft</td>
            <td style="padding:8px;border:1px solid #ddd;text-align:center;">{$item['mennyiseg']} db</td>
            <td style="padding:8px;border:1px solid #ddd;text-align:center;">$termekOssz Ft</td>
        </tr>
ITEM;
}

// Végösszeg szállítással együtt
$vegosszeg_szallitassal = $vegosszeg + 1290;

$emailBody .= <<<SUMMARY
        <tr style="font-weight:bold;">
            <td colspan="3" style="padding:8px;border:1px solid #ddd;text-align:right;">Szállítási költség:</td>
            <td style="padding:8px;border:1px solid #ddd;text-align:center;">1290 Ft</td>
        </tr>
        <tr style="font-weight:bold;">
            <td colspan="3" style="padding:8px;border:1px solid #ddd;text-align:right;">Összesen fizetendő:</td>
            <td style="padding:8px;border:1px solid #ddd;text-align:center;">$vegosszeg_szallitassal Ft</td>
        </tr>
    </table>
</body>
</html>
SUMMARY;

$mail->Body = $emailBody;
$mail->addAttachment($filepath, $filename);

try {
    $mail->send();

} catch (Exception $e) {

    echo "Message could not be sent. Mailer error: {$mail->ErrorInfo}";

}

$mail->addAttachment("szamalk/$filename", $filename);