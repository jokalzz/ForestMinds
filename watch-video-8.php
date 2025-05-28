<?php
include('./php/config.php');

session_start();

// Pastikan session valid dan user_id ada
if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Tambahkan validasi user
$check_user = $con->prepare("SELECT Id FROM users WHERE Id = ?");
$check_user->bind_param("s", $user_id);
$check_user->execute();
$result = $check_user->get_result();

if($result->num_rows == 0) {
    // Jika user tidak ditemukan
    session_destroy();
    header("Location: index.php");
    exit();
}

$video_id = isset($_GET['video_id']) ? intval($_GET['video_id']) : 8;

// Cek apakah ada pesan sukses di session
$success_message = isset($_SESSION['comment_success']) ? $_SESSION['comment_success'] : '';
unset($_SESSION['comment_success']);

// Fetch video details from the database
$query = "SELECT * FROM videos WHERE id = ?";
$stmt = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($stmt, "i", $video_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($video = mysqli_fetch_assoc($result)) {
    $video_title = $video['title'];
    $video_description = $video['description'];
    $video_date = date('d-m-Y', strtotime($video['created_at']));
    $video_url = $video['video_url'];
    $poster_url = isset($video['thumbnail']) ? $video['thumbnail'] : '../images/default-poster.png';
} else {
    die("Video not found.");
}

// Proses posting komentar
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_comment'])) {
    $comment_text = htmlspecialchars(trim($_POST['comment_text']), ENT_QUOTES, 'UTF-8');
    $user_id = $_SESSION['user_id'];

    // Insert komentar ke database
    $insert_query = "INSERT INTO comments (user_id, video_id, comment_text, created_at) 
                     VALUES (?, ?, ?, NOW())";
    $stmt = mysqli_prepare($con, $insert_query);
    mysqli_stmt_bind_param($stmt, 'sss', $user_id, $video_id, $comment_text);
    
    if (mysqli_stmt_execute($stmt)) {
        // Set session variable untuk pesan sukses
        $_SESSION['comment_success'] = "Komentar berhasil ditambahkan!";
        
        // Redirect ke halaman yang sama untuk mencegah submit ulang
        header("Location: " . $_SERVER['PHP_SELF'] . "?video_id=" . $video_id);
        exit();
    } else {
        // Tangani error jika gagal
        $error_message = "Gagal menambahkan komentar: " . mysqli_stmt_error($stmt);
    }
}

// Ambil komentar
$comments_query = "SELECT c.*, u.username 
                   FROM comments c
                   JOIN users u ON c.user_id = u.id
                   WHERE c.video_id = ?
                   ORDER BY c.created_at DESC";
$stmt = mysqli_prepare($con, $comments_query);
mysqli_stmt_bind_param($stmt, 's', $video_id);
mysqli_stmt_execute($stmt);
$comments_result = mysqli_stmt_get_result($stmt);
?>

<!-- Di bagian HTML, tambahkan pesan sukses jika ada -->
<?php if (!empty($success_message)): ?>
    <div class="alert alert-success"><?php echo $success_message; ?></div>
<?php endif; ?>

<?php if (!empty($error_message)): ?>
    <div class="alert alert-danger"><?php echo $error_message; ?></div>
<?php endif; ?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Video Pembelajaran</title>

  <!-- 
    - favicon
  -->
  <link rel="icon" href="./assets/images/silvasuphaa.png" type="image/png">


  <!-- 
    - custom css link
  -->
  <link rel="stylesheet" href="./assets/css/watch-video.css">

  <!-- 
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <!-- 
    - preload images
  -->
  <link rel="preload" as="image" href="./assets/images/hero-banner.png">
  <link rel="preload" as="image" href="./assets/images/hero-abs-1.png" media="min-width(768px)">
  <link rel="preload" as="image" href="./assets/images/hero-abs-2.png" media="min-width(768px)">

</head>

<body id="top">
  <!-- 
    - #HEADER
  -->

  <header class="header" data-header>
    <div class="container">

      <h1>
        <a href="#" class="logo">ForestLens</a>
      </h1>

      <nav class="navbar" data-navbar>

        <div class="navbar-top">
          <a href="#" class="logo">ForestLens</a>

          <button class="nav-close-btn" aria-label="Close menu" data-nav-toggler>
            <ion-icon name="close-outline"></ion-icon>
          </button>
        </div>

        <ul class="navbar-list">

          <li class="navbar-item">
            <a href="index.php" class="navbar-link" data-nav-toggler>Beranda</a>
          </li>

          <li class="navbar-item">
            <a href="edukasi.php" class="navbar-link" data-nav-toggler>Course</a>
          </li>
          
          <li class="navbar-item">
            <a href="contact.php" class="navbar-link" data-nav-toggler>Contact</a>
          </li>

        </ul>

      </nav>

      <div class="header-actions">

        <a href="edukasi.php" class="header-action-btn login-btn">

          <span class="span">Kembali</span>
        </a>

        <button class="header-action-btn nav-open-btn" aria-label="Open menu" data-nav-toggler>
          <ion-icon name="menu-outline"></ion-icon>
        </button>

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
              <h3 class="title-atas"><?php echo $video['title']; ?></h3>
              <video
              src="<?php echo htmlspecialchars($video_url); ?>"
              controls
              poster="<?php echo htmlspecialchars($poster_url); ?>"
              id="video"
              ></video>
           
        </section>
      </div>
    </section>
  

  </div>
</section>

        </div>
      </section>

      <!-- 
        - #CATEGORY
      -->

     
     
      <div class="container-category">

      </div>




      <!-- 
        - #ABOUT
      -->

      <section class="section about" id="about" aria-label="about">
        <div class="container">


          <div class="about-content-kiri">

            <h2 class="h2 section-title">Pembahasan</h2>

            <ul class="about-list">

              <li class="about-item">

                <div>
                  <h3 class="h3 item-title">Berikut Pembahasannya:</h3>
                  <h4 class="h4"> 1. Peran Hutan Bagi Kehidupan </h4>
                  <p class="item-text">
Hutan disebut "paru-paru dunia" karena menghasilkan udara bersih untuk bernafas.
Hutan adalah habitat bagi 80% binatang dan tumbuhan di daratan.
Hutan membantu menjaga siklus hujan, suhu bumi, dan ketersediaan air bersih.
Banyak produk kehidupan sehari-hari berasal dari hutan.
                  </p>
                  <h4 class="h4-2"> 2. Dampak Kehilangan Hutan </h4>
                  <p class="item-text">
Punahnya flora dan fauna yang khas.
Siklus hujan menjadi kacau, dunia semakin panas.
Berkurangnya air bersih dan udara bersih, menyebabkan gangguan pernapasan.
Kehidupan manusia menjadi sulit, hampir tidak mungkin bertahan dengan baik tanpa hutan.
                  </p>
                  <h4 class="h4-2"> 3. Kondisi Hutan Indonesia </h4>
                  <p class="item-text">
                  Indonesia adalah salah satu negara dengan hutan terbesar di dunia, tapi luas hutan terus berkurang.
Penyebab utama: kebakaran hutan yang disengaja oleh perusahaan rakus untuk membuka lahan.
                  </p>
                  <h4 class="h4-2"> 4. Situasi Global </h4>
                  <p class="item-text">
                  Setiap tahun, 15 miliar pohon ditebang di seluruh dunia.
                  Jika laju kerusakan hutan tidak dihentikan, dalam 200 tahun seluruh pohon di bumi bisa habis.
                  </p>
                  <h4 class="h4-2"> 5. Solusi untuk Menjaga Hutan </h4>
                  <p class="item-text">
Gotong-royong mencegah kebakaran dan pembukaan lahan ilegal.
Membeli produk yang berasal dari hutan yang dikelola secara berkelanjutan.
Meningkatkan kesadaran masyarakat tentang pentingnya menjaga hutan.
Mendukung organisasi yang peduli terhadap pelestarian hutan.
                  </p>
                </div>
                
          </div>
          
           <!-- YANG KANAN -->
          <div class="about-content-kanan">


            <ul class="about-list">

              <li class="about-item">

              <div class="comment-section">
  <h3 class="h2 item-title">Berikan Komentar Anda:</h3>
  
  <div class="comment-form">
    <!-- Form untuk komentar -->
    <form method="POST" action="">
      <textarea name="comment_text" required placeholder="Tulis komentar Anda..."></textarea>
      <button type="submit" name="submit_comment">Kirim Komentar</button>
    </form>
  </div>

  <div class="komenz">
    <?php if ($comments_result->num_rows == 0): ?>
        <div id="no-comments-placeholder" class="no-comments">
            <p>No comments yet. Be the first to comment</p>
        </div>
    <?php else: ?>
        <?php while ($row = $comments_result->fetch_assoc()): ?>
            <div class="comment-wrapper">
                <p class="user-komen">
                    <strong>
                        <?php echo htmlspecialchars($row['username']); ?>:
                    </strong>
                </p>
                <p class="hasil-komen">
                    <?php echo nl2br(htmlspecialchars($row['comment_text'])); ?>
                </p>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>
</div>
          </div> 
        </div>
      </section>


<!-- 
  - #FOOTER
-->

<footer class="footer">
  <div class="container">

    <div class="footer-top text-center">

      <div class="footer-brand">

        <a href="#" class="logobottom">ForestLens</a>

        <p class="section-text">
        ForestLens adalah sebuah langkah awal menuju dunia yang hijau.
        </p>

      </div>

    </div>

    <div class="footer-bottom text-center">
      <p class="copyright">
        Copyright 2024 ForestLens. All Rights Reserved.
      </p>
    </div>
  </div>
</footer>





  <!-- 
    - #BACK TO TOP
  -->

  <a href="#top" class="back-top-btn" aria-label="Back to top" data-back-top-btn>
    <ion-icon name="arrow-up"></ion-icon>
  </a>





  <!-- 
    - custom js link
  -->
  <script src="./assets/js/script.js" defer></script>

  <!-- 
    - ionicon link
  -->
  <script>
document.addEventListener('DOMContentLoaded', function() {
  const commentInput = document.getElementById('comment-input');
  const submitButton = document.getElementById('submit-comment');
  const commentsContainer = document.getElementById('comments-container');

  // Tambahkan elemen untuk menampilkan pesan error
  const errorMessage = document.createElement('div');
  errorMessage.id = 'error-message';
  errorMessage.style.color = 'red';
  errorMessage.style.display = 'none';
  commentInput.parentNode.insertBefore(errorMessage, commentInput.nextSibling);

  submitButton.addEventListener('click', function() {
    const commentText = commentInput.value.trim();
    
    if (commentText === '') {
      // Tampilkan pesan error jika komentar kosong
      errorMessage.textContent = 'Komentar tidak boleh kosong!';
      errorMessage.style.display = 'block';
      commentInput.focus(); // Fokus kembali ke input
      return; // Hentikan proses pengiriman
    }
    
    // Sembunyikan pesan error jika sebelumnya ada
    errorMessage.style.display = 'none';
    
    // Buat elemen komentar baru
    const commentElement = document.createElement('div');
    commentElement.className = 'comment';
    
    // Tambahkan teks komentar dengan white-space: pre-wrap untuk mempertahankan format
    const textElement = document.createElement('div');
    textElement.className = 'comment-text';
    textElement.textContent = commentText;
    
    // Tambahkan timestamp
    const timestamp = document.createElement('div');
    timestamp.className = 'comment-timestamp';
    timestamp.textContent = new Date().toLocaleString();
    
    // Gabungkan elemen-elemen
    commentElement.appendChild(textElement);
    commentElement.appendChild(timestamp);
    
    // Tambahkan komentar ke container
    commentsContainer.insertBefore(commentElement, commentsContainer.firstChild);
    
    // Bersihkan input
    commentInput.value = '';
  });

  // Tambahan: Sembunyikan pesan error saat pengguna mulai mengetik
  commentInput.addEventListener('input', function() {
    errorMessage.style.display = 'none';

    const noCommentsPlaceholder = document.getElementById('no-comments-placeholder');
      if (noCommentsPlaceholder) {
        noCommentsPlaceholder.remove();
      }
      
      // Scroll ke bawah setelah menambah komentar
      commentsContainer.scrollTop = commentsContainer.scrollHeight;

  });
});
</script>
</body>

</html>