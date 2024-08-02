<?php
session_start();

// Activez les erreurs pour déboguer
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// Exemple de tableau d'œuvres pour la démonstration
// Remplacez cela par une requête à votre base de données
$artworks = [
    1 => ['title' => 'Lumière et Ombre', 'price' => 1500.00],
    2 => ['title' => 'Nature Morte', 'price' => 750.00],
    // Ajoutez d'autres œuvres ici
];

// Vérifier si le panier existe
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    $msg = "Votre panier est vide.";
    $cart_empty = true;
} else {
    $cart_empty = false;
}

include './views/includes/breadcrumb.php';
?>

<section class="section cart">
    <div class="container">
        <?php if ($cart_empty) : ?>
            <p><?php echo $msg; ?></p>
            <a href="/" class="btn">Retour à la boutique</a>
        <?php else : ?>
            <h1><?php echo $msg; ?></h1>
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Produit</th>
                        <th>Prix</th>
                        <th>Quantité</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $totalPrice = 0;
                    foreach ($_SESSION['cart'] as $artworkId => $quantity) {
                        if (isset($artworks[$artworkId])) {
                            $artwork = $artworks[$artworkId];
                            $subtotal = $artwork['price'] * $quantity;
                            $totalPrice += $subtotal;
                    ?>
                            <tr>
                                <td><img src="/assets/images/sample.jpg" alt="Artwork Image" class="cart-image" /></td>
                                <td><?php echo $artwork['title']; ?></td>
                                <td><?php echo number_format($artwork['price'], 2, ',', ' '); ?> €</td>
                                <td><?php echo $quantity; ?></td>
                                <td><?php echo number_format($subtotal, 2, ',', ' '); ?> €</td>
                                <td><a href="remove_from_cart.php?id=<?php echo $artworkId; ?>" class="btn remove-from-cart">Retirer</a></td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4">Total</td>
                        <td><?php echo number_format($totalPrice, 2, ',', ' '); ?> €</td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
            <div class="cart-actions">
                <a href="checkout.php" class="btn checkout">Passer à la caisse</a>
                <a href="clear_cart.php" class="btn clear-cart">Vider le panier</a>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php include './views/includes/footer.php'; ?>