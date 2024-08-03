<?php

// Afficher les erreurs pour le débogage (optionnel, décommentez pour activer)
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

$msg = "En savoir plus sur l'oeuvre !";

// Récupérer l'ID de l'œuvre depuis l'URL
$artworkId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Exemple de données, à remplacer par une requête à la base de données
$artwork = [
    'id' => $artworkId,
    'title' => 'Lumière et Ombre',
    'description' => "Cette œuvre explore le jeu entre la lumière et l'ombre, créant une dynamique visuelle intrigante. Inspirée par les paysages urbains au coucher du soleil, elle utilise des techniques de peinture à l'huile pour capturer la beauté éphémère du moment.",
    'price' => 1500.00,
    'stock' => 5,
    'width' => 80, // Largeur en cm
    'height' => 100, // Hauteur en cm
    'category' => 'Peinture',
    'medium' => 'Peinture à l\'huile',
    'image_url' => '/atelier_mrt/assets/images/sample.jpg'
];

include './views/includes/breadcrumb.php';
?>

<section class="artwork-details">
    <div class="container">
        <div class="artwork-details__grid">
            <div class="artwork-details__image" data-aos="fade-up" data-aos-duration="2000">
                <img src="<?php echo htmlspecialchars($artwork['image_url']); ?>" alt="<?php echo htmlspecialchars($artwork['title']); ?>" />
            </div>
            <div class="artwork-details__info" data-aos="fade-up" data-aos-duration="1500">
                <h1 class="artwork-details__title"><?php echo htmlspecialchars($artwork['title']); ?></h1>
                <p class="artwork-details__description"><?php echo htmlspecialchars($artwork['description']); ?></p>
                <div class="artwork-details__attributes">
                    <p class="artwork-details__dimensions">Dimensions: <?php echo intval($artwork['width']); ?> cm x <?php echo intval($artwork['height']); ?> cm</p>
                    <p class="artwork-details__category">Catégorie: <?php echo htmlspecialchars($artwork['category']); ?></p>
                    <p class="artwork-details__medium">Technique: <?php echo htmlspecialchars($artwork['medium']); ?></p>
                    <p class="artwork-details__stock">Stock: <?php echo intval($artwork['stock']); ?> pièces disponibles</p>
                    <p class="artwork-details__price">Prix: <?php echo number_format($artwork['price'], 2, ',', ' '); ?> €</p>
                </div>
                <?php if ($isLoggedIn) : ?>
                    <form action="/atelier_mrt/controllers/CartController.php" method="post">
                        <input type="hidden" name="action" id="action" value="add" />
                        <input type="hidden" name="artwork_id" id="artwork_id" value="<?php echo intval($artwork['id']); ?>" />
                        <!-- Utilisateur connecté -->
                        <button type="submit" class="btn">Ajouter au panier</button>
                    </form>

                <?php else : ?>
                    <!-- Utilisateur non connecté -->
                    <a href="login" class="btn">Se connecter pour Ajouter au panier</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php include './views/includes/footer.php'; ?>