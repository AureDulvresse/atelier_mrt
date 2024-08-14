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

    <?php includeCSS('admin.css'); ?>

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

</head>

<body>
    <main>
        <div class="sidebar">
            <div class="text-center mb-4">
                <h4>Atelier MrT</h4>
            </div>
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link active" href="/atelier_mrt/admin"><i class='bx bx-home'></i>Tableau de Bord</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href=""><i class='bx bx-category'></i>Categorie</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../admin/artwork_page.php"><i class='bx bx-brush'></i>Techniques</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/atelier_mrt/admin/artworks"><i class='bx bx-paint'></i>Mes œuvres</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../admin/event_page.php"><i class='bx bx-calendar-event'></i>Événements</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../admin/order_page.php"><i class='bx bx-cart'></i>Commandes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="path/to/your/payment_page.php"><i class='bx bx-credit-card'></i>Paiements</a>
                </li>
            </ul>
        </div>