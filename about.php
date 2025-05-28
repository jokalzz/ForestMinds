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
  <link rel="stylesheet" href="./assets/css/about.css">

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
            <a href="contact.php" class="navbar-link" data-nav-toggler>Contact</a>
          </li>

        </ul>

      </nav>

      <div class="header-actions">

        <a href="javascript:history.back()" class="header-action-btn login-btn">

          <span class="span">Kembali</span>
        </a>

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

      <section class="hero" id="home" aria-label="hero" style="background-image: url('./assets/images/about-bg.jpg')">
  <div class="container">

    <div class="hero-content">

      <h1 class="section-subtitle">SILVA SUPHAA</h1>

      <h2 class="h1 hero-title">Kami adalah Team Silva Suphaa </h2>
      <h3 class="h3 hero-title">Kami Dari Universitas Sam Ratulangi</h3>
      <h3 class="h3 hero-title">Jurusan Teknik Informatika</h3>

    
     

    </div>

    <figure class="hero-banner">
      <img src="./assets/images/LINGKUNGAN.png" width="500" height="500" loading="lazy" alt="hero image" class="w-100">
      <img src="./assets/images/unsrat.png" width="318" height="352" loading="lazy" aria-hidden="true" class="abs-img abs-img-1">
      <img src="./assets/images/fatek.png" width="160" height="160" loading="lazy" aria-hidden="true" class="abs-img abs-img-2">
    </figure>

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

            <h2 class="h2 section-title">ASAL-USUL TEAM KITA</h2>

            <ul class="about-list">

              <li class="about-item">

               

                <div>
                  <h3 class="h3 item-title">Tujuan</h3>

                  <p class="item-text">
                  Tujuan dibentuknya tim ini untuk memenuhi tugas 
                  mata kuliah Pemrograman Web yang diberikan
                  yaitu membuat Aplikasi Berbasis Web.
                  </p>
                  <p class="item-text">
                Kami dari Universitas Sam Ratulangi Manado, Jurusan Teknik Informatika.
                Dengan susunan team:
                  </p>

                  <div class="susunan">
                  <a href="https://www.instagram.com/jokaligis/" class="teks-susunan-a">Jonathan G. Kaligis</a>
                  <h1 class="susunan-h1">
                    Sebagai frontend dan backend developer
                  </h1>

                  <div class="daniel">
                  <a href="https://www.instagram.com/jokalzz/" class="teks-susunan-a">Muh. Luhung Ardhana</a>
                  <h1 class="susunan-h1">
                  Sebagai Frontend dan Backend Developer
                  </h1>
                
                  
                <div class="atan">
                <a href="https://www.instagram.com/rivaldopaath/" class="teks-susunan-a">Hikaru Elbona Jones</a>
                  <h1 class="susunan-h1">
                  Sebagai Designer untuk website ini
                  </h1>
                  <div class="atan">
                <a href="https://www.instagram.com/rivaldopaath/" class="teks-susunan-a">Arkafali PF Genggong</a>
                  <h1 class="susunan-h1">
                  Sebagai Kreatif dalam Konten pada website
                  </h1>
                  <br>  
                </div>
                  </div>
                  </div>
                    </div>
                    </div>

          </div>
          <div class="about-content-kanan">

            <h2 class="h2 section-title">ASAL-USUL SILVA SUPHAA</h2>

            <ul class="about-list">

              <li class="about-item">

               

                <div>
                  <h3 class="h3 item-title">Silva Suphaa</h3>

                  <p class="item-text">                  
                  Silva Suphaa berasal dari dua bahasa, 
                  yaitu bahasa Latin dan bahasa Oromo. 
                  Kata "Silva" berasal dari bahasa Latin 
                  yang memiliki arti "hutan," sedangkan "Suphaa" 
                  berasal dari bahasa Oromo yang berarti "pemeliharaan." 
                  Jika digabungkan, Silva Suphaa memiliki makna mendalam 
                  sebagai "pemeliharaan hutan," yang mencerminkan tujuan mulia 
                  dari nama ini.
                  </p>
                  
                  <p class="item-text-asal">
                  Silva Suphaa adalah nama tim kami yang terinspirasi saat kami mengerjakan sebuah project pada semester sebelumnya,
                  yang sekarang kami tuangkan kepada sebuah website yang dirancang untuk 
                  menjadi wadah edukasi dan inspirasi bagi masyarakat, 
                  khususnya anak-anak Indonesia, dalam menjaga kelestarian 
                  hutan dan lingkungan sekitar. Melalui berbagai fitur 
                  dan informasi yang disediakan, Silva Suphaa berkomitmen 
                  untuk membantu menciptakan lingkungan yang lebih bersih, 
                  sehat, dan sejahtera. Inisiatif ini bertujuan membangun 
                  kesadaran dan rasa tanggung jawab sejak dini terhadap 
                  pentingnya hutan sebagai bagian tak terpisahkan dari 
                  kehidupan kita.
                  </p>
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
  </a>

  <!-- 
    - custom js link
  -->
  <script src="./assets/js/script.js" defer></script>
</body>

</html>