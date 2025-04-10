<?php
header('Content-Type: application/json');

try {
    $json = file_get_contents('php://input');
    $filterek = json_decode($json);

    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception('Invalid JSON');
    }

    // ellenőrzés
    if (!is_array($filterek)) {
        http_response_code(400);
        echo json_encode([
            "error" => "nem jó bemenet",
            "dolgok" => $filterek
        ]);
        exit;
    }

    $mysqli = new mysqli("localhost", "root", "", "webshop");
    if ($mysqli->connect_error) {
        http_response_code(500);
        echo json_encode(["error" => "DB connection failed"]);
        exit;
    }

    $where = [];
    $params = [];
    $types = "";


    $sortDirection = array_shift($filterek);
    $validDirections = ['ASC', 'DESC'];
    $sort = in_array(strtoupper($sortDirection), $validDirections) ? strtoupper($sortDirection) : 'ASC';

    // filterek szortírozása
    $markaFilterek = [];
    $meretFilterek = [];
    $priceFilterek = [];

    foreach ($filterek as $filter) {
        if (str_starts_with($filter, '<')) {
            $priceFilterek[] = $filter;
        } elseif (is_numeric($filter)) {
            $meretFilterek[] = $filter;
        } else {
            $markaFilterek[] = $filter;
        }
    }

    // WHERE kezdete
    $where = [];

    // márka
    if (!empty($markaFilterek)) {
        $escapedBrands = array_map(function ($brand) use ($mysqli) {
            return "'" . $mysqli->real_escape_string($brand) . "'";
        }, $markaFilterek);
        $where[] = "marka.ceg IN (" . implode(",", $escapedBrands) . ")";
    }

    // méret
    if (!empty($meretFilterek)) {
        $escapedSizes = array_map(function ($size) use ($mysqli) {
            return (int)$size;
        }, $meretFilterek);
        $where[] = "meret.meret IN (" . implode(",", $escapedSizes) . ")";
    }

    // ár
    foreach ($priceFilterek as $filter) {
        if (str_starts_with($filter, '<')) {
            $price = (int) substr($filter, 1);
            $where[] = "ar < $price";
        } elseif (preg_match('/^\d+\s+\d+$/', $filter)) {
            list($min, $max) = explode(' ', $filter);
            $where[] = "(ar BETWEEN $min AND $max)";
        }
    }

    // SQL lekérés összetétele
    $sql = "SELECT termek.id, nev, ar, megjelenes, raktaron, tipus.tipus AS tipus, marka.ceg AS marka, meret.meret AS meret
    FROM `termek` 
    INNER JOIN marka ON termek.marka_id = marka.id 
    INNER JOIN tipus ON termek.tipus_id = tipus.id 
    INNER JOIN meret ON termek.meret_id = meret.id";
    if (!empty($where)) {
        $sql .= " WHERE " . implode(" AND ", $where);
    }

    $sql .= " ORDER BY ar $sort";

    // végső SQL log tesztelésre
    file_put_contents("query_log.txt", $sql);

    $stmt = $mysqli->prepare($sql);
    if ($params) {
        $stmt->bind_param($types, ...$params);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    $products = $result->fetch_all(MYSQLI_ASSOC);

    //adatok
    $valasz = [
        'adat' => $products,
        'sql' => $sql,
        'filterek' => $filterek
    ];

    file_put_contents("xd.txt", $sql);
    echo json_encode($valasz);
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}
?>


