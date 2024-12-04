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
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ForestMinds</title>

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
<div id="loader-wrapper">
        <div id="loader"></div>

        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>
  <main>
    <article>

      <!-- 
        - #HERO
      -->
      
      <section class="hero" id="home" aria-label="hero" style="background-image: url('./assets/css/bg.jpg')">

      <div class="container">

    <div class="hero-content-a">

      <h1 class="section-substitle">SELAMAT DATANG</h1>

      <h2 class="h2-hero-title">Mari Menjaga dan Melindungi Lingkungan Sekitar</h2>

      <p class="hero-text-a">
        Pelajari lebih lanjut tentang cara menjaga dan melindungi lingkungan sekitar.
      </p>

      <a href="beranda.php" class="btn btn-primary-a">
      <ion-icon name="arrow-back-outline" aria-hidden="true"></ion-icon>
        <span class="span">Mulai Sekarang</span>
      </a>

      
    </div>

    <a href="awal.php" class="hero-banner-link">
  <figure class="hero-banner-a">
    <img src="./assets/images/silvasuphaa.png" width="360" height="360" loading="lazy" alt="hero image" class="w-100-1">
  </figure>
</a>


  </div>
  
</section>
</div>
     <!-- 
        - #COURSE
      -->

      <section class="section course" id="courses" aria-label="course"
        style="background-image: url('./assets/images/courses-bg.jpg')">
    
        <div class="container">

          <p class="section-subtitle-a-a">Materi Edukasi</p>

          <h2 class="h2-2">Beberapa Materi Edukasi Kami</h2>

          <ul class="grid-list">

            <li>
              <div class="course-card">

                <figure class="card-banner">
                  <img src="./assets/images/manusia-mencegah.jpg" width="370" height="270" loading="lazy"
                    alt="Competitive Strategy law for all students" class="img-cover">
                </figure>

                <div class="card-content">

                  <ul class="card-meta-list">

                    <li class="card-meta-item">
                      <ion-icon name="time-outline" aria-hidden="true"></ion-icon>

                      <time datetime="PT18H15M44S" class="card-meta-text">03m 58s</time>
                    </li>

                  </ul>

                  <h3 class="h3">
                    <a href="edukasi.php" class="card-title">BISAKAH MANUSIA MENCEGAH KERUSAKAN BUMI?</a>
                  </h3>


                  <div class="card-footer">

                    <div class="card-price">
                      <span class="span">Tonton Sekarang</span>
                    </div>

                    <div class="card-meta-item">
                      <ion-icon name="people-outline" aria-hidden="true"></ion-icon>

                      <span class="card-meta-text">47 Views</span>
                    </div>

                  </div>

                </div>

              </div>
            </li>

            <li>
              <div class="course-card">

                <figure class="card-banner">
                  <img src="./assets/images/hutan-tidak-ada.jpg" width="370" height="270" loading="lazy"
                    alt="Machine Learning A-Z: Hands-On Python and java" class="img-cover">
                </figure>

                <div class="card-content">

                  <ul class="card-meta-list">


                    <li class="card-meta-item">
                      <ion-icon name="time-outline" aria-hidden="true"></ion-icon>

                      <time datetime="PT18H15M44S" class="card-meta-text">04m 16s</time>
                    </li>

                  </ul>

                  <h3 class="h3">
                    <a href="edukasi.php" class="card-title">APA JADINYA JIKA TIDAK ADA HUTAN DI DUNIA?</a>
                  </h3>


                  <div class="card-footer">

                    <div class="card-price">
                      <span class="span">Tonton Sekarang</span>
                    </div>

                    <div class="card-meta-item">
                      <ion-icon name="people-outline" aria-hidden="true"></ion-icon>

                      <span class="card-meta-text">65 Views</span>
                    </div>

                  </div>

                </div>

              </div>
            </li>

            <li>
              <div class="course-card">

                <figure class="card-banner">
                  <img src="./assets/images/benua-sampah.jpg" width="370" height="270" loading="lazy"
                    alt="Achieving Advanced in Insights with Big" class="img-cover">
                </figure>

                <div class="card-content">

                  <ul class="card-meta-list">

                    <li class="card-meta-item">
                      <ion-icon name="time-outline" aria-hidden="true"></ion-icon>

                      <time datetime="PT18H15M44S" class="card-meta-text">04m 37s</time>
                    </li>

                  </ul>

                  <h3 class="h3">
                    <a href="edukasi.php" class="card-title">SEBERAPA BANYAK SAMPAH PLASTIK DI DUNIA</a>
                  </h3>

                 
                  <div class="card-footer">

                    <div class="card-price">
                      <span class="span">Tonton Sekarang</span>
                    </div>

                    <div class="card-meta-item">
                      <ion-icon name="people-outline" aria-hidden="true"></ion-icon>

                      <span class="card-meta-text">42 Views</span>
                    </div>

                  </div>

                </div>

              </div>
            </li>

            <li>
              <div class="course-card">

                <figure class="card-banner">
                  <img src="./assets/images/polusi.jpg" width="370" height="270" loading="lazy"
                    alt="Education Makes A Person A Responsible Citizen" class="img-cover">
                </figure>

                <div class="card-content">

                  <ul class="card-meta-list">


                    <li class="card-meta-item">
                      <ion-icon name="time-outline" aria-hidden="true"></ion-icon>

                      <time datetime="PT18H15M44S" class="card-meta-text">03m 05s</time>
                    </li>

                  </ul>

                  <h3 class="h3">
                    <a href="edukasi.php" class="card-title">POLUSI UDARA – BAGAIMANA DAMPAKNYA TERHADAP KESEHATAN KITA</a>
                  </h3>

                  <div class="card-footer">

                    <div class="card-price">
                      <span class="span">Tonton Sekarang</span>
                    </div>

                    <div class="card-meta-item">
                      <ion-icon name="people-outline" aria-hidden="true"></ion-icon>

                      <span class="card-meta-text">46 Views</span>
                    </div>

                  </div>

                </div>

              </div>
            </li>

            <li>
              <div class="course-card">

                <figure class="card-banner">
                  <img src="./assets/images/pemanasan global.jpg" width="370" height="270" loading="lazy"
                    alt="Building A Better World One Student At A Time" class="img-cover">
                </figure>

                <div class="card-content">

                  <ul class="card-meta-list">


                    <li class="card-meta-item">
                      <ion-icon name="time-outline" aria-hidden="true"></ion-icon>

                      <time datetime="PT18H15M44S" class="card-meta-text">05m 39s</time>
                    </li>

                  </ul>

                  <h3 class="h3">
                    <a href="edukasi.php" class="card-title">APAKAH KITA BISA MENGHENTIKAN PEMANASAN GLOBAL?</a>
                  </h3>

                  <div class="card-footer">

                    <div class="card-price">
                      <span class="span">Tonton Sekarang</span>
                    </div>

                    <div class="card-meta-item">
                      <ion-icon name="people-outline" aria-hidden="true"></ion-icon>

                      <span class="card-meta-text">91 Views</span>
                    </div>

                  </div>

                </div>

              </div>
            </li>

            <li>
              <div class="course-card">

                <figure class="card-banner">
                  <img src="./assets/images/hutan-gundul.jpg" width="370" height="270" loading="lazy"
                    alt="Education is About Forming Faithful Disciples" class="img-cover">
                </figure>


                <div class="card-content">

                  <ul class="card-meta-list">

                    <li class="card-meta-item">
                      <ion-icon name="time-outline" aria-hidden="true"></ion-icon>

                      <time datetime="PT18H15M44S" class="card-meta-text">03m 34s</time>
                    </li>

                  </ul>

                  <h3 class="h3">
                    <a href="edukasi.php" class="card-title">MENJAGA HUTAN UNTUK MELINDUNGI OZON DAN MASA DEPAN KITA</a>
                  </h3>



                  <div class="card-footer">

                    <div class="card-price">
                      <span class="span">Tonton Sekarang</span>
                    </div>

                    <div class="card-meta-item">
                      <ion-icon name="people-outline" aria-hidden="true"></ion-icon>

                      <span class="card-meta-text">22 Views</span>
                    </div>

                  </div>

                </div>

              </div>
            </li>

          </ul>

          <a href="login.php" class="btn btn-primary">
            <span class="span">View All Courses</span>

            
          <ion-icon name="arrow-forward-outline" aria-hidden="true"></ion-icon>
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

        <a href="#" class="logobottom">ForestMinds</a>

        <p class="section-text">
        ForestMinds adalah sebuah langkah awal menuju dunia yang hijau.
        </p>

        <ul class="social-list">

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-instagram"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-discord"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="social-link">
              <ion-icon name="logo-linkedin"></ion-icon>
            </a>
          </li>

        </ul>

      </div>

    </div>

    <div class="footer-bottom text-center">
      <p class="copyright">
        Copyright 2024 ForestMinds. All Rights Reserved.
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
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  <script src="js/plugins.js"></script>
  <script>
        $(window).on("load", function() {
            $('body').addClass('loaded');
        });
    </script>
</body>

</html>