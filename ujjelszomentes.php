<?php
    session_start();
    $id = $_SESSION['user_id'];
    require "database/db_connect.php";
    $sql = "SELECT * FROM felhasznalo WHERE id = '".$id."'";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();

    if(!empty($user)){
        $regijelszo=$_POST['regijelszo'];
        $ujjelszo=$_POST['ujjelszo'];
        $ujjelszoujra=$_POST['ujjelszoujra'];
        $mentettjelszo = $user['jelszo']; 

        if(password_verify($regijelszo, $mentettjelszo)){
            if(!password_verify($ujjelszo, $mentettjelszo)){
                if($ujjelszo == $ujjelszoujra){
                    $ujjelszo = password_hash($ujjelszo, PASSWORD_DEFAULT);
                    $mentes = "UPDATE felhasznalo SET jelszo = '$ujjelszo' WHERE id = $id";
                    if(mysqli_query($conn, $mentes)){
                        echo "Sikeres jelszó változtatás!";
                    }
                    else{
                        echo "Hiba: ".mysqli_error($conn);
                    }
                } else{
                    echo "Nem egyeznek a jelszavak";
                }
            } else{
                echo "Az új jelszó megegyezik a régivel.";
            }
            
        }else{
            echo "Nem egyezik a megadott jelszó a mentett jelszóval";
        }
    }

?>