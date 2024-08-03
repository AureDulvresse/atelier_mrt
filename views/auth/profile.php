<?php

// Afficher les erreurs pour le débogage (optionnel, décommentez pour activer)
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

$msg = "Gérez votre profil !";

include './views/includes/breadcrumb.php';
?>

<div class="profile-container">
    <div class="profile-header">
        <h1>Votre Profil</h1>
    </div>
    <div class="profile-content">
        <div class="profile-info">
            <h2 class="title">Informations Personnelles</h2>
            <form id="update-profile-form">
                <label for="prenom">Prénom:</label>
                <input type="text" id="prenom" name="prenom" value="John">

                <label for="nom">Nom:</label>
                <input type="text" id="nom" name="nom" value="Doe">

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="john.doe@example.com">

                <label for="telephone">Téléphone:</label>
                <input type="text" id="telephone" name="telephone" value="+1234567890">

                <button type="submit">Mettre à jour</button>
            </form>
            <button id="delete-account" class="delete-btn">Supprimer le compte</button>
        </div>
        <div class="profile-orders">
            <h2 class="title">Historique des Commandes</h2>
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

<?php include './views/includes/footer.php'; ?>
