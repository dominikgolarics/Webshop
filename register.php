<?php
	require "database/db_connect.php";
	$error = "";

	if($_SERVER["REQUEST_METHOD"] == "POST"){
		//Adatok lekérése
		$uname = trim($_POST['uname']);
		$email = trim($_POST['email']);
		$psw = password_hash(trim($_POST['psw']), PASSWORD_DEFAULT);
		$psw_again = $_POST['psw_again'];
		$num = $_POST['num'];
		
		//Email ellenőrzés
		if(empty($uname)){
			$error = "Adj meg egy felhasználó nevet!";
		}
		elseif(!preg_match('/^[a-zA-Z0-9_]+$/', $uname)){
			$error = "Csak betűket, számokat és alulvonást tartalmazhat.";
		}
		else{
			$sql = "SELECT felhasznalo_nev FROM felhasznalo WHERE felhasznalo_nev = ?";

			$stmt = $conn->prepare($sql);
			$stmt->bind_param("s", $uname);
			$stmt->execute();
			$stmt->store_result();
			if($stmt->num_rows>0){
				$error = "Ez a felhasználónév már használatban van!";
			}
		}

		//Felhasználó név ellenőrzés
		if(empty($email)){
			$error = "Adj meg egy emailt!";
		}
		elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$error = "Hibás email!";
		}
		else{
			$sql = "SELECT email FROM felhasznalo WHERE email = ?";

			$stmt = $conn->prepare($sql);
			$stmt->bind_param("s", $email);
			$stmt->execute();
			$stmt->store_result();
			if($stmt->num_rows>0){
				$error = "Ez az email már használatban van!";
			}
		}
		//Jelszó ellenőrzés
		if(empty($psw)){
			$error = "Adj meg egy jelszót!";     
		} elseif(strlen($psw) < 6){
			$error = "A jelszavad legalább 6 karakter hosszúnak kell lennie!";
		} 

		//Jelszó ismét ellenőrzés
		// if(empty($psw_again)){
		// 	$error = "Add meg ismét a jelszavad!";     
		// } elseif($psw != $psw_again){
		// 	$error = "A jelszavak nem egyeztek";
		// }

		if(empty($error))
		{
			$sql = "INSERT INTO felhasznalo(felhasznalo_nev, email, jelszo, telefonszam) VALUES (?, ?, ?, ?)";
			$stmt = $conn->prepare($sql);
			$stmt->bind_param("ssss", $uname, $email, $psw, $num);
			if($stmt->execute()){
				header("location: login.php");
			}
			else{
				echo "Hiba: ".$stmt->error;
			}
		}
		
		$conn->close();
	}
?>

<!DOCTYPE html>
<html lang="hu">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="icon" type="image/x-icon" href="img/menu/favicon.ico" />
		<link
			href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
			rel="stylesheet"
		/>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
		<link rel="stylesheet" href="style/register.css" />
		<title>Nile - Regisztráció</title>
	</head>
	<body>
		<div id="tartalom">
			<div id="nilelogo">
			<a href="/"><img style="width: 128px; height: 128px;" src="img/menu/logo-good-trans.png"></a>
			</div>
			<div id="tartalom_login">
				<form action="register.php" method="post">
					<div id="login_form">
						<label id="uname_text" for="uname" class="inputname"><b>Felhasználónév</b></label>
						<br />
						<input
							class="inputtext"
							id="uname"
							type="text"
							placeholder=""
							name="uname"
							
						/>
						<br />
						<label id="email_text" for="email" class="inputname"><b>Email</b></label>
						<br />
						<input
							class="inputtext"
							id="email"
							type="email"
							placeholder=""
							name="email"
							
						/>
						<br>
						<label id="psw_text" for="psw" class="inputname"><b>Jelszó</b></label>
						<br />
						<input
							class="inputtext"
							id="psw"
							type="password"
							placeholder=""
							name="psw"
							
						/>
						<br>
						<label id="psw_text_again" for="psw" class="inputname"><b>Jelszó ismét</b></label>
						<br />
						<input
							class="inputtext"
							id="psw_again"
							type="password"
							placeholder=""
							name="psw_again"
							
						/>
						<label id="number_text" for="num" class="inputname"><b>Telefonszám</b></label>
						<br />
						<input
							class="inputtext"
							id="number"
							type="text"
							placeholder=""
							name="num"
							
						/>
						<br>
						<br>
						<button type="submit" id="gomb">Register</button>
						<br />
						<label for="register">Van fiókod?<a href="login.php">Lépj be itt</a></label>
					</div>
				</form>
			</div>
		</div>
		<?php echo $error?>
		<script src="script.js"></script>
	</body>
</html>
