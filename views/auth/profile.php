<?php

// Afficher les erreurs pour le débogage (optionnel, décommentez pour activer)
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

$msg = "Gérez votre profil !";

include './views/includes/breadcrumb.php';
?>

<section class="section profile">

    <div class="container">
        <div class="profile-content">
            <div class="profile-info">
                <h2>Informations Personnelles</h2>
                <form id="update-profile-form">
                    <div class="row">
                        <label for="prenom">Prénom:</label>
                        <input type="text" class="form-input" id="prenom" name="prenom" value="John">
                    </div>

                    <div class="row">
                        <label for="nom">Nom:</label>
                        <input type="text" class="form-input" id="nom" name="nom" value="Doe">
                    </div>

                    <div class="row">
                        <label for="email">Email:</label>
                        <input type="email" class="form-input" id="email" name="email" value="john.doe@example.com">
                    </div>

                    <div class="row">
                        <label for="telephone">Téléphone:</label>
                        <input type="text" class="form-input" id="telephone" name="telephone" value="+1234567890">
                    </div>

                    <div class="row">
                        <button type="submit" class="btn black">Mettre à jour</button>
                        <button id="delete-account" class="btn">Supprimer le compte</button>
                    </div>

                </form>

            </div>
            <div class="profile-orders">
                <h2>Historique des Commandes</h2>
                <div class="order">
                    <p><strong>Commande #12345</strong></p>
                    <p>Date: 01/01/2023</p>
                    <p>Statut: Livrée</p>
                    <p>Montant: 100€</p>
                </div>
                <div class="order">
                    <p><strong>Commande #12346</strong></p>
                    <p>Date: 02/01/2023</p>
                    <p>Statut: En cours</p>
                    <p>Montant: 150€</p>
                </div>
                <!-- Ajouter plus de commandes ici -->
            </div>
        </div>
    </div>
</section>

<?php include './views/includes/footer.php'; ?>