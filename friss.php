<?php
require "database/db_connect.php";
$iden = date("Y")."%"; //idei év + "%" sql lekéréshez
$sql="SELECT 
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
INNER JOIN meret ON termek.meret_id = meret.id
WHERE megjelenes LIKE '$iden' ORDER by megjelenes DESC";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
?>
<h1 id="friss-h1">Idei termékek!</h1>	
<div id="friss-tart">
	
	<div id="cipo-container">
		<?php
		for ($i=0; $i < count($result); $i++) { 
			echo '<div class="cipo-termek" id="cipoId-' . $result[$i]['id'] . '">';
				echo '<img class="cipo-kep" src="/' . htmlspecialchars($result[$i]['elso_kep']) . '"/>';
				echo '<div class="cipo-leiras">';
				echo '<h3 class="leiras-h3">' . htmlspecialchars($result[$i]['marka']) . '</h3>';
				echo '<span class="leiras-span">' . htmlspecialchars($result[$i]['nev']) . '</span>';
				echo '<h5 class="leiras-h5">' . htmlspecialchars($result[$i]['ar']) . ' FT</h5>';
				echo '<span class="leiras-datum">'.htmlspecialchars($result[$i]['megjelenes']).'</span>';
				echo '</div>';
			echo '</div>';
		}
		?>
	</div>
</div>
