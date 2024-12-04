<?php
include("php/config.php");
session_start();

// Redirect jika sudah login
if(isset($_SESSION['user_id'])) {
    header("Location: beranda.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Register</title>
    <link rel="icon" href="./assets/images/silvasuphaa.png" type="image/png">
</head>
<body>
    <div class="container">
        <div class="box form-box">
        <?php 
        if (isset($_POST['submit'])) {
            // Ambil data dari form
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $age = intval($_POST['age']);
            $password = $_POST['password'];

            // Validasi input
            $errors = [];

            // Validasi username
            if (empty($username)) {
                $errors[] = "Username tidak boleh kosong";
            } elseif (strlen($username) < 3) {
                $errors[] = "Username minimal 3 karakter";
            }

            // Validasi email
            if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Email tidak valid";
            }

            // Validasi umur
            if ($age < 10) {
                $errors[] = "Umur minimal 10 tahun";
            }

            // Validasi password
            if (strlen($password) < 8) {
                $errors[] = "Password minimal 8 karakter";
            }

            // Cek apakah ada error
            if (empty($errors)) {
                // Gunakan prepared statement untuk mencegah SQL Injection
                // Cek username
                $stmt_username = mysqli_prepare($con, "SELECT Username FROM users WHERE Username = ?");
                mysqli_stmt_bind_param($stmt_username, "s", $username);
                mysqli_stmt_execute($stmt_username);
                mysqli_stmt_store_result($stmt_username);

                // Cek email
                $stmt_email = mysqli_prepare($con, "SELECT Email FROM users WHERE Email = ?");
                mysqli_stmt_bind_param($stmt_email, "s", $email);
                mysqli_stmt_execute($stmt_email);
                mysqli_stmt_store_result($stmt_email);

                if (mysqli_stmt_num_rows($stmt_username) > 0) {
                    $errors[] = "Username sudah ada, pilih username lain";
                }

                if (mysqli_stmt_num_rows($stmt_email) > 0) {
                    $errors[] = "Email sudah digunakan, gunakan email lain";
                }

                // Jika tidak ada error
                if (empty($errors)) {
                    // Hash password
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                    // Prepared statement untuk insert
                    $stmt_insert = mysqli_prepare($con, 
                        "INSERT INTO users (Username, Email, Age, Password) VALUES (?, ?, ?, ?)"
                    );
                    mysqli_stmt_bind_param($stmt_insert, "ssis", $username, $email, $age, $hashed_password);

                    if (mysqli_stmt_execute($stmt_insert)) {
                        echo "<div class='message'>
                                <p>Registrasi berhasil! Silakan login.</p>
                              </div><br>";
                        echo "<a href='login.php'><button class='btn'>Login Sekarang</button></a>";
                        exit();
                    } else {
                        $errors[] = "Registrasi gagal. Silakan coba lagi.";
                    }
                }
            }

            // Tampilkan error jika ada
            if (!empty($errors)) {
                echo "<div class='message'>";
                foreach ($errors as $error) {
                    echo "<p>" . htmlspecialchars($error) . "</p>";
                }
                echo "</div><br>";
            }
        }
        ?>

        <header>Sign Up</header>
        <form action="" method="post">
            <div class="field input">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" 
                       value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>" 
                       autocomplete="off" required>
            </div>

            <div class="field input">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" 
                       value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" 
                       autocomplete="off" required>
            </div>

            <div class="field input">
                <label for="age">Age</label>
                <input type="number" name="age" id="age" 
                       value="<?php echo isset($_POST['age']) ? intval($_POST['age']) : ''; ?>" 
                       min="10" autocomplete="off" required>
            </div>

            <div class="field input">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" autocomplete="off" required>
            </div>

            <div class="field">
                <input type="submit" class="btn" name="submit" value="Register" required>
            </div>
            <div class="links">
                Already a member? <a href="login.php">Sign In</a>
            </div>
        </form>
    </div>
</body>
</html>