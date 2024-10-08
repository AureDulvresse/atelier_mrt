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
                    <a class="nav-link text-white" href="../admin/event_page.php">Evénements</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="../admin/order_page.php">Commandes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white bg-danger" href="#">Création de commande</a>
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
            <form action="" method="post">
                <div class="mb-3">
                    <label for="artwork_id" class="form-label">Sélectionner une œuvre d'art</label>
                    <select id="artwork_id" name="artwork_id" class="form-control" required>
                        <option value="">Choisissez une œuvre d'art</option>
                        <?php foreach ($artworks as $artwork): ?>
                            <option value="<?php echo htmlspecialchars($artwork['id']); ?>">
                                <?php echo htmlspecialchars($artwork['title']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="customer_id" class="form-label">Sélectionner un client</label>
                    <select id="customer_id" name="customer_id" class="form-control" required>
                        <option value="">Choisissez un client</option>
                        <?php foreach ($customers as $customer): ?>
                            <option value="<?php echo htmlspecialchars($customer['id']); ?>">
                                <?php echo htmlspecialchars($customer['first_name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="d-flex justify-content-start">
                    <button type="submit" class="btn btn-primary">Afficher les détails</button>
                </div>
            </form>
        </div>
    </div>
    
    
</body>
</html>
