<?php

require "database/db_connect.php";

$sql = "SELECT 
            termek.id, 
            termek.nev, 
            termek.ar, 
            termek.megjelenes, 
            termek.raktaron, 
            tipus.tipus AS tipus, 
            marka.ceg AS marka, 
            meret.meret AS meret,
            GROUP_CONCAT(cipokepek.url SEPARATOR '|||') AS kepek
        FROM `termek` 
        INNER JOIN marka ON termek.marka_id = marka.id 
        INNER JOIN tipus ON termek.tipus_id = tipus.id 
        INNER JOIN meret ON termek.meret_id = meret.id
        LEFT JOIN cipokepek ON termek.id = cipokepek.cipoID
		GROUP BY termek.id";

$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

foreach ($result as &$cipo) {
    $cipo['kepek'] = !empty($cipo['kepek']) ? explode('|||', $cipo['kepek']) : ['images/no-image.jpg'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
	<div id="logos">
		<div class="logos-slide">
			<img class="mozgo_logo" src="img/marka/Adidas.png" alt="Logo 1" />
			<img class="mozgo_logo" src="img/marka/Asics.png" alt="Logo 2" />
			<img class="mozgo_logo" src="img/marka/Bata.png" alt="Logo 3" />
			<img class="mozgo_logo" src="img/marka/Columbia.png" alt="Logo 4" />
			<img class="mozgo_logo" src="img/marka/Converse.png" alt="Logo 5" />
			<img class="mozgo_logo" src="img/marka/Dr.-Martens.png" alt="" />
			<img class="mozgo_logo" src="img/marka/Droors-Clothing.png" alt="" />
			<img class="mozgo_logo" src="img/marka/FILA.png" alt="" />
			<img class="mozgo_logo" src="img/marka/Jordan.png" alt="" />
			<img class="mozgo_logo" src="img/marka/Kappa.png" alt="" />
			<img class="mozgo_logo" src="img/marka/Lacoste.png" alt="" />
			<img class="mozgo_logo" src="img/marka/Lotto.png" alt="" />
			<img class="mozgo_logo" src="img/marka/Merrell.png" alt="" />
			<img class="mozgo_logo" src="img/marka/New-Balance.png" alt="" />
			<img class="mozgo_logo" src="img/marka/Nike.png" alt="" />
			<img class="mozgo_logo" src="img/marka/Puma.png" alt="" />
			<img class="mozgo_logo" src="img/marka/Reebok.png" alt="" />
			<img class="mozgo_logo" src="img/marka/Saucony.png" alt="" />
			<img class="mozgo_logo" src="img/marka/Skechers.png" alt="" />
			<img class="mozgo_logo" src="img/marka/The-North-Face.png" alt="" />
			<img class="mozgo_logo" src="img/marka/Timberland.png" alt="" />
			<img class="mozgo_logo" src="img/marka/Toms.png" alt="" />
			<img class="mozgo_logo" src="img/marka/Ugg.png" alt="" />
			<img class="mozgo_logo" src="img/marka/Umbro.png" alt="" />
			<img class="mozgo_logo" src="img/marka/Under-Armour.png" alt="" />
			<img class="mozgo_logo" src="img/marka/Vans.png" alt="" />
			<img class="mozgo_logo" src="img/marka/Wilson.png" alt="" />
		</div>
		<div class="logos-slide">
			<img class="mozgo_logo" src="img/marka/Adidas.png" alt="Logo 1" />
			<img class="mozgo_logo" src="img/marka/Asics.png" alt="Logo 2" />
			<img class="mozgo_logo" src="img/marka/Bata.png" alt="Logo 3" />
			<img class="mozgo_logo" src="img/marka/Columbia.png" alt="Logo 4" />
			<img class="mozgo_logo" src="img/marka/Converse.png" alt="Logo 5" />
			<img class="mozgo_logo" src="img/marka/Dr.-Martens.png" alt="" />
			<img class="mozgo_logo" src="img/marka/Droors-Clothing.png" alt="" />
			<img class="mozgo_logo" src="img/marka/FILA.png" alt="" />
			<img class="mozgo_logo" src="img/marka/Jordan.png" alt="" />
			<img class="mozgo_logo" src="img/marka/Kappa.png" alt="" />
			<img class="mozgo_logo" src="img/marka/Lacoste.png" alt="" />
			<img class="mozgo_logo" src="img/marka/Lotto.png" alt="" />
			<img class="mozgo_logo" src="img/marka/Merrell.png" alt="" />
			<img class="mozgo_logo" src="img/marka/New-Balance.png" alt="" />
			<img class="mozgo_logo" src="img/marka/Nike.png" alt="" />
			<img class="mozgo_logo" src="img/marka/Puma.png" alt="" />
			<img class="mozgo_logo" src="img/marka/Reebok.png" alt="" />
			<img class="mozgo_logo" src="img/marka/Saucony.png" alt="" />
			<img class="mozgo_logo" src="img/marka/Skechers.png" alt="" />
			<img class="mozgo_logo" src="img/marka/The-North-Face.png" alt="" />
			<img class="mozgo_logo" src="img/marka/Timberland.png" alt="" />
			<img class="mozgo_logo" src="img/marka/Toms.png" alt="" />
			<img class="mozgo_logo" src="img/marka/Ugg.png" alt="" />
			<img class="mozgo_logo" src="img/marka/Umbro.png" alt="" />
			<img class="mozgo_logo" src="img/marka/Under-Armour.png" alt="" />
			<img class="mozgo_logo" src="img/marka/Vans.png" alt="" />
			<img class="mozgo_logo" src="img/marka/Wilson.png" alt="" />
		</div>
	</div>
	
	<div id="tartalom">
		<div id="nepszeru">
			<h2 id="nepszeru-title">MOST FELKAPOTT</h2>
			<!-- 4 felkapott cipő adatbázisbó -->
			<?php
				echo '<div id="cipo-container">';
					for ($i=0; $i < 4; $i++) {
						//egyszerű if ha lesz trending oszlop az adatbázisban 
						$shoe = $result[$i];
						$firstImage = $shoe['kepek'][0]; // Always safe due to the fallback above
						echo '<div class="cipo-termek" id="cipoId-' . $shoe['id'] . '">';
							echo '<img class="cipo-kep" src="' . htmlspecialchars($firstImage) . '"/>';
							echo '<div class="cipo-leiras">';
							echo '<h3 class="leiras-h3">' . htmlspecialchars($shoe['marka']) . '</h3>';
							echo '<span class="leiras-span">' . htmlspecialchars($shoe['nev']) . '</span>';
							echo '<h5 class="leiras-h5">' . htmlspecialchars($shoe['ar']) . '</h5>';
							echo '</div>';
						echo '</div>';
					}
				echo '</div>';
			?>
		</div>
		<div id="friss">
			<h2 id="nepszeru-title">FRISS TERMÉKEK</h2>
			<?php
			echo '<div id="cipo-container">';
				usort($result,function($a,$b){
					return strtotime($b['megjelenes']) - strtotime($a['megjelenes']);
				});
				$leg_frissebb_cipok=array_slice($result,0,4);
				foreach($leg_frissebb_cipok as $cipo){
					$firstImage = !empty($cipo['kepek'][0]) ? $cipo['kepek'][0] : 'images/no-image.jpg';
					echo '<div class="cipo-termek" id="cipoId-' . $cipo['id'] . '">';
						echo '<img class="cipo-kep" src="' . htmlspecialchars($firstImage) . '"/>';
						echo '<div class="cipo-leiras">';
						echo '<h3 class="leiras-h3">' . htmlspecialchars($cipo['marka']) . '</h3>';
						echo '<span class="leiras-span">' . htmlspecialchars($cipo['nev']) . '</span>';
						echo '<h5 class="leiras-h5">' . htmlspecialchars($cipo['ar']) . '</h5>';
						echo '</div>';
					echo '</div>';
				}
			echo '</div>';
			?>
		</div>
</body>
</html>