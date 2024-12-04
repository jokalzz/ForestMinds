<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Di sini Anda bisa menambahkan logika untuk mengirim email atau menyimpan pesan

    // Tampilkan pesan konfirmasi
    echo "<!DOCTYPE html>
    <html lang='id'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Pesan Terkirim</title>
        <link rel='icon' href='./assets/images/silvasuphaa.png' type='image/png'>
        <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css'>
        <link rel='stylesheet' href='./assets/css/send_message.css'>
    </head>
    <body>
        <div class='container'>
            <h1>Terima Kasih, $name!</h1>
            <p><strong>Pesan Anda telah terkirim.</strong></p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Pesan:</strong> $message</p>
            <a href='javascript:history.back()' class='btn btn-primary'>Kembali ke Kontak</a>
        </div>

        <script src='https://code.jquery.com/jquery-3.5.1.slim.min.js'></script>
        <script src='https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js'></script>
        <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js'></script>
    </body>
    </html>";
} else {
    // Jika tidak ada data POST, arahkan kembali ke halaman kontak
    header("Location: contact.php");
    exit();
}
?>

