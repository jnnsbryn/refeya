<?php
session_start();
if(isset($_SESSION['role'])){ // Jika tidak ada session role berarti dia belum login
	if ($_SESSION['role'] == "admin"){
		header("location: ./admin");
	} else if ($_SESSION['role'] == "user"){
		header("location: ./user");
	}
}
?>
<!doctype html>
<html lang="id">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Selamat datang di Markas</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-sm"></div>
				<div class="col-sm">
					<div class="card mt-5">
						<div class="card-body text-center">
							<form method="post" action="login.php">
								<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Email</label>
									<input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" name="email" required>
								</div>
								<div class="mb-3">
									<label for="exampleFormControlInput1" class="form-label">Password</label>
									<input type="password" class="form-control" id="exampleFormControlInput1" name="password" required>
								</div>
								<input class="btn btn-primary" type="submit" value="Masuk"><hr>
							</form>
							<p>Belum punya akun?</p>
							<a class="btn btn-success" href="./buat-akun.php" role="button">Buat Akun</a>
						</div>
					</div>
				</div>
				<div class="col-sm"></div>
			</div>
		</div>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	</body>
</html>