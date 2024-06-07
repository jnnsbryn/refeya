<?php
session_start();
if(isset($_SESSION['role'])){ // Jika tidak ada session role berarti dia belum login
	if ($_SESSION['role'] != "user"){
		header("location: ../");
	}
} else {
	header("location: ../");
}
include "../koneksi.php";
$id_user = $_SESSION['id'];
// Prepare the query and bind parameters
$query = "SELECT * FROM tbl_review INNER JOIN tbl_cafe ON tbl_review.id_cafe = tbl_cafe.id_cafe WHERE tbl_review.id_user = ? ORDER BY tbl_review.id_review DESC";
$stmt = mysqli_prepare($connect, $query);
mysqli_stmt_bind_param($stmt, 'i', $id_user);

// Execute the query and get the result
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Fetch the data
$data = array();
while ($row = mysqli_fetch_array($result)) {
    $data[] = $row;
}

// Close the statement and connection
mysqli_stmt_close($stmt);
mysqli_close($connect);
?>
<!doctype html>
<html lang="id">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>My Review</title>
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
						<a class="nav-link text-light active" aria-current="page" href="#">Review</a>
					</li>
				</ul>
				<a href="#" class="text-decoration-none text-light me-2">Profil</a><div class="vr me-2"></div><a href="../logout.php" class="text-decoration-none text-light">Logout</a>
			</div>
		</div>
	</nav>
	<body>
		<div class="container">
			<div class="h4 pb-2 my-4 text-bg-light border-bottom border-2 border-success">
				My Review
			</div>
			<?php foreach ($data as $row): ?>
			<div class="card mb-3 border-black">
				<div class="row g-0">
					<div class="col-md-4">
						<img src="../photos/<?= $row['foto_cafe']; ?>" class="img-fluid rounded-start" alt="...">
					</div>
					<div class="col-md-8">
						<div class="card-body">
							<h3 class="card-title"><?= $row['nama_cafe']; ?></h3>
							<p class="lead"><?= $row['ulasan_cafe']; ?></p>
							<small>Anda menulis review pada <?php $formatted_date = date('j F Y', strtotime($row['tanggal_update'])); echo $formatted_date; ?> dan memberi bintang <?= $row['rating_cafe']; ?>.</small>
						</div>
					</div>
					<div class="position-relative">
						<a class="btn btn-danger position-absolute bottom-0 end-0 me-1 mb-1" href="hapus-review.php?id=<?= $row['id_review']; ?>" role="button">Hapus</a>
					</div>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	</body>
</html>