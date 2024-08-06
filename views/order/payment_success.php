<?php
$msg = "Paiement Réussi";

include __DIR__ . '/../includes/breadcrumb.php';
?>
<section class="section success">
    <div class="container">
        <div class="success-message">
            <h2>Paiement Réussi</h2>
            <p>Merci pour votre achat ! Votre commande a été traitée avec succès.</p>
            <a href="/atelier_mrt" class="btn">Retour à l'accueil</a>
        </div>
    </div>
</section>

<?php include './views/includes/footer.php'; ?>