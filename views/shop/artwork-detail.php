<?php

// Afficher les erreurs pour le débogage (optionnel, décommentez pour activer)
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

use App\Models\Artwork;

$msg = "En savoir plus sur l'oeuvre !";

// Récupérer l'ID de l'œuvre depuis l'URL
$artworkId = isset($_GET['id']) ? intval($_GET['id']) : 0;

$artwork = Artwork::find($pdo, $artworkId);

include './views/includes/breadcrumb.php';
?>

<section class="artwork-details">
    <div class="container">
        <div class="artwork-details__grid">
            <div class="artwork-details__image" data-aos="fade-up" data-aos-duration="2000">
                <img src="<?php echo "/atelier_mrt/assets/images/sample.jpg"; // echo ($artwork->thumbnail) ?  "/uploads/artworks/". htmlspecialchars($artwork->thumbnail) : ""; ?>" alt="<?php echo htmlspecialchars($artwork->title); ?>" />
            </div>
            <div class="artwork-details__info" data-aos="fade-up" data-aos-duration="1500">
                <h1 class="artwork-details__title"><?php echo htmlspecialchars($artwork->title); ?></h1>
                <p class="artwork-details__description"><?php echo htmlspecialchars($artwork->description); ?></p>
                <div class="artwork-details__attributes">
                    <p class="artwork-details__dimensions">Dimensions: <?php echo intval($artwork->width); ?> cm x <?php echo intval($artwork->height); ?> cm</p>
                    <p class="artwork-details__category">Catégorie: <?php echo htmlspecialchars($artwork->category_name); ?></p>
                    <p class="artwork-details__medium">Technique: <?php echo htmlspecialchars($artwork->medium_name); ?></p>
                    <p class="artwork-details__stock">Stock: <?php echo intval($artwork->stock); ?> pièces disponibles</p>
                    <p class="artwork-details__price">Prix: <?php echo number_format($artwork->price, 2, ',', ' '); ?> €</p>
                </div>
                <?php if ($isLoggedIn) : ?>
                    <form action="/atelier_mrt/add_to_cart" method="post">
                        <input type="hidden" name="artwork_id" id="artwork_id" value="<?php echo intval($artwork->id); ?>" />
                        <input type="number" class="form-input" name="quantity" id="quantity" value="1" />
                        <!-- Utilisateur connecté -->
                        <button type="submit" class="btn">Ajouter au panier</button>
                    </form>

                <?php else : ?>
                    <!-- Utilisateur non connecté -->
                    <a href="/atelier_mrt/login" class="btn">Se connecter pour Ajouter au panier</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php include './views/includes/footer.php'; ?>