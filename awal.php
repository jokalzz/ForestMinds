<?php 
session_start();

// Redirect jika sudah login
if(isset($_SESSION['user_id'])) {
    header("Location: beranda.php");
    exit();
}

include("php/config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="./assets/images/silvasuphaa.png" type="image/png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <script>
        // Script untuk menangani klik di halaman dan mengarahkan ke halaman lain
        document.addEventListener('click', function() {
            window.location.href = 'index.php'; // Ganti dengan URL halaman tujuan
        });
    </script>
</head>
<body class="ink">
    <div class="banner">
      <div class="content">
        <div class="title">WELCOME</div>
        <p class="p-welcome">click anywhere</p>
      </div>
    </div>
</body>
</html>
