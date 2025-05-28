<?php 
session_start();

// Redirect jika sudah login
if(isset($_SESSION['user_id'])) {
    // Cek apakah user adalah admin
    if($_SESSION['username'] === 'admin') {
        header("Location: adminpanel.php");
    } else {
        header("Location: beranda.php");
    }
    exit();
}

include("php/config.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>Login</title>
    <link rel="icon" href="./assets/images/silvasuphaa.png" type="image/png">
</head>
<body>
  
     
    <div class="container">
        <div class="box form-box">
            <?php 
            if(isset($_POST['submit'])){
                // Gunakan prepared statement untuk mencegah SQL Injection
                $username = $_POST['email'];
                $password = $_POST['password'];

                // Prepared statement
                $stmt = mysqli_prepare($con, "SELECT * FROM users WHERE Username = ?");
                mysqli_stmt_bind_param($stmt, "s", $username);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $user = mysqli_fetch_assoc($result);
               
                if ($user) {
                    // Verifikasi password
                    if (password_verify($password, $user['Password'])) {
                        // Set session variables dengan aman
                        $_SESSION['user_id'] = $user['Id'];
                        $_SESSION['username'] = $user['Username'];
                        
                        // Cek apakah user adalah admin
                        if($user['Username'] === 'admin') {
                            header("Location: adminpanel.php");
                        } else {
                            header("Location: beranda.php");
                        }
                        exit();
                    } else {
                        echo "<div class='message'>
                                <p>Password salah</p>
                              </div> <br>";
                    }
                } else {
                    echo "<div class='message'>
                            <p>Username tidak ditemukan</p>
                          </div> <br>";
                }
            }
            ?>
            
            <header>Login</header>
            <a href="index.php" class="back-button">
        <span>← </span>Kembali
    </a>
            <form action="" method="post">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="email" id="email" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                    <div class="password-container">
                    <span class="password-toggle" onclick="togglePassword()">👁️ - Show</span><style> .password-toggle { cursor: pointer; } </style>

                </div>
                </div>

                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Login" required>
                </div>
                <div class="links">
                    Don't have account? <a href="register.php">Sign Up Now</a>
                </div>
            </form>
        </div>
    </div>
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.querySelector('.password-toggle');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.textContent = '🙈 - Hide';
            } else {
                passwordInput.type = 'password';
                toggleIcon.textContent = '👁️ - Show';
            }
        }
</script>
</body>
</html>