<?php
session_start();
if(isset($_SESSION['role'])){ // Jika tidak ada session role berarti dia belum login
	if ($_SESSION['role'] != "admin"){
		header("location: ../");
	}
} else {
	header("location: ../");
}
$id = $_SESSION['id'];
include "../koneksi.php";

$query = "SELECT id_user,email_user,role_user,status_user FROM tbl_user WHERE status_user != 0 ORDER BY id_user ASC";
$sql = mysqli_query($connect, $query); // Eksekusi/Jalankan query dari variabel $query
?>
<!doctype html>
<html lang="id">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Manajemen User</title>
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
						<a class="nav-link text-light active" aria-current="page" href="#">Manajemen User</a>
					</li>
				</ul>
				<a href="#" class="text-decoration-none text-light me-2">Profil</a><div class="vr me-2"></div><a href="../logout.php" class="text-decoration-none text-light">Logout</a>
			</div>
		</div>
	</nav>
	<body>
		<div class="container-fluid">
			<div class="pb-2 mt-4 text-end border-bottom border-2 border-dark">
				<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
					Buat Akun Baru
				</button>
			</div>
			<table class="table">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Email User</th>
						<th scope="col">Role User</th>
						<th scope="col">Aksi</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$row_num = 1; // initialize the row number
					while($data = mysqli_fetch_array($sql)){ ?>
					  <tr>
						<th scope="row"><?= $row_num; ?></th>
						<td><?= $data['email_user']; ?></td>
						<td><?= $data['role_user']; ?></td>
						<td>
							<?php if ($data['id_user']!=$id){ ?><a href="edit-akun.php?id=<?= $data['id_user']; ?>" class="text-decoration-none">Edit Akun</a><?php } else { ?><a href="profil.php" class="text-decoration-none">Edit Akun</a><?php } ?>
						</td>
					  </tr>
				<?php $row_num++; // increment the row number ?>
				<?php } ?>
				</tbody>
			</table>
					
			<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered modal-lg">
					<div class="modal-content">
						<form method="post" action="input.php" enctype="multipart/form-data">
							<div class="modal-header">
								<h1 class="modal-title fs-5" id="staticBackdropLabel">Input Cafe baru</h1>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<div class="form-floating mb-3">
									<input type="text" name="nama" class="form-control" id="floatingInput" placeholder="Nama Cafe" maxlength="30" required>
									<label for="floatingInput">Nama Cafe</label>
								</div>
								<div class="form-floating mb-3">
									<textarea class="form-control" name="deskripsi" placeholder="Deskripsi Cafe" id="floatingTextarea2" style="height: 100px" required></textarea>
									<label for="floatingTextarea2">Deskripsi Cafe</label>
								</div>
								<div class="form-floating mb-3">
									<input type="text" name="lokasi" class="form-control" id="floatingInput" placeholder="Lokasi Cafe" maxlength="30" required>
									<label for="floatingInput">Lokasi Cafe</label>
								</div>
								<div class="form-floating mb-3">
									<input type="text" name="fasilitas" class="form-control" id="floatingInput" placeholder="Fasilitas Cafe" maxlength="60" required>
									<label for="floatingInput">Fasilitas Cafe</label>
									<div class="form-text">
										Gunakan koma (,) untuk memisahkan. Contoh: WiFi,Listrik,Outdoor
									</div>
								</div>
								<div class="mb-3">
									Foto
									<input type="file" name="foto" required>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
								<input class="btn btn-primary" type="submit" value="Submit">
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	</body>
</html>