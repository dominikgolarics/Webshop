<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	require "database/db_connect.php";

	$sql = sprintf(
		"SELECT * FROM felhasznalo WHERE felhasznalo_nev = '%s'",
		$conn->real_escape_string($_POST['uname'])
	);

	$result = $conn->query($sql);
	$user = $result->fetch_assoc();
	if ($user) {
		if (password_verify($_POST['psw'], $user['jelszo'])) {
			$_SESSION["user_id"] = $user["id"];

			$_SESSION["sikeres_bejelentkezes"] = true;
			header("Location: /".$_GET['page']);
			unset($_POST['uname']);
			exit;
		}
	}
}
	$kulonOldal = (isset($_GET['page']) && ($_GET['page'] === 'regisztracio' || $_GET['page'] === 'elfelejtettjelszo')) ;
	unset($_POST['uname']);
?>

<!DOCTYPE html>
<html lang="hu">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="/style/style.css" />
		<link rel="icon" type="image/x-icon" href="/img/menu/favicon.ico" />
		<link
			href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
			rel="stylesheet"
		/>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
		<title>Nile</title>
	</head>
  <div id="cart-dropdown" class="cart-hidden">
    <h4>Kosár tartalma</h4>
    <ul class="cart-items">
      <li>
        <img src="/img/cipo/21A282-100_Tenis-Asics-Gel-Kayano-5-OG-Masculino-Multicolor.jpg" alt="Termék" />
        <div class="item-info">
          <p>Termék neve</p>
          <small>Ár: 25.000 Ft</small>
        </div>
        <span class="remove-item">&times;</span>
      </li>
      <li>
        <img src="/img/cipo/21A282-100_Tenis-Asics-Gel-Kayano-5-OG-Masculino-Multicolor.jpg" alt="Termék" />
        <div class="item-info">
          <p>Másik termék</p>
          <small>Ár: 19.500 Ft</small>
        </div>
        <span class="remove-item">&times;</span>
      </li>
    </ul>
    <a href="/kosar" class="btn btn-primary w-100 mt-2">Kosár megnyitása</a>
  </div>
	<body style="background-color: #fdf8e1">
	<?php
		$popup = isset($_SESSION['sikeres_bejelentkezes']) ? 'true' : 'false';
		$logoutPopup = isset($_SESSION['kijelentkezes_sikeres']) ? 'true' : 'false';
		unset($_SESSION['sikeres_bejelentkezes']);
		unset($_SESSION['kijelentkezes_sikeres']);
	?>
	<script>
		var sikeresBelepes = <?php echo $popup; ?>;
		var sikeresKijelentkezes = <?php echo $logoutPopup; ?>;
	</script>
		<div id="login">
			<div id="tartalom_login">
				<div id="login_header">BEJELENTKEZÉS<span id="close">&#10005</span></div>
				<div id="login_form">
					<form method="post" novalidate>
						<label id="uname_text" for="uname"><b>Felhasználónév</b></label>
						<br/>
						<input id="uname" type="text" name="uname"/>
						<br/>
						<label id="psw_text" for="psw"><b>Jelszó</b></label>
						<br/>
						<input id="psw" type="password" name="psw"/>
						<br>
						<button id="gomb">Login</button>
						<br/>
						<label for="register">Nincs fiókod? <a href="/regisztracio">Regisztrálj itt!</a></label>
						<br/>
						<a id="elf_psw" href="/elfelejtettjelszo">Elfelejtetted a jelszavad?</a>

				</form>
			</div>
		</div>
	</div>
	<input type="hidden" id="userId" value="<?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : ''; ?>">
	<?php if (!$kulonOldal): ?>
		<div id="fejlec">
			<header id="fej">
				<div id="logo">
					<h2><a id="logo_link" href="/">Nile</a></h2>
				</div>
				<ul id="fej_tart">
					<li><a class="fej_link" href="/friss">Új kiadás</a></li>
					<li><a class="fej_link" href="/termekek">Termékek</a></li>
				</ul>
				<div id="fej_tool" style="position: relative;">
					<div id="cart-icon-wrapper">
						<img id="kosar" src="/img/menu/kosar.png" alt="kosar" />
						<span id="cart-count">0</span> <!-- Set dynamically -->
					</div>
          <div id="profil-container">
					  <img id="profilicon" src="/img/menu/icon.png" alt="ikon" />
						<div id="dropdown">
							<a href="/profil/beallitasok">Profilom</a>
							<a href="/profil/rendelesek">Rendelések</a>
							<a href="/logout.php">Kijelentkezés</a>
						</div>
           </div>
				</div>
			</header>
		</div>
	<?php endif; ?>
	<?php
	if ($_GET['page'] == 'fooldal') {
		require 'home.php';
	} else if ($_GET['page'] == 'legkelendobbek') {
		require 'legkel.php';
	} else if ($_GET['page'] == 'friss') {
		require 'friss.php';
	} else if ($_GET['page'] == 'profil') {
		require 'profil.php';
	} else if ($_GET['page'] == 'regisztracio') {
		require 'register.php';
	} else if ($_GET['page'] == 'elfelejtettjelszo') {
		require 'elfelejtettjelszo.php';
	} else if ($_GET['page'] == 'termek') {
		require 'termek.php';
	}else if ($_GET['page'] == 'kosar') {
		require 'kosar.php';
	} else if ($_GET['page'] == 'termekek') {
		require 'termekek.php';
	}

	?>
	<?php if (!$kulonOldal): ?>
		<footer class="site-footer">
			<div class="footer-container">
				<!-- About Section -->
				<div class="footer-section">
					<h3>Boltunkról</h3>
					<p>2025 óta a prémium minőségű cipők egyablakos célpontja. A cipők legújabb trendjeit kínáljuk kivételes kényelemmel.</p>
				</div>

				<!-- Quick Links -->
				<div class="footer-section">
					<h3>Gyors elérés</h3>
					<ul>
						<li><a href="/">Kezdőlap</a></li>
						<li><a href="/termekek">Termékek</a></li>
					</ul>
				</div>

				<!-- Contact Info -->
				<div class="footer-section">
					<h3>Elérhetőségek</h3>
					<ul class="contact-info">
						<li><i class="fas fa-map-marker-alt"></i> Budapest, Timót u. 3, 1097</li>
						<li><i class="fas fa-phone"></i> +36 1 234 5678</li>
						<li><i class="fas fa-envelope"></i> info@nile.com</li>
					</ul>
				</div>

				<!-- Social Media -->
				<div class="footer-section">
					<h3>Kövess minket!</h3>
					<div class="social-links">
						<a href="#"><i class="fab fa-facebook"></i></a>
						<a href="#"><i class="fab fa-instagram"></i></a>
						<a href="#"><i class="fab fa-twitter"></i></a>
					</div>
				</div>
			</div>
			<!-- Copyright -->
			<div class="copyright">
				<p>&copy; 2025 Nile. Minden jog fenntartva.</p>
			</div>
		</footer>
	<?php endif; ?>
	<script src="/script.js"></script>
</body>

</html>