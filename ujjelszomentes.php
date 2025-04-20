<?php
    session_start();
    header('Content-Type: application/json');
    $id = $_SESSION['user_id'];
    require "database/db_connect.php";
    $sql = "SELECT * FROM felhasznalo WHERE id = '".$id."'";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();

    $response = [];

    if(!empty($user)){
        $regijelszo=$_POST['regijelszo'];
        $ujjelszo=$_POST['ujjelszo'];
        $ujjelszoujra=$_POST['ujjelszoujra'];
        $mentettjelszo = $user['jelszo']; 
        if (password_verify($regijelszo, $mentettjelszo)) {
            if (strlen($ujjelszo) < 8) {
                $response['message'] = "A jelszónak legalább 8 karakter hosszúnak kell lennie!";
            } elseif (!preg_match("/[A-Z]/", $ujjelszo)) {
                $response['message'] = "A jelszónak legalább egy nagybetűt tartalmaznia kell!";
            } elseif (!preg_match("/[0-9]/", $ujjelszo)) {
                $response['message'] = "A jelszónak legalább egy számot tartalmaznia kell!";
            } elseif ($ujjelszo !== $ujjelszoujra) {
                $response['message'] = "A jelszavaknak egyezniük kell!";
            } elseif (password_verify($ujjelszo, $mentettjelszo)) {
                $response['message'] = "Az új jelszó megegyezik a régivel.";    
            } else {
                $ujjelszo = password_hash($ujjelszo, PASSWORD_DEFAULT);
                $mentes = "UPDATE felhasznalo SET jelszo = '$ujjelszo' WHERE id = $id";
                if (mysqli_query($conn, $mentes)) {
                    $response['success'] = true;
                    $response['message'] = "A jelszó sikeresen frissítve!";
                } else {
                    $response['message'] = "Hiba a mentés során: " . mysqli_error($conn);
                }
            }
        } else {
            $response['message'] = "Nem egyezik a megadott jelszó a mentett jelszóval.";
        }
    }
    echo json_encode($response, JSON_UNESCAPED_UNICODE);
?>