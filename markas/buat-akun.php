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
						<form method="post" action="signup.php">
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Email</label>
								<input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" name="email" required>
							</div>
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Password</label>
								<input type="password" class="form-control" id="exampleFormControlInput1" name="password" maxlength="16" required onkeyup="checkPasswords(this)">
								<div class="form-text">
									Minimal 8 karakter maksimal 16 karakter
								</div>
							</div>
							<div class="mb-3">
								<label for="exampleFormControlInput1" class="form-label">Retype Password</label>
								<input type="password" class="form-control" id="exampleFormControlInput1" name="retype-password" maxlength="16" required onkeyup="checkPasswords(this)">
							</div>
							<button class='btn btn-primary' type='submit' id='submit-btn' disabled>Buat Akun</button><hr>
						</form>
                        <p>Sudah punya akun?</p>
                        <a class="btn btn-success" href="./signup.php" role="button">Masuk</a>
                    </div>
                </div>
            </div>
            <div class="col-sm"></div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script>
    function checkPasswords(input) {
        const password = document.querySelector('input[name=password]');
        const retypePassword = document.querySelector('input[name=retype-password]');
        const submitBtn = document.querySelector('#submit-btn');

        if(password.value === retypePassword.value) {
            submitBtn.disabled = false;
        } else {
            submitBtn.disabled = true;
        }
    }
</script>

</body>
</html>