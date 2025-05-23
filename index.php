<?php
	session_start();
	require "database/db_connect.php";
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
		rel="stylesheet" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<title>Nile</title>
</head>

<body style="background-color: #fdf8e1">
	<div id="torles-uzenet">A fiókodat sikeresen töröltük.</div>
<?php
	if (isset($_SESSION['torles_sikeres']) && $_SESSION['torles_sikeres']) {
		echo '<script>
			document.addEventListener("DOMContentLoaded", function() {
				const uzi = document.getElementById("torles-uzenet");
				if (uzi) {
					uzi.style.display = "block";
					setTimeout(() => { uzi.style.display = "none"; }, 3000);
				}
			});
		</script>';
		unset($_SESSION['torles_sikeres']);
	}
?>
<?php if (isset($_SESSION['reg_success'])): ?>
	<div id="popup-reg">
		✅ Sikeres regisztráció!
	</div>
	<?php unset($_SESSION['reg_success']); ?>
<?php endif; ?>

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
	<div id="cart-dropdown" class="cart-hidden">
		<h4>Kosár tartalma</h4>
		<ul class="cart-items">
			<?php
				if(isset($_SESSION['user_id'])){
					$uid=$_SESSION['user_id'];
					$sql = "SELECT *, ( SELECT cipokepek.url FROM cipokepek WHERE cipokepek.cipoID = termek.id LIMIT 1 ) AS elso_kep FROM `kosarak` INNER JOIN kosar_tetelek ON kosarak.id = kosar_tetelek.kosar_id INNER JOIN termek ON termek.id = kosar_tetelek.termek_id WHERE kosarak.felhasznalo_id=$uid";
					$stmt = $conn->prepare($sql);
					$stmt->execute();
					$result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

					$osszeg = 0;

					foreach($result as $cipo){
						echo '<li data-termek-id="'.$cipo['id'].'" data-cipo-ar="'.$cipo['ar'].'" data-cipo-darab="'.$cipo['mennyiseg'].'">';
							echo '<img src="/'.$cipo['elso_kep'].'">';
							echo '<div class="item-info">';
								echo '<p>'.$cipo['nev'].'</p>';
								echo '<small>Ár: <span>'.$cipo['ar'].'</span> Ft/db</small><br>';
								echo '<small>Mennyiség: <span>'.$cipo['mennyiseg'].'</span> db</small>';
							echo '</div>';
							echo '<span class="remove-item">&times;</span>';
						echo '</li>';

						$osszeg += $cipo['ar'] * $cipo['mennyiseg'];
					}

					echo '<li class="kosar-osszeg" style="text-align:right; font-weight:bold; padding-top:10px;">';
					echo 'Összesen: <span id="cipo-small-osszeg">'.$osszeg.'</span> Ft';
					echo '</li>';
				}else{
					echo "";
				}
			?>
		</ul>
		<a href="/kosar" class="btn btn-primary w-100 mt-2">Kosár megnyitása</a>
	</div>
	<div id="login">
		<div id="tartalom_login">
			<div id="login_header">BEJELENTKEZÉS<span id="close">&#10005</span></div>
			<div id="login_form">
				<form method="post" novalidate>
					 <div class="inputok">
						<label id="uname_text" for="uname"><b>Felhasználónév</b></label>
						<br>
						<input id="uname" type="text" name="uname" />
						<br>
						<span class="hiba-jelzes" id="uname_hiba">❗</span>
					 </div>
					<div class="inputok">
						<label id="psw_text" for="psw"><b>Jelszó</b></label>
						<br>
						<input id="psw" type="password" name="psw" />
						<br>
						<span class="hiba-jelzes" id="psw_hiba">❗</span>
					</div>
					<button id="gomb">Login</button>
					<br>
					<label for="register" id="register">Nincs fiókod? <a href="/regisztracio">Regisztrálj itt!</a></label>
					<br>
					<a id="elf_psw" href="/elfelejtettjelszo">Elfelejtetted a jelszavad?</a>
				</form>
				<p id="hiba_uzenet">
					❌ Hibás felhasználónév vagy jelszó!
				</p>
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
					<li><a class="fej_link" href="/friss">Új Kiadás</a></li>
					<li><a class="fej_link" href="/termekek">Termékek</a></li>
				</ul>
				<div id="fej_tool" style="position: relative;">
					<div id="cart-icon-wrapper">
						<img id="kosar" src="/img/menu/kosar.png" alt="kosar" />
						<span id="cart-count"><?php if(!empty($_SESSION['user_id'])){ echo count($result);} else{ echo "0";} ?></span> <!-- Set dynamically -->
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
	<div id="main-wrapper">
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
		} else if ($_GET['page'] == 'kosar') {
			require 'kosar.php';
		} else if ($_GET['page'] == 'termekek') {
			require 'termekek.php';
		}else if ($_GET['page'] == 'fizetes') {
			require 'fizetes.php';
		}else if ($_GET['page'] == 'megrendeles') {
			require 'megrendeles_osszegzese.php';
		}

		?>
	</div>
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
						<li><a href="/profil/beallitasok">Profilom</a></li>
					</ul>
				</div>

				<!-- Contact Info -->
				<div class="footer-section">
					<h3>Elérhetőségek</h3>
					<ul class="contact-info">
						<li><i class="fas fa-map-marker-alt"></i> Budapest, Timót u. 3, 1097</li>
						<li><i class="fas fa-phone"></i> +36 70 306 9484</li>
						<li><i class="fas fa-envelope"></i> nilewebshop@gmail.com</li>
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