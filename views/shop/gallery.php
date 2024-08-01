<?php

// Afficher les erreurs pour le débogage (optionnel, décommentez pour activer)
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

$msg = "Découvrer ma galerie";


include './views/includes/breadcrumb.php';
?>
<section class="section gallery">
    <div class="container">
        <div class="section-body">
            <div class="filter bg-red">
                <button class="filter-btn active" data-filter="*">Toutes</button>
                <button class="filter-btn" data-filter=".peinture">Peinture</button>
                <button class="filter-btn" data-filter=".dessin">Dessin</button>
                <button class="filter-btn" data-filter=".sculpture">Sculpture</button>
                <button class="filter-btn" data-filter=".photographie">Photographie</button>
            </div>

            <div class="grid" data-aos="fade-up" data-aos-duration="11000">
                <?php for ($i = 0; $i < 30; $i++) { ?>
                    <div class="grid-item peinture">
                        <div class="gallery-image">
                            <img src="./assets/images/sample.jpg" alt="" />
                            <div class="img-overlay">
                                <div class="img-overlay-content">
                                    <div class="img-description">
                                        <h3>Peinture</h3>
                                        <h5>Voir Démo</h5>
                                    </div>
                                    <a href="shop/artwork?id=<?php echo 1 ?>" class="btn black small">Détail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <!-- Pagination -->
            <div class="pagination">
                <button class="pagination-btn" data-page="prev">&laquo; Précédent</button>
                <button class="pagination-btn" data-page="next">Suivant &raquo;</button>
            </div>
        </div>
    </div>
</section>

<?php include './views/includes/footer.php'; ?>