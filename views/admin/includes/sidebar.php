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

    <?php includeCSS('styles.css'); ?>


    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

</head>

<body>
    <main>
        <div class="sidebar">
            <div class="text-center mb-4">
                <h4>Atelier MrT</h4>
            </div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link text-white bg-danger" href="#">Tableau de Bord</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="../admin/artwork_page.php">Mes œuvres</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="../admin/event_page.php">Événements</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="../admin/order_page.php">Commandes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="path/to/your/payment_page.php">Paiements</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="path/to/your/settings_page.php">Paramètres</a>
                </li>
            </ul>
        </div>
    