<?php
// Assurez-vous que vous avez démarré une session pour utiliser les variables de session
session_start();
include 'cdn.php';
include 'css.php';
// Inclure les fichiers nécessaires pour la connexion à la base de données, les messages, etc.
// Exemple de données fictives pour les artworks et les messages
$artworks = [
    // Exemple de données fictives
    ['id' => 1, 'thumbnail' => 'image1.jpg', 'title' => 'Artwork 1', 'description' => 'Description 1', 'price' => '100'],
    ['id' => 2, 'thumbnail' => 'image2.jpg', 'title' => 'Artwork 2', 'description' => 'Description 2', 'price' => '200'],
    // Ajoutez plus d'artworks ici
];

$messages = [
    // Exemple de messages
    ['tags' => 'danger', 'message' => 'Une erreur est survenue.']
];

// URL de base pour vos ressources
$base_url = 'http://yourwebsite.com/';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../admin/static/global.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
                    <a class="nav-link text-white bg-danger" href="#">Mes œuvres</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="../admin/event_page.php">Evénements</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="../admin/order_page.php">Commandes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="../admin/payment_page.php">Paiements</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="../admin/settings_page.php">Paramètres</a>
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
                    <div>
                        <a href="../admin/artwork_form_page.php" class="btn btn-outline-danger">Nouveau</a>
                    </div>
                </div>
                <div class="row">
                    <div class="notification-container" style="z-index: 11">
                        <div class="col-12 mt-1">
                            <!-- <?php if (!empty($messages)): ?>
                                <div class="alert alert-danger messages">
                                    <?php foreach ($messages as $message): ?>
                                        <div class="<?php echo htmlspecialchars($message['tags']); ?>">
                                            <?php echo htmlspecialchars($message['message']); ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?> -->
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="visitor-table">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th colspan="2">Fonctions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- <?php foreach ($artworks as $artwork): ?>
                                <tr id="event_<?php echo htmlspecialchars($artwork['id']); ?>">
                                    <td><img src="<?php echo htmlspecialchars($artwork['thumbnail']); ?>" alt="<?php echo htmlspecialchars($artwork['title']); ?>" width="50"></td>
                                    <td><?php echo htmlspecialchars($artwork['title']); ?></td>
                                    <td><?php echo htmlspecialchars($artwork['description']); ?></td>
                                    <td><?php echo htmlspecialchars($artwork['price']); ?></td>
                                    <td>
                                        <a class="text-danger delete-artwork" href="../admin/delete_artwork.php?id=<?php echo htmlspecialchars($artwork['id']); ?>">[x]</a>
                                    </td>
                                    <td>
                                        <a href="../admin/edit_artwork.php?id=<?php echo htmlspecialchars($artwork['id']); ?>">[e]</a>
                                    </td>
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
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Intercepter le clic sur le lien de suppression
            $('body').on('click', '.delete-artwork', function(event) {
                event.preventDefault(); // Empêcher l'action par défaut du lien
                var url = $(this).attr('href'); // Récupérer l'URL du lien
                var row = $(this).closest('tr'); // Récupérer la ligne du tableau correspondant à l'artwork

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        'csrfmiddlewaretoken': '<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>'
                    },
                    success: function(response) {
                        console.log("Réponse du serveur :", response); // Debug : afficher la réponse du serveur
                        if (response.result === 'success') {
                            row.remove(); // Supprimer la ligne du tableau
                            // Afficher la notification de suppression
                            showNotification('danger', 'Oeuvre retirée avec succès');
                        } else {
                            console.log("Erreur de suppression :", response.message); // Debug : afficher le message d'erreur
                            // Afficher la notification d'erreur si nécessaire
                            showNotification('danger', response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log("Erreur AJAX :", error); // Debug : afficher l'erreur AJAX
                        // Afficher la notification d'erreur en cas d'échec de l'appel AJAX
                        showNotification('danger', 'Erreur AJAX : ' + error);
                    }
                });
            });

            // Fonction pour afficher la notification
            function showNotification(type, message) {
                var notification = $('<div class="alert alert-' + type + ' alert-dismissible fade show" role="alert">' +
                                        message +
                                    '</div>');
                $('.notification-container').append(notification);

                // Supprimer automatiquement la notification après 3 secondes
                setTimeout(function() {
                    notification.alert('close');
                }, 3000);
            }
        });

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
