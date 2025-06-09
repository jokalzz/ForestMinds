<?php
include('./php/config.php');
session_start();

if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Ambil data video dari database
$videos_query = "SELECT * FROM videos ORDER BY created_at ASC";
$videos_result = mysqli_query($con, $videos_query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ForestLens</title>

  <!-- 
    - favicon
  -->
  <link rel="icon" href="./assets/images/silvasuphaa.png" type="image/png">


  <!-- 
    - custom css link
  -->
  <link rel="stylesheet" href="./assets/css/edukasi.css">

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
        </div>

        <ul class="navbar-list">

          <li class="navbar-item">
            <a href="beranda.php" class="navbar-link" data-nav-toggler>Beranda</a>
          </li>


          <li class="navbar-item">
            <a href="about.php" class="navbar-link" data-nav-toggler>Tentang Kami</a>
          </li>

          <li class="navbar-item">
            <a href="contact.php" class="navbar-link" data-nav-toggler>Kontak</a>
          </li>

        </ul>

      </nav>

      <div class="header-actions">

        <a href="beranda.php" class="header-action-btn login-btn">

          <span class="span">Kembali</span>
        </a>

      </div>

      <div class="overlay" data-nav-toggler data-overlay></div>

    </div>
  </header>

  <main>
    <article>
        </div>
      </section>
      <!-- 
        - #COURSE
      -->

      <section class="section course" id="courses" aria-label="course"
        style="background-image: url('./assets/images/edukasi-bg.jpg')">
        <div class="container">

        <img src="./assets/images/silvasuphaa.png" width="160" height="160" loading="lazy" alt="hero image" class="w-100-1">

          <p class="section-subtitle">Materi Edukasi</p>

          <h2 class="h2 section-title">Sudah Siap Untuk Belajar?</h2>

          <ul class="grid-list">
          <?php 
            $video_counter = 1;
            while($video = mysqli_fetch_assoc($videos_result)): 
            ?>
            <li>
              <div class="course-card">

                <figure class="card-banner">
                  <?php if(!empty($video['thumbnail'])): ?>
                    <img src="<?php echo htmlspecialchars($video['thumbnail']); ?>" width="370" height="270" loading="lazy"
                      alt="<?php echo htmlspecialchars($video['title']); ?>" class="img-cover">
                  <?php else: ?>
                    <img src="./assets/images/default-video-thumbnail.jpg" width="370" height="270" loading="lazy"
                      alt="<?php echo htmlspecialchars($video['title']); ?>" class="img-cover">
                  <?php endif; ?>
                  
                  <!-- Video Duration Overlay -->
                  <?php if(!empty($video['waktu_video'])): ?>
                    <div class="video-duration"><?php echo htmlspecialchars($video['waktu_video']); ?></div>
                  <?php endif; ?>
                </figure>

                <div class="card-content">

                  <ul class="card-meta-list">

                    <li class="card-meta-item">
                      <time datetime="<?php echo $video['created_at']; ?>" class="card-meta-text">
                        <?php echo date('d M Y', strtotime($video['created_at'])); ?>
                      </time>
                    </li>

                    <?php if(!empty($video['waktu_video'])): ?>
                    <li class="card-meta-item">
                      <span class="card-meta-text">
                        <ion-icon name="time-outline" aria-hidden="true"></ion-icon>
                        <?php echo htmlspecialchars($video['waktu_video']); ?>
                      </span>
                    </li>
                    <?php endif; ?>

                  </ul>

                  <h3 class="h3">
                    <a href="watch-video.php?id=<?php echo $video['id']; ?>" class="card-title">
                      <?php echo strtoupper(htmlspecialchars($video['title'])); ?>
                    </a>
                  </h3>

                  <div class="card-footer">

                    <div class="card-price">
                      <span class="span">Tonton Sekarang</span>
                    </div>

                  </div>

                </div>

              </div>
            </li>
            <?php 
            $video_counter++;
            endwhile; 
            ?>

            <?php if(mysqli_num_rows($videos_result) == 0): ?>
            <li>
              <div class="course-card">
                <div class="card-content" style="text-align: center; padding: 2rem;">
                  <h3 class="h3">Belum Ada Video</h3>
                  <p>Video edukasi akan segera tersedia.</p>
                </div>
              </div>
            </li>
            <?php endif; ?>

          </ul>

          <a class="btn btn-primary">
            <span class="span">SELAMAT BELAJAR!</span>
          </a>
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
  </a>
  <!-- 
    - custom js link
  -->
  <script src="./assets/js/script.js" defer></script>
</body>

</html>