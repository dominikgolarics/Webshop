<?php
session_start();
require "database/db_connect.php";
require_once 'pdf_generalas.php';

$rend_id=$_SESSION['utolso_rendeles_id'];

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
    rendeles.datum
FROM `rendeles`
INNER JOIN rendeles_tetel ON rendeles_tetel.rendeles_id = rendeles.id
INNER JOIN termek ON termek.id = rendeles_tetel.termek_id
INNER JOIN felhasznalo on rendeles.felhasznalo_id = felhasznalo.id
WHERE rendeles_tetel.rendeles_id = ?"); // Parameter placeholder

$stmt->bind_param("i", $rend_id); // Bind the parameter
$stmt->execute();
$result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

$datum=date_parse($result[0]['datum']);
$kod=substr($datum['year'],2).sprintf('%02d', $datum['month']).sprintf('%02d', $datum['day']).sprintf('%02d', $datum['hour']).sprintf('%02d', $datum['minute']).sprintf('%02d', $datum['second']);

$orderData = [
    'order_id' => 'NILE-'.$kod,
    'order_date' => date('Y-m-d H:i:s'),
    'customer' => [
        'name' => $result[0]['fnev'],
        'email' => $result[0]['email'],
        'phone' => $result[0]['telefonszam'],
        'address' => $result[0]['iranyitoszam']." ".$result[0]['varos'].", ".$result[0]['cim']
    ],
    'items' => [],
    'subtotal' => 0,
    'shipping' => 1290,
    'total' => 0
];

$osszeg=0;
foreach($result as $item) {
    $orderData['items'][] = [
        'name' => $item['tnev'],
        'price' => $item['ar'],
        'quantity' => $item['mennyiseg']
    ];
    
    // Calculate running totals
    $orderData['subtotal'] += $item['ar'] * $item['mennyiseg'];
    $osszeg+=$item['ar'] * $item['mennyiseg'];
}

$osszeg+=1290;
$orderData['total']=$osszeg;

// $orderData['customer']['name']=;
// $orderData['customer']['name']=;
// $orderData['customer']['name']=;
// $orderData['customer']['name']=;

$companyInfo = [
    'name' => 'Nile',
    'address' => 'Budapest, Timót u. 3, 1097',
    'phone' => '+36 1 234 5678',
    'email' => 'info@nile.com'
];
//print_r($result);
//echo "<br>";
//print_r($orderData);


// Generate the PDF
$pdfGenerator = new ReceiptGenerator($orderData, $companyInfo);
$pdfContent = $pdfGenerator->generate();

// Save to file or send to browser
header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="receipt_'.$orderData['order_id'].'.pdf"');
echo $pdfContent;
?>