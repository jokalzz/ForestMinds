
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
  <title>ForestMinds</title>

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

<!-- Page Loader -->
<div id="loader-wrapper">
        <div id="loader"></div>

        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>

  <!-- 
    - #HEADER
  -->

  <header class="header" data-header>
    <div class="container">

      <h1>
        <a href="#" class="logo">ForestMinds</a>
      </h1>

      <nav class="navbar" data-navbar>

        <div class="navbar-top">
          <a href="#" class="logo">ForestMinds</a>

          <button class="nav-close-btn" aria-label="Close menu" data-nav-toggler>
            <ion-icon name="close-outline"></ion-icon>
          </button>
        </div>

        <ul class="navbar-list">

          <li class="navbar-item">
            <a href="beranda.php" class="navbar-link" data-nav-toggler>Beranda</a>
          </li>


          <li class="navbar-item">
            <a href="about.php" class="navbar-link" data-nav-toggler>Tentang Kami</a>
          </li>

          <li class="navbar-item">
            <a href="contact.php" class="navbar-link" data-nav-toggler>Contact</a>
          </li>

        </ul>

      </nav>

      <div class="header-actions">

        <a href="beranda.php" class="header-action-btn login-btn">

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

      

        </div>
      </section>

      <!-- 
        - #CATEGORY
      -->




      <!-- 
        - #ABOUT
      -->






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

            <li>
              <div class="course-card">

                <figure class="card-banner">
                  <img src="./assets/images/hutan-tidak-ada.jpg" width="370" height="270" loading="lazy"
                    alt="Competitive Strategy law for all students" class="img-cover">
                </figure>

                <div class="card-actions">

                  <button class="whishlist-btn" aria-label="Add to whishlist" data-whish-btn>
                    <ion-icon name="heart"></ion-icon>
                  </button>

                </div>

                <div class="card-content">

                  <ul class="card-meta-list">

                  

                    <li class="card-meta-item">
                      <ion-icon name="time-outline" aria-hidden="true"></ion-icon>

                      <time datetime="PT18H15M44S" class="card-meta-text">04m 16s</time>
                    </li>

                  </ul>

                  <h3 class="h3">
                    <a href="watch-video-1.php" class="card-title">APA JADINYA JIKA TIDAK ADA HUTAN DI DUNIA?</a>
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
                  <img src="./assets/images/ini-masalahnya.jpg" width="370" height="270" loading="lazy"
                    alt="Competitive Strategy law for all students" class="img-cover">
                </figure>

                <div class="card-actions">

                  <button class="whishlist-btn" aria-label="Add to whishlist" data-whish-btn>
                    <ion-icon name="heart"></ion-icon>
                  </button>

                </div>

                <div class="card-content">

                  <ul class="card-meta-list">

                  

                    <li class="card-meta-item">
                      <ion-icon name="time-outline" aria-hidden="true"></ion-icon>

                      <time datetime="PT18H15M44S" class="card-meta-text">03m 32s</time>
                    </li>

                  </ul>

                  <h3 class="h3">
                    <a href="watch-video-2.php" class="card-title">SATU MASALAH LINGKUNGAN YANG JARANG DIBAHAS</a>
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
                  <img src="./assets/images/benua-sampah.jpg" width="370" height="270" loading="lazy"
                    alt="Competitive Strategy law for all students" class="img-cover">
                </figure>

                <div class="card-actions">

                  <button class="whishlist-btn" aria-label="Add to whishlist" data-whish-btn>
                    <ion-icon name="heart"></ion-icon>
                  </button>

                </div>

                <div class="card-content">

                  <ul class="card-meta-list">

                  

                    <li class="card-meta-item">
                      <ion-icon name="time-outline" aria-hidden="true"></ion-icon>

                      <time datetime="PT18H15M44S" class="card-meta-text">04m 37s</time>
                    </li>

                  </ul>

                  <h3 class="h3">
                    <a href="watch-video-3.php" class="card-title">SEBERAPA BANYAK SAMPAH PLASTIK DI DUNIA</a>
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
                  <img src="./assets/images/polusi.jpg" width="370" height="270" loading="lazy"
                    alt="Competitive Strategy law for all students" class="img-cover">
                </figure>

                <div class="card-actions">

                  <button class="whishlist-btn" aria-label="Add to whishlist" data-whish-btn>
                    <ion-icon name="heart"></ion-icon>
                  </button>

                </div>

                <div class="card-content">

                  <ul class="card-meta-list">

                  

                    <li class="card-meta-item">
                      <ion-icon name="time-outline" aria-hidden="true"></ion-icon>

                      <time datetime="PT18H15M44S" class="card-meta-text">03m 05s</time>
                    </li>

                  </ul>

                  <h3 class="h3">
                    <a href="watch-video-4.php" class="card-title">
                    POLUSI UDARA – BAGAIMANA DAMPAKNYA TERHADAP KESEHATAN KITA</a>
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
                  <img src="./assets/images/lingkungan-pademi.jpg" width="370" height="270" loading="lazy"
                    alt="Machine Learning A-Z: Hands-On Python and java" class="img-cover">
                </figure>

                <div class="card-actions">

                  <button class="whishlist-btn" aria-label="Add to whishlist" data-whish-btn>
                    <ion-icon name="heart"></ion-icon>
                  </button>

                </div>

                <div class="card-content">

                  <ul class="card-meta-list">


                    <li class="card-meta-item">
                      <ion-icon name="time-outline" aria-hidden="true"></ion-icon>

                      <time datetime="PT18H15M44S" class="card-meta-text">03m 34s</time>
                    </li>

                  </ul>

                  <h3 class="h3">
                    <a href="watch-video-5.php" class="card-title">BENARKAH LINGKUNGAN MEMBAIK SAAT PANDEMI CORONA</a>
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
                  <img src="./assets/images/pemanasan global.jpg" width="370" height="270" loading="lazy"
                    alt="Achieving Advanced in Insights with Big" class="img-cover">
                </figure>

                <div class="card-actions">
                  <button class="whishlist-btn" aria-label="Add to whishlist" data-whish-btn>
                    <ion-icon name="heart"></ion-icon>
                  </button>

                </div>

                <div class="card-content">

                  <ul class="card-meta-list">

                    <li class="card-meta-item">
                      <ion-icon name="time-outline" aria-hidden="true"></ion-icon>

                      <time datetime="PT18H15M44S" class="card-meta-text">05m 39s</time>
                    </li>

                  </ul>

                  <h3 class="h3">
                    <a href="watch-video-6.php" class="card-title">APAKAH KITA BISA MENGHENTIKAN PEMANASAN GLOBAL?</a>
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
                  <img src="./assets/images/sering-kebakaran.jpg" width="370" height="270" loading="lazy"
                    alt="Education Makes A Person A Responsible Citizen" class="img-cover">
                </figure>

                <div class="card-actions">

                  <button class="whishlist-btn" aria-label="Add to whishlist" data-whish-btn>
                    <ion-icon name="heart"></ion-icon>
                  </button>

                </div>

                <div class="card-content">

                  <ul class="card-meta-list">


                    <li class="card-meta-item">
                      <ion-icon name="time-outline" aria-hidden="true"></ion-icon>

                      <time datetime="PT18H15M44S" class="card-meta-text">02m 34s</time>
                    </li>

                  </ul>

                  <h3 class="h3">
                    <a href="watch-video-7.php" class="card-title">KENAPA INDONESIA SERING KEBAKARAN HUTAN?</a>
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
                  <img src="./assets/images/manusia-mencegah.jpg" width="370" height="270" loading="lazy"
                    alt="Building A Better World One Student At A Time" class="img-cover">
                </figure>

                <div class="card-actions">

                  <button class="whishlist-btn" aria-label="Add to whishlist" data-whish-btn>
                    <ion-icon name="heart"></ion-icon>
                  </button>

                </div>

                <div class="card-content">

                  <ul class="card-meta-list">


                    <li class="card-meta-item">
                      <ion-icon name="time-outline" aria-hidden="true"></ion-icon>

                      <time datetime="PT18H15M44S" class="card-meta-text">03m 58s</time>
                    </li>

                  </ul>

                  <h3 class="h3">
                    <a href="watch-video-8.php" class="card-title">
                    BISAKAH MANUSIA MENCEGAH KERUSAKAN BUMI?</a>
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
                  <img src="./assets/images/gunung-meletus.jpg" width="370" height="270" loading="lazy"
                    alt="Education is About Forming Faithful Disciples" class="img-cover">
                </figure>

                <div class="card-actions">

                  <button class="whishlist-btn" aria-label="Add to whishlist" data-whish-btn>
                    <ion-icon name="heart"></ion-icon>
                  </button>

                </div>

                <div class="card-content">

                  <ul class="card-meta-list">

                    <li class="card-meta-item">
                      <ion-icon name="time-outline" aria-hidden="true"></ion-icon>

                      <time datetime="PT18H15M44S" class="card-meta-text">02m 46s</time>
                    </li>

                  </ul>

                  <h3 class="h3">
                    <a href="watch-video-9.php" class="card-title">KENAPA GUNUNG BERAPI MELETUS?</a>
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

            <li>
              <div class="course-card">

                <figure class="card-banner">
                  <img src="./assets/images/minyak-habis.jpg" width="370" height="270" loading="lazy"
                    alt="Education is About Forming Faithful Disciples" class="img-cover">
                </figure>

                <div class="card-actions">

                  <button class="whishlist-btn" aria-label="Add to whishlist" data-whish-btn>
                    <ion-icon name="heart"></ion-icon>
                  </button>

                </div>

                <div class="card-content">

                  <ul class="card-meta-list">

                    <li class="card-meta-item">
                      <ion-icon name="time-outline" aria-hidden="true"></ion-icon>

                      <time datetime="PT18H15M44S" class="card-meta-text">02m 20s</time>
                    </li>

                  </ul>

                  <h3 class="h3">
                    <a href="watch-video-10.php" class="card-title">APAKAH MINYAK DI DUNIA INI AKAN HABIS?</a>
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

            <li>
              <div class="course-card">

                <figure class="card-banner">
                  <img src="./assets/images/Oksigen-DuaKali.jpg" width="370" height="270" loading="lazy"
                    alt="Education is About Forming Faithful Disciples" class="img-cover">
                </figure>

                <div class="card-actions">

                  <button class="whishlist-btn" aria-label="Add to whishlist" data-whish-btn>
                    <ion-icon name="heart"></ion-icon>
                  </button>

                </div>

                <div class="card-content">

                  <ul class="card-meta-list">

                    <li class="card-meta-item">
                      <ion-icon name="time-outline" aria-hidden="true"></ion-icon>

                      <time datetime="PT18H15M44S" class="card-meta-text">03m 32s</time>
                    </li>

                  </ul>

                  <h3 class="h3">
                    <a href="watch-video-11.php" class="card-title">GIMANA JIKA OKSIGEN DI BUMI NINGKAT DUA KALI LIPAT?</a>
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

            <li>
              <div class="course-card">

                <figure class="card-banner">
                  <img src="./assets/images/gurun.jpg" width="370" height="270" loading="lazy"
                    alt="Education is About Forming Faithful Disciples" class="img-cover">
                </figure>

                <div class="card-actions">

                  <button class="whishlist-btn" aria-label="Add to whishlist" data-whish-btn>
                    <ion-icon name="heart"></ion-icon>
                  </button>

                </div>

                <div class="card-content">

                  <ul class="card-meta-list">

                    <li class="card-meta-item">
                      <ion-icon name="time-outline" aria-hidden="true"></ion-icon>

                      <time datetime="PT18H15M44S" class="card-meta-text">03m 57s</time>
                    </li>

                  </ul>

                  <h3 class="h3">
                    <a href="watch-video-12.php" class="card-title">GURUN TERLUAS DI DUNIA? BUKAN SAHARA!</a>
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

            <li>
              <div class="course-card">

                <figure class="card-banner">
                  <img src="./assets/images/hutan.jpg" width="370" height="270" loading="lazy"
                    alt="Education is About Forming Faithful Disciples" class="img-cover">
                </figure>

                <div class="card-actions">

                  <button class="whishlist-btn" aria-label="Add to whishlist" data-whish-btn>
                    <ion-icon name="heart"></ion-icon>
                  </button>

                </div>

                <div class="card-content">

                  <ul class="card-meta-list">

                    <li class="card-meta-item">
                      <ion-icon name="time-outline" aria-hidden="true"></ion-icon>

                      <time datetime="PT18H15M44S" class="card-meta-text">03m 34s</time>
                    </li>

                  </ul>

                  <h3 class="h3">
                    <a href="watch-video-13.php" class="card-title">MENJAGA HUTAN UNTUK MELINDUNGI OZON DAN MASA DEPAN KITA</a>
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

            <li>
              <div class="course-card">

                <figure class="card-banner">
                  <img src="./assets/images/penyebab.jpg" width="370" height="270" loading="lazy"
                    alt="Education is About Forming Faithful Disciples" class="img-cover">
                </figure>

                <div class="card-actions">

                  <button class="whishlist-btn" aria-label="Add to whishlist" data-whish-btn>
                    <ion-icon name="heart"></ion-icon>
                  </button>

                </div>

                <div class="card-content">

                  <ul class="card-meta-list">

                    <li class="card-meta-item">
                      <ion-icon name="time-outline" aria-hidden="true"></ion-icon>

                      <time datetime="PT18H15M44S" class="card-meta-text">03m 30s</time>
                    </li>

                  </ul>

                  <h3 class="h3">
                    <a href="watch-video-14.php" class="card-title">APA YANG MENJADI PENYEBAB KEBAKARAN HUTAN DI SUMATERA?</a>
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

            <li>
              <div class="course-card">

                <figure class="card-banner">
                  <img src="./assets/images/akhir.jpg" width="370" height="270" loading="lazy"
                    alt="Education is About Forming Faithful Disciples" class="img-cover">
                </figure>

                <div class="card-actions">

                  <button class="whishlist-btn" aria-label="Add to whishlist" data-whish-btn>
                    <ion-icon name="heart"></ion-icon>
                  </button>

                </div>

                <div class="card-content">

                  <ul class="card-meta-list">

                    <li class="card-meta-item">
                      <ion-icon name="time-outline" aria-hidden="true"></ion-icon>

                      <time datetime="PT18H15M44S" class="card-meta-text">03m 20s</time>
                    </li>

                  </ul>

                  <h3 class="h3">
                    <a href="watch-video-15.php" class="card-title">BAGAIMANA JADINYA JIKALAU SEMUA GUNUNG BERAPI MELETUS???</a>
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
  <script>
document.addEventListener('DOMContentLoaded', () => {
  // Pilih semua tombol wishlist
  const wishlistBtns = document.querySelectorAll('[data-whish-btn]');

  // Loop melalui setiap tombol wishlist
  wishlistBtns.forEach((wishlistBtn, index) => {
    const heartIcon = wishlistBtn.querySelector('ion-icon');
    
    // Buat unique identifier berdasarkan index atau konten
    const uniqueId = `video_like_${index}`;

    // Fungsi untuk memeriksa dan menerapkan status like
    function checkLikeStatus() {
      const isLiked = localStorage.getItem(uniqueId) === 'true';
      
      if (isLiked) {
        heartIcon.style.color = 'red';
        wishlistBtn.classList.add('liked');
      } else {
        heartIcon.style.color = 'white';
        wishlistBtn.classList.remove('liked');
      }
    }

    // Periksa status like saat halaman dimuat
    checkLikeStatus();

    wishlistBtn.addEventListener('click', () => {
      // Toggle status like
      const currentStatus = localStorage.getItem(uniqueId) === 'true';
      const newStatus = !currentStatus;

      // Simpan status baru dengan unique identifier
      localStorage.setItem(uniqueId, newStatus);

      // Terapkan perubahan warna
      if (newStatus) {
        heartIcon.style.color = 'red';
        wishlistBtn.classList.add('liked');
      } else {
        heartIcon.style.color = 'white';
        wishlistBtn.classList.remove('liked');
      }
    });
  });
});
</script>
<script src="js/plugins.js"></script>
  <script>
        $(window).on("load", function() {
            $('body').addClass('loaded');
        });
    </script>
  

</body>

</html>