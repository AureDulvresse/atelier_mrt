<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atelier MRT | <?php echo htmlspecialchars($pageTitle); ?></title>
    <!-- Boxicons CSS -->
    <link href='https://unpkg.com/boxicons/css/boxicons.min.css' rel='stylesheet'>
    <?php includeCSS('styles.css'); ?>

    <style>
        #home {
            background-image: url(<?php $artist_banner ?>) !important;
        }
    </style>
</head>

<body>
    <!-- En-tête -->
    <header>
        <div class="container">
            <div class="flex flex-row justify-between align-center">
                <div class="logo">
                    <img src="assets/images/logo.png" alt="Logo Atelier MRT">
                </div>
                <nav class="flex flex-row align-center">
                    <ul class="flex flex-row list-none m-0 p-0">
                        <li class="mr-4"><a href="#home" class="active">Accueil</a></li>
                        <li class="mr-4"><a href="#about">À Propos</a></li>
                        <li class="mr-4"><a href="#gallery">Galerie</a></li>
                        <li class="mr-4"><a href="#contact">Contact</a></li>
                        <li class="mr-4"><a href="#shop">Boutique</a></li>
                    </ul>
                    <div class="nav-extra flex flex-row align-center">
                        <!-- Si utilisateur non connecté -->
                        <a href="#login" class="login-btn">Connexion</a>
                        <!-- Sinon -->
                        <!-- <a href="#cart" class="cart-icon"><i class='bx bx-cart'></i></a> -->
                        <!-- <a href="#profile" class="profile-icon"><i class='bx bx-user'></i></a> -->
                    </div>
                </nav>
            </div>
        </div>
    </header>