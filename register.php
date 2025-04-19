

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
		<div id="error-container">
			<?php if (isset($_SESSION['reg_error'])): ?>
				<div class="alert alert-danger text-center"><?= htmlspecialchars($_SESSION['reg_error']) ?></div>
				<?php unset($_SESSION['reg_error']); ?>
			<?php endif; ?>
		</div>
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
					<form action="register-feldolgozasa.php" method="post">
						<div class="mb-3">
							<label for="uname" class="form-label">Felhasználónév</label>
							<input
								class="form-control"
								id="uname"
								type="text"
								placeholder="Felhasználónév"
								name="uname"
								value="<?= htmlspecialchars($_SESSION['reg_data']['uname'] ?? '') ?>"
							/>
						</div>
						
						<div class="mb-3">
							<label for="email" class="form-label">Email</label>
							<input
								class="form-control"
								id="email"
								type="text"
								placeholder="email@example.com"
								name="email"
								value="<?= htmlspecialchars($_SESSION['reg_data']['email'] ?? '') ?>"
							/>
						</div>
						
						<div class="mb-3">
							<label for="psw" class="form-label">
							Jelszó
							<span 
								class="info-icon" 
								data-bs-toggle="tooltip" 
								data-bs-html="true"
  								data-bs-placement="right"
								title=
								"<div style='text-align: left; font-size: 14px; line-height: 1.5;'>
								<strong>Jelszókövetelmények:</strong>
								<ul style='padding-left: 20px; margin: 8px 0 0 0;'>
									<li>Legalább 8 karakter</li>
									<li>Legalább egy nagybetű</li>
									<li>Legalább egy szám</li>
								</ul>
								</div>">
								❓
							</span>
							</label>
							<input
								class="form-control"
								id="psw"
								type="password"
								placeholder="Legalább 8 karakter"
								name="psw"
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
								value="<?= htmlspecialchars($_SESSION['reg_data']['num'] ?? '') ?>"
							/>
						</div>
						
						<button type="submit" class="btn btn-primary w-100">Regisztráció</button>
						
					</form>
				</div>
			</div>
		</div>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

		<script>
		const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
		const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl =>
			new bootstrap.Tooltip(tooltipTriggerEl)
		);
		</script>
		<script src="script.js"></script>
	</body>