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
				header("location: /");
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
	
</html>


<body>
		<div class="container">
			<div class="text-center mb-4">
				<a href="/"><img style="width: 128px; height: 128px;" src="img/menu/logo-good-trans.png" alt="Nile Logo"></a>
				<h2 class="mt-2">Regisztráció</h2>
			</div>
			
			<?php if(!empty($error)): ?>
				<div class="alert alert-danger"><?php echo $error; ?></div>
			<?php endif; ?>
			
			<div class="card mx-auto" style="max-width: 400px;">
				<div class="card-body">
					<form action="register.php" method="post">
						<div class="mb-3">
							<label for="uname" class="form-label">Felhasználónév</label>
							<input
								class="form-control"
								id="uname"
								type="text"
								placeholder="Felhasználónév"
								name="uname"
								required
							/>
						</div>
						
						<div class="mb-3">
							<label for="email" class="form-label">Email</label>
							<input
								class="form-control"
								id="email"
								type="email"
								placeholder="email@example.com"
								name="email"
								required
							/>
						</div>
						
						<div class="mb-3">
							<label for="psw" class="form-label">Jelszó</label>
							<input
								class="form-control"
								id="psw"
								type="password"
								placeholder="Legalább 6 karakter"
								name="psw"
								required
							/>
						</div>
						
						<div class="mb-3">
							<label for="psw_again" class="form-label">Jelszó ismét</label>
							<input
								class="form-control"
								id="psw_again"
								type="password"
								placeholder="Jelszó megerősítése"
								name="psw_again"
								required
							/>
						</div>
						
						<div class="mb-3">
							<label for="number" class="form-label">Telefonszám</label>
							<input
								class="form-control"
								id="number"
								type="text"
								placeholder="+36..."
								name="num"
							/>
						</div>
						
						<button type="submit" class="btn btn-primary w-100">Regisztráció</button>
						
					</form>
				</div>
			</div>
		</div>
		<script src="script.js"></script>
	</body>