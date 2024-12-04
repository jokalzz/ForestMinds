<?php 
session_start();
include("php/config.php");

// Cek apakah pengguna sudah login
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

// Ambil ID pengguna dari session
$user_id = $_SESSION['user_id'];
$message = ""; // Variabel untuk menyimpan pesan
$error_message = ""; // Variabel untuk menyimpan pesan error

// Jika form dikirim
if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $age = $_POST['age'];

    // Cek apakah username sudah ada di database
    $check_query = mysqli_query($con, "SELECT * FROM users WHERE Username='$username' AND Id != $user_id");
    if(mysqli_num_rows($check_query) > 0){
        $error_message = "Username sudah digunakan. Silakan pilih username lain.";
    } else {
        // Query update ke database jika username belum ada
        $edit_query = mysqli_query($con, "UPDATE users SET Username='$username', Email='$email', Age='$age' WHERE Id=$user_id") 
                      or die("Terjadi kesalahan saat memperbarui data!");

        // Jika update berhasil
        if($edit_query){
            // Perbarui nama pengguna di session
            $_SESSION['username'] = $username;
            $message = "Profile updated successfully!";
        }
    }
} 

// Ambil data pengguna untuk ditampilkan di form
$query = mysqli_query($con, "SELECT * FROM users WHERE Id=$user_id");
$result = mysqli_fetch_assoc($query);

$res_Uname = $result['Username'];
$res_Email = $result['Email'];
$res_Age = $result['Age'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Change Profile</title>
</head>
<body>


    <div class="container">
        <div class="box form-box">
            <header>Change Profile</header>
            
            <!-- Tampilkan pesan sukses jika ada -->
            <?php if($message): ?>
                <div class="message success">
                    <p><?php echo $message; ?></p>
                </div>
            <?php endif; ?>

            <!-- Tampilkan pesan error jika ada -->
            <?php if($error_message): ?>
                <div class="message error">
                    <p><?php echo $error_message; ?></p>
                </div>
            <?php endif; ?>

            <form action="" method="post">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($res_Uname); ?>" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($res_Email); ?>" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="age">Age</label>
                    <input type="number" name="age" id="age" value="<?php echo htmlspecialchars($res_Age); ?>" min="10" autocomplete="off" required>
                </div>

                <div class="field">
                    
                    <input type="submit" class="btn" name="submit" value="Update">
          
                </div>
                <div class="field">
                    <a href="beranda.php" class="back-button-a">
                    <span>←</span> Kembali
                        </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
