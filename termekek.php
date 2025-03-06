<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="icon" type="image/x-icon" href="img/menu/favicon.ico" />
		<link
			href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
			rel="stylesheet"
		/>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
		<link rel="stylesheet" href="style/style.css" />
		<script src="script.js"></script>
		<title>Nile - Termékek</title>
	</head>
	<body>
		
		<div id="fejlec">
			<header id="fej">
				<div id="logo">
					<h2><a id="logo_link" href="index.php">Nile</a></h2>
				</div>
				<ul id="fej_tart">
					<li><a class="fej_link" href="friss.php">Új kiadás</a></li>
					<li><a class="fej_link" href="legkel.php">Legkelendőbbek</a></li>
					<li><a class="fej_link" href="#">Termékek</a></li>
				</ul>
				<div id="fej_tool">
					<img id="kosar" src="img/menu/kosar.png" alt="kosar" />
					<img id="profil" src="img/menu/icon.png" alt="ikon" />
				</div>
			</header>
		</div>

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
						<div id="kiem-div">
							<input id="kiemelt-radio" name="rendezes-radio" value="Kiemelt" type="radio">
							<label for="kiemelt-radio">Kiemelt</label>
						</div>
						<div id="alacsony-div">
							<input id="ar-alacsony" name="rendezes-radio" value="Ár (alacsony->magas)" type="radio">
							<label for="ar-alacsony">Ár (alacsony->magas)</label>
						</div>
						<div id="magas-div">
							<input id="ar-magas" name="rendezes-radio" value="Ár (magas->alacsony)" type="radio">
							<label for="ar-magas">Ár (magas->alacsony)</label>	
						</div>
					</div>
					<div id="rendezes-markak">
						<span id="marka-span" style="font-size: 24px; font-weight: bold;">Márkák</span>
					</div>
					<div id="rendezes-meret">
						<span id="meret-span" style="font-size: 24px; font-weight: bold;">Méret</span><br>
					</div>
					<div id="rendezes-ar">
						<span style="font-size: 24px; font-weight: bold;">Ár</span>
						<div>
							<input id="ar-checkbox1" type="checkbox">
							<label for="ar-checkbox1">20 000 Ft alatt</label>
						</div>
						<div>
							<input id="ar-checkbox2" type="checkbox">
							<label for="ar-checkbox2">20 000 Ft - 40 000 Ft</label>
						</div>
						<div>
							<input id="ar-checkbox3" type="checkbox">
							<label for="ar-checkbox3">40 000 Ft - 80 000Ft</label>
						</div>
						<div>
							<input id="ar-checkbox4" type="checkbox">
							<label for="ar-checkbox4">80 000 Ft - 100 000Ft</label>
						</div>
						<div>
							<input id="ar-checkbox5" type="checkbox">
							<label for="ar-checkbox5">100 000 Ft - 140 000Ft</label>
						</div>
						<div>
							<input id="ar-checkbox6" type="checkbox">
							<label for="ar-checkbox6">140 000Ft felett</label>
						</div>
					</div>
					<button onclick="teszt()">Teszt</button>
					<button onclick="ures()">ures</button>
					<input type="button" value="PHP" id="php">
				</div>
				<div id="termekek-lista">
					<!-- stuff -->
				</div>
			</div>
		</div>

		<div id="labfej">
			<footer></footer>
		</div>
		
	</body>
</html>
