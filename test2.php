<?php
header('Content-Type: application/json');

$mysqli = new mysqli("localhost", "root", "", "webshop");
if ($mysqli->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => "DB connection failed"]);
    exit;
}

$sql = "SELECT termek.id, nev, ar, megjelenes, raktaron, tipus.tipus AS tipus, marka.ceg AS marka, meret.meret AS meret
    FROM `termek` 
    INNER JOIN marka ON termek.marka_id = marka.id 
    INNER JOIN tipus ON termek.tipus_id = tipus.id 
    INNER JOIN meret ON termek.meret_id = meret.id";

$where = [];
$params = [];
$types = '';
$rend = "ASC";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ar = $_POST['ar'] ?? [];
    $meret = $_POST['meret'] ?? [];
    $rend = $_POST['rend'] ?? "ASC";
    $marka = $_POST['marka'] ?? [];
    
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
        $escapedBrands = array_map(function ($brand) use ($mysqli) {
            return "'" . $mysqli->real_escape_string($brand) . "'";
        }, $marka);
        $where[] = "marka.ceg IN (" . implode(",", $escapedBrands) . ")";
    }

    if (!empty($where)) {
        $sql .= " WHERE " . implode(" AND ", $where);
    }

    // RENDEZÉS
    if (in_array(strtoupper($rend), ['ASC', 'DESC'])) {
        $sql .= " ORDER BY ar " . strtoupper($rend);
    }

    // LEKÉRDEZÉS
    $result = $mysqli->query($sql);
    if ($result) {
        $products = $result->fetch_all(MYSQLI_ASSOC);
        $response = [
            'adat' => $products,
            'sql' => $sql
        ];
    } else {
        $response['error'] = "Query error: " . $mysqli->error;
    }
} else {
    $response['error'] = "Érvénytelen kérés!";
}

echo json_encode($response, JSON_UNESCAPED_UNICODE);
