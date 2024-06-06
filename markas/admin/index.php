<?php
session_start();
if(isset($_SESSION['role'])){ // Jika tidak ada session role berarti dia belum login
	if ($_SESSION['role'] != "admin"){
		header("location: ../");
	}
} else {
	header("location: ../");
}
include "../koneksi.php";
$query = "
    SELECT 
        (SELECT COUNT(*) FROM tbl_cafe WHERE status_cafe = 1) AS cafe_count,
        (SELECT COUNT(*) FROM tbl_user WHERE status_user = 1) AS user_count
";
$result = mysqli_query($connect, $query);

// Check if query execution is successful
if($result) {
    // Fetch the result
    $row = mysqli_fetch_assoc($result);
	$total_cafe = $row['cafe_count'];
	$total_user = $row['user_count'];
} else {
    echo "Error: " . mysqli_error($connect);
}

// Close database connection
mysqli_close($connect);
?>
<!doctype html>
<html lang="id">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Admin Dashboard</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
	</head>
	<nav class="navbar navbar-expand-lg bg-primary">
		<div class="container-fluid">
			<a class="navbar-brand text-light" href="#">Refeya</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarTogglerDemo02">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<li class="nav-item">
						<a class="nav-link text-light active" aria-current="page" href="#">Dashboard</a>
					</li>
				</ul>
				<a href="#" class="text-decoration-none text-light me-2">Profil</a><div class="vr me-2"></div><a href="../logout.php" class="text-decoration-none text-light">Logout</a>
			</div>
		</div>
	</nav>
	<body>
		<div class="container-fluid">
			<div class="row row-cols-1 row-cols-md-2 g-1 mt-4">
				<div class="col">
					<div class="card text-bg-success">
						<div class="card-body">
							<h1 class="card-title text-center"><a href="./manajemen-cafe.php" class="text-decoration-none text-light stretched-link"><i class="bi bi-shop-window"></i> <?= $total_cafe; ?> Cafe</a></h1>
						</div>
					</div>
				</div>
				<div class="col">
					<div class="card text-bg-warning">
						<div class="card-body">
							<h1 class="card-title text-center"><a href="./manajemen-user.php" class="text-decoration-none text-light stretched-link"><i class="bi bi-person-fill"></i> <?= $total_user; ?> User</a></h1>
						</div>
					</div>
				</div>
				<div class="col">
					<div class="card text-bg-primary">
						<div class="card-body">
							<h1 class="card-title text-center"><a href="./manajemen-review.php" class="text-decoration-none text-light stretched-link"><i class="bi bi-pen"></i> 1000 Review</a></h1>
						</div>
					</div>
				</div>
				<div class="col">
					<div class="card text-bg-danger">
						<div class="card-body">
							<h1 class="card-title text-center"><a href="#" class="text-decoration-none text-light stretched-link">1 Developer</a></h1>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	</body>
</html>