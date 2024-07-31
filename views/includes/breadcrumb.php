<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atelier MRT | <?php echo htmlspecialchars($pageTitle); ?></title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Oswald:wght@200..700&display=swap" rel="stylesheet" />

    <!-- Boxicons CSS -->
    <link href='https://unpkg.com/boxicons/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <?php includeCSS('styles.css'); ?>

    <style>
        #home {
            background-image: url(<?php echo htmlspecialchars($artist_banner); ?>) !important;
        }
    </style>
</head>

<body>

    <main>
        <!-- En-tête -->
        <header id="header">
            <div class="overlay overlay-lg">
                <img src="./assets/images/shapes/square.png" class="shape square" alt="" />
                <img src="./assets/images/shapes/circle.png" class="shape circle" alt="" />
                <img src="./assets/images/shapes/half-circle.png" class="shape half-circle1" alt="" />
                <img src="./assets/images/shapes/half-circle.png" class="shape half-circle2" alt="" />
                <img src="./assets/images/shapes/x.png" class="shape xshape" alt="" />
                <img src="./assets/images/shapes/wave.png" class="shape wave wave1" alt="" />
                <img src="./assets/images/shapes/wave.png" class="shape wave wave2" alt="" />
                <img src="./assets/images/shapes/triangle.png" class="shape triangle" alt="" />
                <img src="./assets/images/shapes/points1.png" class="points points1" alt="" />
            </div>

            <nav>
                <div class="container">
                    <div class="logo">
                        <img src="./assets/images/logo.png" alt="" />
                    </div>

                    <div class="links">
                        <ul>
                            <li>
                                <a href="/atelier_mrt">Home</a>
                            </li>
                            <li>
                                <a href="/atelier_mrt/#about">A propos</a>
                            </li>
                            <li>
                                <a href="/atelier_mrt/#gallery">Galerie</a>
                            </li>
                            <li>
                                <a href="/atelier_mrt/#blog">Actualité</a>
                            </li>
                            <li>
                                <a href="/atelier_mrt/#contact">Contact</a>
                            </li>
                            <li>
                                <a href="login" class="active">Connexion</a>
                            </li>
                        </ul>
                    </div>

                    <div class="hamburger-menu">
                        <div class="bar"></div>
                    </div>
                </div>
            </nav>

            <div class="header-content section">
                <div class="container">
                    <div class="section-header">
                        <h3 class="title header-title" data-title="<?php echo $msg ?>"><?php echo $pageTitle ?></h3>
                    </div>
                </div>
            </div>