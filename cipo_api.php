<?php
require "database/db_connect.php";
header('Content-Type: application/json');

$sql = "SELECT 
    termek.id, 
    termek.nev, 
    termek.ar, 
    termek.megjelenes, 
    termek.raktaron, 
    tipus.tipus AS tipus, 
    marka.ceg AS marka, 
    meret.meret AS meret,
    (SELECT cipokepek.url 
     FROM cipokepek 
     WHERE cipokepek.cipoID = termek.id 
     LIMIT 1) AS elso_kep
FROM `termek` 
INNER JOIN marka ON termek.marka_id = marka.id 
INNER JOIN tipus ON termek.tipus_id = tipus.id 
INNER JOIN meret ON termek.meret_id = meret.id";

$where = [];
$params = [];
$types = '';
//$rend = "ASC";
$filterek=[];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ar = $_POST['ar'] ?? [];
    $meret = $_POST['meret'] ?? [];
    $rend = $_POST['rend'] ?? null;
    $marka = $_POST['marka'] ?? [];

    $filterek['ar']=$ar;
    $filterek['meret']=$meret;
    $filterek['rend']=$rend;
    $filterek['marka']=$marka;
    
    // ÁRAK
    if (!empty($ar)) {
        $priceConditions = [];
        foreach ($ar as $filter) {
            if (str_starts_with($filter, '<')) {
                $price = (int) substr($filter, 1);
                $priceConditions[] = "ar < $price";
            } elseif (preg_match('/^\d+\s+\d+$/', $filter)) {
                list($min, $max) = explode(' ', $filter);
                $priceConditions[] = "ar BETWEEN $min AND $max";
            }
        }
        if (!empty($priceConditions)) {
            $where[] = "(" . implode(" OR ", $priceConditions) . ")";
        }
    }

    // MÉRET
    if (!empty($meret)) {
        $escapedSizes = array_map('intval', $meret);
        $where[] = "meret.meret IN (" . implode(",", $escapedSizes) . ")";
    }

    // MÁRKA
    if (!empty($marka)) {
        $escapedBrands = array_map(function ($brand) use ($conn) {
            return "'" . $conn->real_escape_string($brand) . "'";
        }, $marka);
        $where[] = "marka.ceg IN (" . implode(",", $escapedBrands) . ")";
    }

    if (!empty($where)) {
        $sql .= " WHERE " . implode(" AND ", $where);
    }

    // RENDEZÉS
    if (is_array($rend)) {
        $rend = $rend[0] ?? null;
    }

    if ($rend == 'ASC' || $rend == 'DESC') {
        $sql .= " ORDER BY ar " . $rend;
    }

    // LEKÉRDEZÉS
    $result = $conn->query($sql);
    if ($result) {
        $products = $result->fetch_all(MYSQLI_ASSOC);
        $response = [
            'adat' => $products,
            'sql' => [$sql],
            'filterek'=>$filterek
        ];
    } else {
        $response['error'] = "Query error: " . $conn->error;
    }
} else {
    $response['error'] = "Érvénytelen kérés!";
}

echo json_encode($response, JSON_UNESCAPED_UNICODE);

