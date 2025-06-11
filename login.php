<?php
session_start();

if (isset($_SESSION["user"])) {
   header("Location: index.php");
   exit;
} elseif (isset($_SESSION["admin"])) {
    header("Location: indexadmin.php");
    exit;
}

// Check if success message is set
if (isset($_SESSION['success_message'])) {
        echo "<div class='alert alert-success'>{$_SESSION['success_message']}</div>";
    // JavaScript alert 
        echo "<script>alert('Anda Berhasil Registrasi!');</script>";
        
    // Clear the session variable
    unset($_SESSION['success_message']);
}

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    require_once "database.php";

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    // Check if the username exists
    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user["password"])) {
            if ($user['level'] == 'admin') {
                $_SESSION["admin"] = [
                    "id" => $user["id"],
                    "username" => $user["username"],
                    "full_name" => $user["full_name"]
                ];
                header("Location: indexadmin.php");
                exit;
            } elseif ($user['level'] == 'mahasiswa') {
                $_SESSION["user"] = [
                    "id" => $user["id"],
                    "username" => $user["username"],
                    "full_name" => $user["full_name"]
                ];
                header("Location: index.php");
                exit;
            }
        } else {
            // Password verification failed
            $error = "Username / Password Salah";
        }
    } else {
        // Username not found
        $error = "Username / Password Salah";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Muhamad Nauval Azhar">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta name="description" content="This is a login page template based on Bootstrap 5">
	<title>Halaman Login</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>

<body>
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-sm-center h-100">
				<div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
					<div class="text-center my-5">
						<img src="img/LOGO UNIMA.png" alt="logo" width="100">
					</div>

                    <!-- ERROR -->
                    <?php if (isset($error)) : ?>
                        <div class="alert alert-danger" role="alert">
                            <strong>Error:</strong> <?php echo $error; ?>
                        </div>
                    <?php endif; ?>
                    <!-- END ERROR -->


					<div class="card shadow-lg">
						<div class="card-body p-5">
							<h1 class="fs-4 card-title fw-bold mb-4 text-center">Login</h1>
							<form action="login.php" method="POST" class="needs-validation" novalidate="" autocomplete="off">
								<div class="mb-3">
									<label class="mb-2 text-muted" for="username">Username</label>
									<input id="username" type="username" class="form-control" name="username" value="" required autofocus>
									<div class="invalid-feedback">
										Username Salah
									</div>
								</div>

								<div class="mb-3">
									<div class="mb-2 w-100">
										<label class="text-muted" for="password">Password</label>
									</div>
									<input id="password" type="password" class="form-control" name="password" required>
								    <div class="invalid-feedback">
								    	Password is required
							    	</div>
								</div>

								<div class="d-flex justify-content-center">
									<button name="login" type="submit" class="btn btn-primary w-100 py-2 mt-3">
										Login
									</button>
								</div>
							</form>
						</div>
						<div class="card-footer py-3 border-0">
							<div class="text-center">
								Belum Punya Akun ? <a href="register.php" class="text-dark">Buat Akun</a>
							</div>
						</div>
					</div>
					<div class="text-center mt-5 text-muted my-5">
						Copyright &copy; &mdash; UNIMA 
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="sign-in/js/login.js"></script>
</body>
</html>