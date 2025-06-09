<?php
include('./php/config.php');
session_start();

// Pastikan session valid dan user_id ada
if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Dapatkan ID dari URL. Jika tidak ada, hentikan program.
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $video_id = intval($_GET['id']);
} else {
    die("Error: ID Video tidak ditemukan atau tidak valid.");
}

// Proses posting komentar
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_comment'])) {
    $comment_text = htmlspecialchars(trim($_POST['comment_text']), ENT_QUOTES, 'UTF-8');
    $user_id = $_SESSION['user_id'];

    if (!empty($comment_text)) {
        $insert_query = "INSERT INTO comments (user_id, video_id, comment_text, created_at) VALUES (?, ?, ?, NOW())";
        $stmt_insert = mysqli_prepare($con, $insert_query);
        mysqli_stmt_bind_param($stmt_insert, 'iis', $user_id, $video_id, $comment_text);
        
        if (mysqli_stmt_execute($stmt_insert)) {
            header("Location: watch-video.php?id=" . $video_id);
            exit();
        } else {
            $error_message = "Gagal menambahkan komentar.";
        }
    }
}

// Ambil detail video dari database
$query = "SELECT title, description, created_at, video_url, thumbnail FROM videos WHERE id = ?";
$stmt_video = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($stmt_video, "i", $video_id);
mysqli_stmt_execute($stmt_video);
$result_video = mysqli_stmt_get_result($stmt_video);

if ($video = mysqli_fetch_assoc($result_video)) {
    // Data video ditemukan
} else {
    die("Video tidak ditemukan.");
}

// Ambil komentar untuk video ini
$comments_query = "SELECT c.*, u.username FROM comments c JOIN users u ON c.user_id = u.id WHERE c.video_id = ? ORDER BY c.created_at DESC";
$stmt_comments = mysqli_prepare($con, $comments_query);
mysqli_stmt_bind_param($stmt_comments, 'i', $video_id);
mysqli_stmt_execute($stmt_comments);
$comments_result = mysqli_stmt_get_result($stmt_comments);


// --- PERUBAHAN DIMULAI DI SINI ---

/**
 * Fungsi untuk mengubah URL YouTube standar menjadi URL embed.
 * @param string $url URL video yang diambil dari database.
 * @return string URL yang sudah siap untuk di-embed di iframe.
 */
function getEmbedUrl($url) {
    // Cek apakah ini URL YouTube
    if (preg_match('/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $url, $matches)) {
        // Jika cocok, ekstrak ID video dan buat URL embed
        $videoId = $matches[1];
        return 'https://www.youtube.com/embed/' . $videoId;
    }
    
    // Jika bukan URL YouTube, kembalikan URL asli (untuk video lain)
    return $url;
}

// Ubah URL dari database menjadi URL embed
$embed_url = getEmbedUrl($video['video_url']);

// --- PERUBAHAN SELESAI DI SINI ---

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($video['title']); ?> - ForestLens</title>
    <link rel="icon" href="./assets/images/silvasuphaa.png" type="image/png">
    <link rel="stylesheet" href="./assets/css/watch-video.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body id="top">
    <header class="header" data-header>
        <div class="container">
            <h1><a href="#" class="logo">ForestLens</a></h1>
            <nav class="navbar" data-navbar>
                <div class="navbar-top">
                    <a href="#" class="logo">ForestLens</a>
                    <button class="nav-close-btn" aria-label="Close menu" data-nav-toggler><ion-icon name="close-outline"></ion-icon></button>
                </div>
                <ul class="navbar-list">
                    <li class="navbar-item"><a href="index.php" class="navbar-link" data-nav-toggler>Beranda</a></li>
                    <li class="navbar-item"><a href="edukasi.php" class="navbar-link" data-nav-toggler>Course</a></li>
                    <li class="navbar-item"><a href="contact.php" class="navbar-link" data-nav-toggler>Contact</a></li>
                </ul>
            </nav>
            <div class="header-actions">
                <a href="edukasi.php" class="header-action-btn login-btn"><span class="span">Kembali</span></a>
                <button class="header-action-btn nav-open-btn" aria-label="Open menu" data-nav-toggler><ion-icon name="menu-outline"></ion-icon></button>
            </div>
            <div class="overlay" data-nav-toggler data-overlay></div>
        </div>
    </header>

    <article>
        <section class="hero" id="home" aria-label="hero" style="background-image: url('./assets/images/wallpaperz.jpg')">
            <div class="container-video">
                <section class="watch-video">
                    <div class="video-container">
                        <div class="video">
                            <h3 class="title-atas"><?php echo htmlspecialchars($video['title']); ?></h3>
                            <div class="video-player-wrapper" style="position: relative; padding-bottom: 56.25%; height: 0;">
                                <iframe
                                    
                                    src="<?php echo htmlspecialchars($embed_url); ?>"

                                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen
                                ></iframe>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </section>

        <section class="section about" id="about" aria-label="about">
            <div class="container">
                <div class="about-content-kiri">
                    <br>
                    <h2 class="h2 section-title">Pembahasan</h2>
                    <br>
                    <p class="item-text" style="white-space: pre-wrap;"><?php echo htmlspecialchars($video['description']); ?></p>
                </div>
                
                <div class="about-content-kanan">
                    <div class="comment-section">
                        <br>
                        <h3 class="h2 item-title">Berikan Komentar Anda:</h3>
                        <div class="comment-form">
                            <form method="POST" action="watch-video.php?id=<?php echo $video_id; ?>">
                                <textarea name="comment_text" required placeholder="Tulis komentar Anda..."></textarea>
                                <button type="submit" name="submit_comment">Kirim Komentar</button>
                            </form>
                        </div>
                        <div class="komenz">
                            <?php if ($comments_result->num_rows == 0): ?>
                                <p>Jadilah yang pertama berkomentar!</p>
                            <?php else: ?>
                                <?php while ($row = $comments_result->fetch_assoc()): ?>
                                    <div class="comment-wrapper">
                                        <p class="user-komen"><strong><?php echo htmlspecialchars($row['username']); ?>:</strong></p>
                                        <p class="hasil-komen"><?php echo nl2br(htmlspecialchars($row['comment_text'])); ?></p>
                                    </div>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </div>
                    </div> 
                </div>
            </div>
        </section>
    </article>

    <footer class="footer">
    </footer>

    <a href="#top" class="back-top-btn" aria-label="Back to top" data-back-top-btn><ion-icon name="arrow-up"></ion-icon></a>
    
    <script src="./assets/js/script.js" defer></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>