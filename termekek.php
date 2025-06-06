<?php require "database/db_connect.php"; ?>
<div id="minden-cipo">
	<div id="cipo-termekek">
		<div id="filter">
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
						echo "	<input class='szures' name='marka-".$row['ceg']."' id='marka-".$row['ceg']."' value='".$row['ceg']."' type='checkbox'>";
						echo'	<label for="marka-'.$row['ceg'].'">'.$row['ceg'].'</label>';
						echo"</div>";
						$i++;
					}
				?>	
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
					<label for="ar-checkbox6">140 000 Ft felett</label>
				</div>
			</div>
			<button id="filter-gomb">Keres</button>
		</div>
		<div id="termekek-lista">
		</div>
	</div>
	<script src="termekek.js"></script>
</div>