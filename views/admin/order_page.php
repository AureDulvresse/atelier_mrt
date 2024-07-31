<?php
// Assurez-vous que vous avez démarré une session pour utiliser les variables de session
session_start();
include 'cdn.php';
include 'css.php';

// Inclure les fichiers nécessaires (base de données, authentification, etc.)
// Assurez-vous d'avoir une connexion à la base de données et d'obtenir les données nécessaires
// Exemple: $orders = getOrders(); // Fonction fictive pour obtenir les commandes

// Remplacez ceci par vos propres méthodes pour récupérer les données
$orders = [
    // Exemple de données fictives
    ['artwork' => ['title' => 'Artwork 1'], 'customer_id' => 'Client 1', 'ordered_at' => '2024-07-29', 'quantity' => 3],
    ['artwork' => ['title' => 'Artwork 2'], 'customer_id' => 'Client 2', 'ordered_at' => '2024-07-30', 'quantity' => 5],
    // Ajoutez d'autres commandes ici
];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord</title>
    <link rel="stylesheet" href="style1.css">
    <link rel="stylesheet" href="global.css">
</head>
<body>
    <div class="d-flex">
        <div class="sidebar bg-dark text-white p-3">
            <div class="text-center mb-4">
                <h2>DATACARD</h2>
            </div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link text-white" href="../admin/dashboard.php">Tableau de Bord</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="../admin/artwork_page.php">Mes œuvres</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="../admin/event_page.php">Evénements</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white bg-danger" href="#">Commandes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="payment_page.php">Paiements</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="settings_page.php">Paramètres</a>
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
                    <div class="col-2">
                        <a href="../admin/order_form_page.php" class="btn btn-outline-danger">Nouveau</a>
                    </div>
                </div>
                <div class="row">
                    <div class="visitor-table">
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
                                    <td><?php echo htmlspecialchars($order['artwork']['title']); ?></td>
                                    <td><?php echo htmlspecialchars($order['customer_id']); ?></td>
                                    <td><?php echo htmlspecialchars($order['ordered_at']); ?></td>
                                    <td><?php echo htmlspecialchars($order['quantity']); ?></td>
                                </tr>
                                <?php endforeach; ?> -->
                                <!-- Ajoutez plus de lignes de visiteurs ici -->
                            </tbody>
                        </table>
                        <div class="pagination-container">
                            <ul class="pagination justify-content-center">
                                <li class="page-item prev-page">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <!-- Ajoutez plus de liens de pagination ici si nécessaire -->
                                <li class="page-item next-page">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- <div class="col-1"></div> -->
                    <div class="col-6 visitor-table">
                        <table class="table table-hover">
                            <thead>
                                
                            </thead>
                            <tbody>
                                
                                <!-- Ajoutez plus de lignes de visiteurs ici -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const rows = document.querySelectorAll('.visitor-table tbody tr');
            const rowsPerPage = 10;
            const pageCount = Math.ceil(rows.length / rowsPerPage);

            // Affiche la page spécifiée
            function showPage(page) {
                const start = (page - 1) * rowsPerPage;
                const end = start + rowsPerPage;

                rows.forEach((row, index) => {
                    if (index >= start && index < end) {
                        row.style.display = 'table-row';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }

            // Initialisation : affiche la première page
            showPage(1);

            // Gestion des événements de pagination
            const prevPageLink = document.querySelector('.prev-page');
            const nextPageLink = document.querySelector('.next-page');
            const pageLinks = document.querySelectorAll('.pagination .page-link');

            function setActivePage(page) {
                pageLinks.forEach(link => link.parentElement.classList.remove('active'));
                pageLinks[page - 1].parentElement.classList.add('active');
            }

            prevPageLink.addEventListener('click', function(event) {
                event.preventDefault();
                const activePage = document.querySelector('.pagination .page-item.active');
                const currentPage = parseInt(activePage.querySelector('.page-link').textContent);

                if (currentPage > 1) {
                    showPage(currentPage - 1);
                    setActivePage(currentPage - 1);
                }
            });

            nextPageLink.addEventListener('click', function(event) {
                event.preventDefault();
                const activePage = document.querySelector('.pagination .page-item.active');
                const currentPage = parseInt(activePage.querySelector('.page-link').textContent);

                if (currentPage < pageCount) {
                    showPage(currentPage + 1);
                    setActivePage(currentPage + 1);
                }
            });

            pageLinks.forEach((link, index) => {
                link.addEventListener('click', function(event) {
                    event.preventDefault();
                    const page = index + 1;
                    showPage(page);
                    setActivePage(page);
                });
            });
        });
    </script>
</body>
</html>
