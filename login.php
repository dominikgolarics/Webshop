<?php
	session_start();
	if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
		header("location: profil.php");
		exit;
	}

	
	require "database/db_connect.php";
	$message = "";

	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$uname = $_POST['uname'];
		$psw = $_POST['psw'];

		//Jelszó lekérés
		$stmt = $conn->prepare("SELECT jelszo FROM felhasznalo WHERE felhasznalo_nev = ?");
		$stmt->bind_param("s", $uname);
		$stmt->execute();
		$stmt->store_result();

		if($stmt->num_rows>0){
			$stmt->bind_result($db_psw);
			$stmt->fetch();
			$verify = password_verify($psw, $db_psw);
			if($verify || $psw === $db_psw){
				
				session_start();
				$_SESSION['uname']=$uname;
				$_SESSION["loggedin"] = true;
				header("Location: index.php");
				exit();
			}
			else{
				$message ="Hibás jelszó!";
			}
		}
		else{
			$message ="Felhasználó név nem találva!";
		}
		$stmt->close();
		$conn->close();
	}
?>
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
		<link rel="stylesheet" href="style/login.css" />
		<title>Nile - Bejelentkezés</title>
	</head>
	<body>
		<div id="tartalom">
			<div id="nilelogo">
				<a href="index.php"><img style="width: 128px; height: 128px;" src="img/menu/logo-good-trans.png"></a>
			</div>
			<div id="tartalom_login">
				<form action="login.php" method="post">
					<div id="login_form">
						<label id="uname_text" for="uname"><b>Felhasználónév</b></label>
						<br />
						<input
							id="uname"
							type="text"
							name="uname"
						/>
						<br />
						<label id="psw_text" for="psw"><b>Jelszó</b></label>
						<br />
						<input
							id="psw"
							type="password"
							name="psw"
						/>
						<br>
						<button type="submit" id="gomb">Login</button>
						<br />
						<label for="register"
							>Nincs fiókod? <a href="register.php">Regisztrálj itt!</a></label
						>
						<br />
						<label id="elf_psw_text" for="elf_psw"
							><b>Elfelejtett jelszó</b></label
						>
						<br />
						<input
							id="elf_psw"
							type="text"
							name="elf_psw"
						/>
						<button type="submit" id="gomb">Jelszó visszaállítása</button>
					</div>
				</form>
			</div>
		</div>
		<?php echo $message?>
		<script src="script.js"></script>
	</body>
</html>
