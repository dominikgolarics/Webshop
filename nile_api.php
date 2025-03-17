<?php
header("Content-Type: application/json");

$host = 'localhost';
$db   = 'webshop';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    // Create a PDO instance (connect to the database)
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    echo json_encode(['error' => 'Database connection failed: ' . $e->getMessage()]);
    exit;
}

// Handle the request
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        $stmt = $pdo->query('SELECT * FROM termek');
        $users = $stmt->fetchAll();
        echo json_encode($users);
    } catch (\PDOException $e) {
        echo json_encode(['error' => 'Failed to fetch data: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
}

// // Database configuration
// $host = 'localhost';
// $db   = 'webshop';
// $user = 'root';
// $pass = '';
// $charset = 'utf8mb4';

// $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
// $options = [
//     PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
//     PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
//     PDO::ATTR_EMULATE_PREPARES   => false,
// ];

// try {
//     // Create a PDO instance (connect to the database)
//     $pdo = new PDO($dsn, $user, $pass, $options);
// } catch (\PDOException $e) {
//     echo json_encode(['error' => 'Database connection failed: ' . $e->getMessage()]);
//     exit;
// }

//-----------------------------------------

// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "webshop";

// try {
//   $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
//   // set the PDO error mode to exception
//   $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//   //echo "Connected successfully";
// } catch(PDOException $e) {
//   echo "Connection failed: " . $e->getMessage();
// }