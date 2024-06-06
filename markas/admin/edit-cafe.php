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

	$id_cafe = $_GET['id_cafe'];
	$query = "SELECT * FROM tbl_cafe WHERE id_cafe='".$id_cafe."'";
	$sql = mysqli_query($connect, $query);  // Eksekusi/Jalankan query dari variabel $query
	$data = mysqli_fetch_array($sql); // Ambil data dari hasil eksekusi $sql
?>
<!doctype html>
<html lang="id">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Edit Cafe</title>
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
						<a class="nav-link text-light active" aria-current="page" href="#">Edit Cafe</a>
					</li>
				</ul>
				<a href="#" class="text-decoration-none text-light me-2">Profil</a><div class="vr me-2"></div><a href="../logout.php" class="text-decoration-none text-light">Logout</a>
			</div>
		</div>
	</nav>
	<body>
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm"></div>
				<div class="col-sm">
					<div class="card p-2 mt-5">
						<form method="post" action="edit.php?id_cafe=<?= $id_cafe; ?>" enctype="multipart/form-data">
							<div class="form-floating mb-3">
								<input type="text" name="nama" value="<?= $data['nama_cafe']; ?>" class="form-control" id="floatingInput" placeholder="Nama Cafe" maxlength="30" required>
								<label for="floatingInput">Nama Cafe</label>
							</div>
							<div class="form-floating mb-3">
								<textarea class="form-control" name="deskripsi" placeholder="Deskripsi Cafe" id="floatingTextarea2" style="height: 100px" required><?= $data['deskripsi_cafe']; ?></textarea>
								<label for="floatingTextarea2">Deskripsi Cafe</label>
							</div>
							<div class="form-floating mb-3">
								<input type="text" name="lokasi" value="<?= $data['lokasi_cafe']; ?>" class="form-control" id="floatingInput" placeholder="Lokasi Cafe" maxlength="30" required>
								<label for="floatingInput">Lokasi Cafe</label>
							</div>
							<div class="form-floating mb-3">
								<input type="text" name="fasilitas" value="<?= $data['fasilitas_cafe']; ?>" class="form-control" id="floatingInput" placeholder="Fasilitas Cafe" maxlength="60" required>
								<label for="floatingInput">Fasilitas Cafe</label>
								<div class="form-text">
									Gunakan koma (,) untuk memisahkan. Contoh: WiFi,Listrik,Outdoor
								</div>
							</div>
							<div class="mb-3">
								<?php if ($data['status_cafe'] == 0){ ?>
									<label class="form-label">Status Cafe</label>
									<div class="form-check">
										<input class="form-check-input" type="radio" name="status" value="0" checked>
										<label class="form-check-label">Closed</label>
									</div>
									<div class="form-check">
										<input class="form-check-input" type="radio" name="status" value="1">
										<label class="form-check-label">Operational</label>
									</div>
								<?php } else { ?>
									<label class="form-label">Status Cafe</label>
									<div class="form-check">
										<input class="form-check-input" type="radio" name="status" value="0">
										<label class="form-check-label">Closed</label>
									</div>
									<div class="form-check">
										<input class="form-check-input" type="radio" name="status" value="1" checked>
										<label class="form-check-label">Operational</label>
									</div>
								<?php } ?>
							</div>
							<div class="mb-3">
								<input type="checkbox" name="ubah_foto" value="true"> Ceklis jika ingin mengubah foto<br>
								<input type="file" name="foto">
							</div><hr>
							<input class="btn btn-primary" type="submit" value="Submit">
						</form>
					</div>
				</div>
				<div class="col-sm"></div>
			</div>
		</div>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	</body>
</html>