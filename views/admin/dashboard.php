<?php
$title = "Tableau de Bord";
// include 'base.php'; // Inclure le fichier de base qui pourrait contenir des en-têtes et autres inclusions globales
include 'cdn.php';
include 'css.php'
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title); ?></title>
    <link rel="stylesheet" href="path/to/your/global.css"> <!-- Inclure le fichier CSS -->
    <!-- Ajouter les autres inclusions nécessaires -->
</head>
<body>
    <div class="d-flex">
        <div class="sidebar bg-dark text-white p-3">
            <div class="text-center mb-4">
                <h2>DATACARD</h2>
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
        <div class="main-content flex-grow-1 p-4">
            <header class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3">Tableau de Bord</h1>
                <div class="d-flex align-items-center">
                    <p class="mb-0 me-3">Samuel Smith</p>
                    <img src="img.jpeg" alt="Icône Utilisateur" class="rounded-circle" width="40">
                </div>
            </header>
            <div class="row text-center mb-4">
                <div class="col-md-3">
                    <div class="stat-box p-3 bg-light rounded h-100 d-flex flex-column justify-content-center">
                        <p class="display-6">55</p>
                        <span>Occupants du Bâtiment</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-box p-3 bg-light rounded h-100 d-flex flex-column justify-content-center">
                        <p class="display-6">150</p>
                        <span>Visiteurs de ce Mois</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-box p-3 bg-light rounded h-100 d-flex flex-column justify-content-center">
                        <p class="display-6">15</p>
                        <span>Moyenne Quotidienne de Visiteurs</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-box p-3 bg-light rounded h-100 d-flex flex-column justify-content-center">
                        <p class="display-6">250</p>
                        <span>Visiteurs du Mois Dernier</span>
                    </div>
                </div>
            </div> 
            <div class="container">
                <div class="row">
                    <div class="col-6 visitor-table">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Titre</th>
                                    <th>Description</th>
                                    <th>Prix</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- <?php foreach ($artworks as $artwork): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($artwork['title']); ?></td>
                                    <td><?php echo htmlspecialchars($artwork['description']); ?></td>
                                    <td><?php echo htmlspecialchars($artwork['price']); ?></td>
                                </tr>
                                <?php endforeach; ?> -->
                                <!-- Ajoutez plus de lignes de visiteurs ici -->
                            </tbody>
                        </table>
                    </div>
                    <div class="col-6 visitor-table">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Titre</th>
                                    <th>Client</th>
                                    <th>Date de commande</th>
                                    <th>Quantité</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- <?php foreach ($orders as $order): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($order['artwork_title']); ?></td>
                                    <td><?php echo htmlspecialchars($order['customer_id']); ?></td>
                                    <td><?php echo htmlspecialchars($order['ordered_at']); ?></td>
                                    <td><?php echo htmlspecialchars($order['quantity']); ?></td>
                                </tr>
                                <?php endforeach; ?> -->
                                <!-- Ajoutez plus de lignes de visiteurs ici -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
