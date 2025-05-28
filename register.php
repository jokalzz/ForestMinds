<?php
include("php/config.php");
session_start();

// Redirect jika sudah login
if(isset($_SESSION['user_id'])) {
    header("Location: beranda.php");
    exit();
}

// Function to validate password strength
function validatePasswordStrength($password) {
    $errors = [];
    
    // Check minimum length
    if (strlen($password) < 8) {
        $errors[] = "Password minimal 8 karakter";
    }
    
    // Check for uppercase letter
    if (!preg_match('/[A-Z]/', $password)) {
        $errors[] = "Password harus mengandung minimal 1 huruf besar";
    }
    
    // Check for number
    if (!preg_match('/[0-9]/', $password)) {
        $errors[] = "Password harus mengandung minimal 1 angka";
    }
    
    // Check for symbol
    if (!preg_match('/[!@#$%^&*()_+\-=\[\]{};\':"\\|,.<>\/?]/', $password)) {
        $errors[] = "Password harus mengandung minimal 1 simbol (!@#$%^&*)";
    }
    
    return $errors;
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

            // Validasi password strength
            $passwordErrors = validatePasswordStrength($password);
            $errors = array_merge($errors, $passwordErrors);

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
                        echo "<div class='message success'>
                                <p>Registrasi berhasil! Silakan login.</p>
                              </div><br>";
                        echo "<a href='login.php'><button class='btn'>Login Sekarang</button></a>";
                        exit();
                    } else {
                        $errors[] = "Registrasi gagal. Silakan coba lagi.";
                    }
                }
                
                // Tutup prepared statements
                mysqli_stmt_close($stmt_username);
                mysqli_stmt_close($stmt_email);
                if (isset($stmt_insert)) {
                    mysqli_stmt_close($stmt_insert);
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
        <form action="" method="post" id="registrationForm">
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
                <div class="password-container">
                    <input type="password" name="password" id="password" autocomplete="off" required>
                    <span class="password-toggle" onclick="togglePassword()">👁️ - Show</span>
                </div>
                
                <div class="password-requirements">
                    <h4>Password Requirements:</h4>
                    <div class="requirement invalid" id="length-req">
                        <div class="requirement-icon">✗</div>
                        <span>Minimal 8 karakter</span>
                    </div>
                    <div class="requirement invalid" id="uppercase-req">
                        <div class="requirement-icon">✗</div>
                        <span>Minimal 1 huruf besar (A-Z)</span>
                    </div>
                    <div class="requirement invalid" id="number-req">
                        <div class="requirement-icon">✗</div>
                        <span>Minimal 1 angka (0-9)</span>
                    </div>
                    <div class="requirement invalid" id="symbol-req">
                        <div class="requirement-icon">✗</div>
                        <span>Minimal 1 simbol (!@#$%^&*)</span>
                    </div>
                </div>
            </div>

            <div class="field">
                <input type="submit" class="btn" name="submit" value="Register" id="submitBtn" disabled>
            </div>
            <div class="links">
                Already a member? <a href="login.php">Sign In</a>
            </div>
        </form>
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

        function validatePassword() {
            const password = document.getElementById('password').value;
            const submitBtn = document.getElementById('submitBtn');
            
            // Requirements
            const lengthReq = document.getElementById('length-req');
            const uppercaseReq = document.getElementById('uppercase-req');
            const numberReq = document.getElementById('number-req');
            const symbolReq = document.getElementById('symbol-req');
            
            let isValid = true;
            
            // Check length (minimum 8 characters)
            if (password.length >= 8) {
                lengthReq.classList.remove('invalid');
                lengthReq.classList.add('valid');
                lengthReq.querySelector('.requirement-icon').textContent = '✓';
            } else {
                lengthReq.classList.remove('valid');
                lengthReq.classList.add('invalid');
                lengthReq.querySelector('.requirement-icon').textContent = '✗';
                isValid = false;
            }
            
            // Check uppercase
            if (/[A-Z]/.test(password)) {
                uppercaseReq.classList.remove('invalid');
                uppercaseReq.classList.add('valid');
                uppercaseReq.querySelector('.requirement-icon').textContent = '✓';
            } else {
                uppercaseReq.classList.remove('valid');
                uppercaseReq.classList.add('invalid');
                uppercaseReq.querySelector('.requirement-icon').textContent = '✗';
                isValid = false;
            }
            
            // Check number
            if (/[0-9]/.test(password)) {
                numberReq.classList.remove('invalid');
                numberReq.classList.add('valid');
                numberReq.querySelector('.requirement-icon').textContent = '✓';
            } else {
                numberReq.classList.remove('valid');
                numberReq.classList.add('invalid');
                numberReq.querySelector('.requirement-icon').textContent = '✗';
                isValid = false;
            }
            
            // Check symbol
            if (/[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(password)) {
                symbolReq.classList.remove('invalid');
                symbolReq.classList.add('valid');
                symbolReq.querySelector('.requirement-icon').textContent = '✓';
            } else {
                symbolReq.classList.remove('valid');
                symbolReq.classList.add('invalid');
                symbolReq.querySelector('.requirement-icon').textContent = '✗';
                isValid = false;
            }
            
            // Enable/disable submit button
            submitBtn.disabled = !isValid;
        }

        // Add event listener for password input
        document.getElementById('password').addEventListener('input', validatePassword);
        
        // Form validation on submit
        document.getElementById('registrationForm').addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            
            // Check all requirements
            const hasMinLength = password.length >= 8;
            const hasUppercase = /[A-Z]/.test(password);
            const hasNumber = /[0-9]/.test(password);
            const hasSymbol = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(password);
            
            if (!hasMinLength || !hasUppercase || !hasNumber || !hasSymbol) {
                e.preventDefault();
                alert('Password tidak memenuhi semua persyaratan!');
                return false;
            }
        });
    </script>
</body>
</html>