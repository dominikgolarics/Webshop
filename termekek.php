<?php require "database/db_connect.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="icon" type="image/x-icon" href="img/menu/favicon.ico" />
	<link
		href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
		rel="stylesheet" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<link rel="stylesheet" href="style/style.css" />
	<script src="script.js"></script>
	<script src="termekek.js"></script>
	<title>Nile - Termékek</title>
</head>

<body>
	<div id="minden-cipo">
		<div id="cipo-termekek">
			<div id="filter">

				<!-- <div id="rendezes-darab">
						<label for="">Darab termék</label>
						<select onchange="termekekDarab()" name="mennyiseg" id="mennyiseg">
							<option value="16">16</option>
							<option value="24">24</option>
							<option value="40">40</option>
						</select>
					</div> -->

				<div id="rendezes-sorrend">
					<span id="sorrend-span" style="font-size: 24px; font-weight: bold;">Rendezés</span>
					<div id="alacsony-div">
						<input class="szures" id="rend-alacsony" name="rendezes-radio" value="ASC" type="radio">
						<label for="ar-alacsony">Ár (alacsony->magas)</label>
					</div>
					<div id="magas-div">
						<input class="szures" id="rend-magas" name="rendezes-radio" value="DESC" type="radio">
						<label for="ar-magas">Ár (magas->alacsony)</label>
					</div>
				</div>
				<div id="rendezes-markak">
					<span id="marka-span" style="font-size: 24px; font-weight: bold;">Márkák</span>
					<?php
						$sql= "SELECT * FROM marka"; //WHERE marka_id IN(1) AND meret_id IN(1) AND tipus_id IN(1)
						$result=$conn->query($sql);
						$i=0;
						while ($row=$result->fetch_assoc()) {
							echo "<div>";
							echo "	<input class='szures' id='marka-".$row['ceg']."' value='".$row['ceg']."' type='checkbox'>";
							echo'	<label for="marka-checkbox1">'.$row['ceg'].'</label>';
							echo"</div>";
							$i++;
						}
					?>	
				</div>
				<div id="rendezes-meret">
					<span id="meret-span" style="font-size: 24px; font-weight: bold;">Méret</span><br>
					<div  style='display: flex; flex-wrap:wrap;'>
					<?php
						$sql= "SELECT * FROM meret"; //WHERE marka_id IN(1) AND meret_id IN(1) AND tipus_id IN(1)
						$result=$conn->query($sql);
						$i=0;
						while ($row=$result->fetch_assoc()) {
							echo "<div style='flex: 0 0 calc(33.33% - 10px)'>";
							echo "	<input class='szures' id='meret-".$row['meret']."' value='".$row['meret']."' type='checkbox'>";
							echo'	<label for="meret-checkbox1">'.$row['meret'].'</label>';
							echo"</div>";
							$i++;
						}
					?>
					</div>
				</div>
				<div id="rendezes-ar">
					<span style="font-size: 24px; font-weight: bold;">Ár</span>
					<div>
						<input class='szures' id="ar-checkbox1" value="<20000" type="checkbox">
						<label for="ar-checkbox1">20 000 Ft alatt</label>
					</div>
					<div>
						<input class='szures' id="ar-checkbox2" value="20000 40000" type="checkbox">
						<label for="ar-checkbox2">20 000 Ft - 40 000 Ft</label>
					</div>
					<div>
						<input class='szures' id="ar-checkbox3" value="40000 80000" type="checkbox">
						<label for="ar-checkbox3">40 000 Ft - 80 000Ft</label>
					</div>
					<div>
						<input class='szures' id="ar-checkbox4" value="80000 100000" type="checkbox">
						<label for="ar-checkbox4">80 000 Ft - 100 000Ft</label>
					</div>
					<div>
						<input class='szures' id="ar-checkbox5" value="100000 140000" type="checkbox">
						<label for="ar-checkbox5">100 000 Ft - 140 000Ft</label>
					</div>
					<div>
						<input class='szures' id="ar-checkbox6" value=">140000" type="checkbox">
						<label for="ar-checkbox6">140 000Ft felett</label>
					</div>
				</div>
				<button id="kuldTest">Keres</button>
			</div>
			<div id="termekek-lista">
				<!-- //xd -->
			</div>
		</div>
	</div>

	<div id="labfej">
		<footer></footer>
	</div>

</body>

</html>