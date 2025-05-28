<?php
include('./php/config.php');

session_start();
if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
    
}
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
  <link rel="stylesheet" href="./assets/css/style.css">

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
            <a href="prediksi.php" class="navbar-link" data-nav-toggler></a>
          </li>

          <li class="navbar-item">
            <a href="#home" class="navbar-link" data-nav-toggler>Beranda</a>
          </li>

          <li class="navbar-item">
            <a href="edukasi.php" class="navbar-link" data-nav-toggler>Kursus</a>
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
            <a href="edit.php" class="social-link-a">
                Change Profile
            </a>
            </div>

        <div class="logot">
      <a href="php/logout.php"> <button class="btn">Log Out</button> </a>
      </div>
        <button class="header-action-btn nav-open-btn" aria-label="Open menu" data-nav-toggler>
          <ion-icon name="menu-outline"></ion-icon>
        </button>

      </div>

      <div class="overlay" data-nav-toggler data-overlay></div>

    </div>
  </header>

  <main>
    <article>
      
      <!-- 
        - #HERO
      -->

      <section class="hero" id="home" aria-label="hero" style="background-image: url('./assets/images/hero-bg.jpg')">
  <div class="container">

    <div class="hero-content">

    <h1>
    <span class="section-subtitle">SELAMAT DATANG,</span> 
    <span class="h1-1">  <?php echo $_SESSION['username']; ?> !</span>
  </h1>
      <h2 class="h1 hero-title">Mari Mulai Menjaga Dan Melindungi Lingkungan</h2>

      <p class="hero-text">
        Mulai sekarang untuk mempelajari lebih lanjut tentang cara menjaga dan melindungi lingkungan sekitar.
      </p>

      <a href="edukasi.php" class="btn btn-primary">
        <span class="span">Mulai Sekarang</span>
        <ion-icon name="arrow-forward-outline" aria-hidden="true"></ion-icon>
      </a>

    </div>

    <figure class="hero-banner">
      <img src="./assets/images/hero-banner.png" width="500" height="500" loading="lazy" alt="hero image" class="w-100">
      <img src="./assets/images/hero-abs-1.png" width="318" height="352" loading="lazy" aria-hidden="true" class="abs-img abs-img-1">
      <img src="./assets/images/hero-abs-2.png" width="160" height="160" loading="lazy" aria-hidden="true" class="abs-img abs-img-2">
    </figure>

  </div>
</section>

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

</body>

</html>