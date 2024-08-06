<?php
$msg = "Paiement Annulé";

include __DIR__ . '/../includes/breadcrumb.php';
?>
<section class="section cancel">
    <div class="container">
        <div class="cancel-message">
            <h2>Paiement Annulé</h2>
            <p>Votre paiement a été annulé. Si vous avez des questions ou des préoccupations, veuillez nous contacter.</p>
            <a href="/atelier_mrt/cart" class="btn btn-primary">Retour au Panier</a>
        </div>
    </div>
</section>

<?php include './views/includes/footer.php'; ?>