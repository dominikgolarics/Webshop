<?php

//POST szűrés kezelés 

header("Content-type: application/json");
$host="localhost";
$pw="";
$user="root";
$dnmame="webshop";

//$conn= mysqli_connect($host,$user,$pw,$dnmame);

$pdo= new PDO('mysql:host=localhost;
               dbname=webshop;
               charset=utf8',
               $user,
               $pw);


$feltetelek=[];
$params=[];
$sql= "SELECT termek.id, nev, ar, megjelenes, raktaron, tipus.tipus AS tipus, marka.ceg AS marka, meret.meret AS meret
    FROM `termek` 
    INNER JOIN marka ON termek.marka_id = marka.id 
    INNER JOIN tipus ON termek.tipus_id = tipus.id 
    INNER JOIN meret ON termek.meret_id = meret.id"; //ALAP MINDEN

if(!$_SERVER['REQUEST_METHOD']=="GET"){
    $tomb=['hiba'=>"Nem jó"];
}
//Mindent vissza ad a termék táblából megfelelően
else if(isset($_GET['all'])){
    $sql= "SELECT termek.id, nev, ar, megjelenes, raktaron, tipus.tipus AS tipus, marka.ceg AS marka, meret.meret AS meret FROM `termek` INNER JOIN marka ON termek.marka_id = marka.id INNER JOIN tipus ON termek.tipus_id = tipus.id INNER JOIN meret ON termek.meret_id = meret.id
    "; //WHERE marka_id IN(1) AND meret_id IN(1) AND tipus_id IN(1)
}
else if(isset($_GET['arak'])){
    $arak = json_decode($_GET['arak'],true);
    $ar_leker=[];

    foreach($arak as $ar){
        if($ar === "under_20000"){ $ar_leker[]="ar < 20000"; }
        if($ar === "between_20000_40000"){ $ar_leker[]="ar BETWEEN 20000 AND 40000"; }
        if($ar === "between_40000_80000"){ $ar_leker[]="ar BETWEEN 40000 AND 80000"; }
        if($ar === "between_80000_100000"){ $ar_leker[]="ar BETWEEN 80000 AND 100000"; }
        if($ar === "between_100000_140000"){ $ar_leker[]="ar BETWEEN 100000 AND 140000"; }
        if($ar === "above_140000"){ $ar_leker[]="ar > 140000"; }
    }

    if(!empty($ar_leker)){
        $feltetelek[]="(" . implode(" OR ",$ar_leker) . ")"; 
    }
}
// else if(isset($_GET['markak'])){
//     $markak = json_decode($_GET['markak'],true);

//     $marka_leker=[];
//     foreach ($markak as $marka) {
//         $marka_leker[]="marka.ceg = ?";
//         $params[]=$marka;
//     }

//     if(!empty($marka_leker)){
//         $feltetelek[]= "(" . implode(" OR ", $marka_leker) . ")";
//     }
// }

else if(isset($_GET['markak'])){
    $markak = json_decode($_GET['markak'],true);

    $marka_leker=[];
    foreach ($markak as $marka) {
        if($marka=== "Nike"){$marka_leker[]=" marka.ceg = 'Nike'";}
        if($marka=== "Adidas"){$marka_leker[]=" marka.ceg = 'Adidas'";}
        if($marka=== "Puma"){$marka_leker[]=" marka.ceg = 'Puma'";}
        if($marka=== "Vans"){$marka_leker[]=" marka.ceg = 'Vans'";}
    }

    if(!empty($marka_leker)){
        $feltetelek[]= "(" . implode(" OR ", $marka_leker) . ")";
    }
}
if(!empty($feltetelek)){
    $sql.= " WHERE " . implode(" AND ",$feltetelek);
}

$stmt= $pdo->prepare($sql);
$stmt->execute($params);
$tomb=$stmt->fetchAll(PDO::FETCH_ASSOC);

$valasz = [
    'adat' => $tomb,
    'sql' => $sql,
    'paraméterek' => $feltetelek 
];

$json=json_encode($valasz,JSON_UNESCAPED_UNICODE);
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