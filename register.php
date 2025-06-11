<?php
session_start();

if (isset($_SESSION["user"])) {
    header("Location: index.php");
}

if (isset($_POST["submit"])) {
    $fullName = $_POST["fullname"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $passwordRepeat = $_POST["repeat_password"];

	// OLD VALUE
    $oldFullName = $fullName;
    $oldUsername = $username;

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $errors = array();

    if (empty($fullName)) {
        $errors["fullname"] = "Nama Harus Diisi";
    }
    if (empty($username)) {
        $errors["username"] = "Username harus diisi";
    }
    if (empty($password)) {
        $errors["password"] = "Password harus diisi";
    } elseif (strlen($password) < 8) {
        $errors["password"] = "Minimal Password 8 karakter";
    }
    if (empty($passwordRepeat)) {
        $errors["repeat_password"] = "Ulangi Password harus diisi";
    } elseif ($password !== $passwordRepeat) {
        $errors["repeat_password"] = "Password Tidak Sesuai";
    }

    require_once "database.php";
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    $rowCount = mysqli_num_rows($result);
    if ($rowCount > 0) {
        $errors["username"] = "Username sudah terdaftar!";
    }

    if (!empty($errors)) {
        // Display all errors 
        // echo "<div class='alert alert-danger'>";
        // foreach ($errors as $field => $error) {
        //     echo "<p class='text-danger my-2'><strong>$error</strong></p>";
        // }
        // echo "</div>";
    } else {
        $sql = "INSERT INTO users (full_name, username, password, level) VALUES (?, ?, ?, 'mahasiswa')";
        $stmt = mysqli_stmt_init($conn);
        $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
        if ($prepareStmt) {
            mysqli_stmt_bind_param($stmt, "sss", $fullName, $username, $passwordHash);
            mysqli_stmt_execute($stmt);
            
			 // Set success message in session variable
			 $_SESSION['success_message'] = "Anda berhasil registrasi.";

			 // Redirect to login page
			 header("Location: login.php");
			 exit();

        } else {
            die("Something went wrong");
        }
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
    <title>Halaman Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>

<body>
    <section class="h-100">
        <div class="container h-100">
            <div class="row justify-content-sm-center h-100">
                <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-9">
                    <div class="text-center my-5">
                        <img src="img/LOGO UNIMA.png" alt="logo" width="100">
                    </div>
                    <div class="card shadow-lg">
                        <div class="card-body p-5">
                            <h1 class="fs-4 card-title fw-bold mb-4 text-center">Registrasi</h1>
                            <form method="POST" action="register.php" class="needs-validation" novalidate=""
                                autocomplete="off">
                                <div class="mb-3">
									<label class="mb-2 text-muted" for="fullname">Nama Lengkap</label>
									<input id="fullname" type="fullname" class="form-control" name="fullname" value="<?php echo isset($oldFullName) ? $oldFullName : ''; ?>" required autofocus>
									<?php if(isset($errors["fullname"])) echo "<p class='text-danger my-2'><strong>{$errors["fullname"]}</strong></p>"; ?>
								</div>

								<div class="mb-3">
									<label class="mb-2 text-muted" for="username">Username</label>
									<input id="username" type="username" class="form-control" name="username" value="<?php echo isset($oldUsername) ? $oldUsername : ''; ?>" required autofocus>
									<?php if(isset($errors["username"])) echo "<p class='text-danger my-2'><strong>{$errors["username"]}</strong></p>"; ?>
								</div>


                                <div class="mb-3">
                                    <div class="mb-2 w-100">
                                        <label class="text-muted" for="password">Password</label>
                                    </div>
                                    <input id="password" type="password" class="form-control" name="password"
                                        required>
                                    <?php if(isset($errors["password"])) echo "<p class='text-danger my-2'><strong>{$errors["password"]}</strong></p>"; ?>
                                </div>

                                <div class="mb-3">
                                    <div class="mb-2 w-100">
                                        <label class="text-muted" for="repeat_password">Ulangi Password</label>
                                    </div>
                                    <input id="repeat_password" type="password" class="form-control"
                                        name="repeat_password" required>
                                    <?php if(isset($errors["repeat_password"])) echo "<p class='text-danger my-2'><strong>{$errors["repeat_password"]}</strong></p>"; ?>
                                </div>

                                <div class="d-flex justify-content-center">
                                    <button name="submit" type="submit"
                                        class="btn btn-primary w-100 py-2 mt-3">Registrasi
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer py-3 border-0">
                            <div class="text-center">
                                Sudah registrasi ? <a href="login.php" class="text-dark">Login</a>
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
