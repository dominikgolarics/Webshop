<?php
header("Content-type: application/json; charset=utf-8");
$host="localhost";
$pw="";
$user="root";
$dnmame="webshop";

$conn= mysqli_connect($host,$user,$pw,$dnmame);

$ered=[];
if(!$_SERVER['REQUEST_METHOD']=="get"){
    $tomb=['hiba'=>"Nem jó"];
}else if(isset($_GET['all'])){
    $sql= "SELECT termek.id, nev, ar, megjelenes, raktaron, tipus.tipus AS tipus, marka.ceg AS marka, meret.meret AS meret
    FROM `termek` 
    INNER JOIN marka ON termek.marka_id = marka.id 
    INNER JOIN tipus ON termek.tipus_id = tipus.id 
    INNER JOIN meret ON termek.meret_id = meret.id
    "; //WHERE marka_id IN(1) AND meret_id IN(1) AND tipus_id IN(1)
    $result=$conn->query($sql);
    while ($row=$result->fetch_assoc()) {
        $ered[]=$row;
    }
    $tomb=[
        'data'=>$ered
    ];
}else if(isset($_GET['filter'])){
    $sql= "SELECT termek.id, nev, ar, megjelenes, raktaron, tipus.tipus AS tipus, marka.ceg AS marka, meret.meret AS meret
    FROM `termek` 
    INNER JOIN marka ON termek.marka_id = marka.id 
    INNER JOIN tipus ON termek.tipus_id = tipus.id 
    INNER JOIN meret ON termek.meret_id = meret.id
    WHERE ar BETWEEN 20000 AND 40000"; //WHERE marka_id IN(1) AND meret_id IN(1) AND tipus_id IN(1)
    $result=$conn->query($sql);
    while ($row=$result->fetch_assoc()) {
        $ered[]=$row;
    }
    $tomb=[
        'data'=>$ered
    ];
}
$json=json_encode($tomb,JSON_UNESCAPED_UNICODE);
print($json);


//* SELECT termek.id, nev, ar, megjelenes, raktaron, tipus.tipus AS tipus, marka.ceg AS marka, meret.meret AS meret FROM `termek` INNER JOIN marka ON termek.marka_id = marka.id INNER JOIN tipus ON termek.tipus_id = tipus.id INNER JOIN meret ON termek.meret_id = meret.id WHERE marka_id IN(1, 2) AND meret_id IN(1) AND tipus_id IN(1); 

// SELECT
//     termek.id,
//     nev,
//     ar,
//     megjelenes,
//     raktaron,
//     tipus.tipus AS tipus,
//     marka.ceg AS marka,
//     meret.meret AS meret
// FROM
//     `termek`
// INNER JOIN marka ON termek.marka_id = marka.id
// INNER JOIN tipus ON termek.tipus_id = tipus.id
// INNER JOIN meret ON termek.meret_id = meret.id
// WHERE
//     marka_id IN(1, 2) //!Lekér mindent ahol a marka_id megeggyezik a ()-ben lévő számok(id)kal
//     AND meret_id IN(1) 
//     AND tipus_id IN(1);