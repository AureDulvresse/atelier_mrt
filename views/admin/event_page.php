<?php
$title = "";
// include 'base.php'; // Inclure le fichier de base qui pourrait contenir des en-têtes et autres inclusions globales
include 'cdn.php';
include 'css.php'
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style1.css">
    <link rel="stylesheet" href="global.css">
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
                    <a class="nav-link text-white" href="../admin/artwork_page.php">Mes œuvres</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white bg-danger" href="#">Evénements</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="../admin/order_page.php">Commandes</a>
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
                        <a href="../admin/event_form_page.php" class="btn btn-outline-danger">Nouveau</a>
                    </div>
                </div>
                <div class="row">
                    <div class="notification-container" style="z-index: 11">
                        <div class="col-12 mt-1">
                            <?php if (isset($messages) && !empty($messages)): ?>
                                <div class="alert alert-danger messages">
                                    <?php foreach ($messages as $message): ?>
                                        <div class="<?= htmlspecialchars($message['tags']) ?>"><?= htmlspecialchars($message['text']) ?></div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="visitor-table">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>Description</th>
                                    <th>Date</th>
                                    <th>Lieu</th>
                                    <th colspan="2">Fonctions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- <?php foreach ($events as $event): ?>
                                <tr id="event_<?= htmlspecialchars($event['id']) ?>">
                                    <td><?= htmlspecialchars($event['name']) ?></td>
                                    <td><?= htmlspecialchars($event['description']) ?></td>
                                    <td><?= htmlspecialchars($event['date']) ?></td>
                                    <td><?= htmlspecialchars($event['lieu']) ?></td>
                                    <td>
                                        <a class="text-danger delete-event" href="delete_event.php?id=<?= htmlspecialchars($event['id']) ?>">[x]</a>
                                    </td>
                                    <td>
                                        <a href="edit_event.php?id=<?= htmlspecialchars($event['id']) ?>">[e]</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?> -->
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
            $('body').on('click', '.delete-event', function(event) {
                event.preventDefault(); // Empêcher l'action par défaut du lien
                var url = $(this).attr('href'); // Récupérer l'URL du lien
                var row = $(this).closest('tr'); // Récupérer la ligne du tableau correspondant à l'événement
    
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        'csrfmiddlewaretoken': '<?php echo $_SESSION["csrf_token"]; ?>'
                    },
                    success: function(response) {
                        console.log("Réponse du serveur :", response); // Debug : afficher la réponse du serveur
                        if (response.result === 'success') {
                            row.remove(); // Supprimer la ligne du tableau
                            // Afficher la notification de suppression
                            showNotification('danger', 'Événement supprimé avec succès');
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
    </script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const rows = document.querySelectorAll('.visitor-table tbody tr');
            const rowsPerPage = 10;
            const pageCount = Math.ceil(rows.length / rowsPerPage);
            const pagination = document.querySelector('.pagination');

            function displayPage(page) {
                rows.forEach((row, index) => {
                    row.style.display = 'none';
                    if (index >= (page - 1) * rowsPerPage && index < page * rowsPerPage) {
                        row.style.display = '';
                    }
                });
                document.querySelectorAll('.pagination .page-item').forEach(item => item.classList.remove('active'));
                pagination.children[page].classList.add('active');
            }

            pagination.addEventListener('click', (event) => {
                if (event.target.tagName === 'A') {
                    const page = parseInt(event.target.textContent);
                    displayPage(page);
                }
            });

            displayPage(1);
        });
    </script>
</body>
</html>
