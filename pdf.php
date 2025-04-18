<?php
require_once 'pdf_generalas.php';



$orderData = [
    'order_id' => 'NILE-'.rand(1,999),
    'order_date' => date('Y-m-d H:i:s'),
    'customer' => [
        'name' => '###',
        'email' => '###',
        'phone' => '###',
        'address' => '###'
    ],
    'items' => [
        // [
        //     'name' => 'Nike Air Max 95',
        //     'price' => 75000,
        //     'quantity' => 1
        // ],
    ],
    'subtotal' => $osszeg,
    'shipping' => 1290,
    'total' => $osszeg+1290
];

$orderData['items'][0]['name'];

$companyInfo = [
    'name' => 'Nile',
    'address' => 'Budapest, Timót u. 3, 1097',
    'phone' => '+36 1 234 5678',
    'email' => 'info@nile.com'
];

// Generate the PDF
$pdfGenerator = new ReceiptGenerator($orderData, $companyInfo);
$pdfContent = $pdfGenerator->generate();

// Save to file or send to browser
header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="receipt_'.$orderData['order_id'].'.pdf"');
echo $pdfContent;
?>