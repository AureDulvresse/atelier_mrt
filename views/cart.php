<?php

use App\Models\CartItem;

$cartItem = new CartItem($pdo);

$user_cart = $cartItem->read($_SESSION['cart']);

// Vérifier si le panier existe
if (!isset($_SESSION['cart']) && empty($_SESSION['cart'])) {
    $message = "Votre panier est vide.";
    $cart_empty = true;
} else {
    $cart_empty = false;
}

$totalAmount = array_reduce(
    $user_cart,
    function ($sum, $item) {
        return $sum + ($item->artwork->price * $item->quantity);
    },
    0
);

$msg = "Votre panier";

include './views/includes/breadcrumb.php';
?>

<section class="section cart">
    <div class="container">
        <?php if ($cart_empty) : ?>
            <div style="text-align: center;">
                <p><?php echo $message; ?></p>
                <a href="/atelier_mrt/" class="btn">Retour à la boutique</a>
            </div>

        <?php else : ?>
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Oeuvre</th>
                        <th>Prix</th>
                        <th>Quantité</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($user_cart as $item) : ?>
                        <tr>
                            <td class="table-img">
                                <img src="/atelier_mrt/<?php echo ($item->artwork->thumbnail != null) ? htmlspecialchars($item->artwork->thumbnail) : "assets/images/sample.jpg"; ?>" alt="<?php echo htmlspecialchars($item->artwork->title); ?>" />
                            </td>
                            <td><?php echo $item->artwork->title; ?></td>
                            <td><?php echo number_format($item->artwork->price, 2, ',', ' '); ?> €</td>
                            <td><?php echo $item->quantity; ?></td>
                            <td><?php echo number_format($item->artwork->price * $item->quantity, 2, ',', ' '); ?> €</td>
                            <td><a href="remove_from_cart.php?id=<?php echo $item->artwork_id; ?>" class="btn remove-from-cart">Retirer</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4">Total</td>
                        <td><?php echo number_format($totalAmount, 2, ',', ' '); ?> €</td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
            <div class="cart-actions">
                <a href="/atelier_mrt/checkout" class="btn black">Passer à la caisse</a>
                <a href="/atelier_mrt/clear_cart" class="btn">Vider le panier</a>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php include './views/includes/footer.php'; ?>