<?php
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"){
	require "database/db_connect.php";

	$sql = sprintf("SELECT * FROM felhasznalo WHERE felhasznalo_nev = '%s'", 
	$conn->real_escape_string($_POST['uname']));

	$result = $conn->query($sql);
	$user = $result->fetch_assoc();
	if($user){
		if(password_verify($_POST['psw'], $user['jelszo']))
		{
			$_SESSION["user_id"] = $user["id"];
			header("Location: /".$_GET['page']);
			exit;
		}
	}
	
}
	$kulonOldal = (isset($_GET['page']) && $_GET['page'] === 'regisztracio');
?>

<!DOCTYPE html>
<html lang="en">
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
	<body style="background-color: #fdf8e1">

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
						<!-- <label id="elf_psw_text" for="elf_psw"><b>Elfelejtett jelszó</b></label>
						<br/>
						<input id="elf_psw" type="text" name="elf_psw"/>
						<button type="submit" id="gomb">Jelszó visszaállítása</button> -->
				</form>
				</div>
				
			</div>
		</div>
		<input type="hidden" id="userId" value="<?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : ''; ?>">
		<?php if(!$kulonOldal): ?>
			<div id="fejlec">
				<header id="fej">
					<div id="logo">
						<h2><a id="logo_link" href="/">Nile</a></h2>
					</div>
					<ul id="fej_tart">
						<li><a class="fej_link" href="/friss">Új kiadás</a></li>
						<li><a class="fej_link" href="/legkelendobbek">Legkelendőbbek</a></li>
						<li><a class="fej_link" href="/termekek">Termékek</a></li>
					</ul>
					<div id="fej_tool">
						<img id="kosar" src="/img/menu/kosar.png" alt="kosar" />
						<img id="profilicon" src="/img/menu/icon.png" alt="ikon" />
					</div>
				</header>
			</div>
		<?php endif; ?>
		<?php
			if($_GET['page'] == 'fooldal'){
				require 'home.php';
			}
			else if($_GET['page'] == 'legkelendobbek'){
				require 'legkel.php';
			}
			else if($_GET['page'] == 'termekek'){
				require 'termekek.php';
			}
			else if($_GET['page'] == 'friss'){
				require 'friss.php';
			}
			else if($_GET['page'] == 'profil'){
				require 'profil.php';
			}
			else if($_GET['page'] == 'regisztracio'){
				require 'register.php';
			}
			
		?>
		<?php if(!$kulonOldal): ?>
			<div id="labfej">
				
			</div>
		<?php endif; ?>
		<script src="script.js"></script>
	</body>
</html>
