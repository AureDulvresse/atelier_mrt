<?php

use App\Models\CartItem;

$cartItem = new CartItem($pdo);

$cartItems = $cartItem->read($_SESSION['cart']);

$totalAmount = array_reduce($cartItems, function ($sum, $item) {
    return $sum + ($item->artwork->price * $item->quantity);
}, 0);

$msg = "Finaliser votre paiement";

include __DIR__ . '/../includes/breadcrumb.php';

// Configurations pour JavaScript
$config = [
    'stripe' => [
        'publishable_key' => $_ENV['STRIPE_PUBLISHABLE_KEY']
    ],
    'paypal' => [
        'client_id' => $_ENV['PAYPAL_CLIENT_ID']
    ]
];
?>
<section class="section cart">
    <div class="container">
        <div class="checkout-wrapper">
            <div class="cart-table-wrapper">
                <h2 class="checkout-title">Votre Panier</h2>
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th>Oeuvre</th>
                            <th>Prix</th>
                            <th>Quantité</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cartItems as $item) : ?>
                            <tr>
                                <td><?php echo htmlspecialchars($item->artwork->title, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo htmlspecialchars($item->artwork->price, ENT_QUOTES, 'UTF-8'); ?> €</td>
                                <td><?php echo htmlspecialchars($item->quantity, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo htmlspecialchars($item->artwork->price * $item->quantity, ENT_QUOTES, 'UTF-8'); ?> €</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3">Total</td>
                            <td><?php echo number_format($totalAmount, 2, ',', ' '); ?> €</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="checkout-form-wrapper">
                <h2 class="checkout-title">Paiement</h2>
                <button id="stripe-button" class="btn btn-stripe">Pay with Stripe</button>
                <hr>
                <div id="paypal-button"></div>
            </div>
        </div>
    </div>
</section>

<footer class="footer">
    <div class="container">
        <div class="grid-3">
            <div class="grid-3-col footer-about">
                <h3 class="title-sm">Atelier <span>MrT</span></h3>
                <p class="text">Découvrez une collection exceptionnelle d'œuvres d'art contemporaine</p>
            </div>
            <div class="grid-3-col footer-links">
                <h3 class="title-sm">Liens Rapide</h3>
                <ul>
                    <li><a href="#header">Accueil</a></li>
                    <li><a href="#gallery">Galerie</a></li>
                    <li><a href="#about">A Propos</a></li>
                    <li><a href="#blog">Actualité & évènements</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </div>
            <div class="grid-3-col footer-links">
                <h3 class="title-sm">Contact</h3>
                <ul>
                    <li><a href="#">Web Design</a></li>
                    <li><a href="#">Web Dev</a></li>
                    <li><a href="#">App Design</a></li>
                    <li><a href="#">Marketing</a></li>
                </ul>
            </div>
        </div>
        <div class="bottom-footer">
            <div class="copyright">
                <p class="text">Copyright&copy;2024 Atelier MrT</p>
            </div>
        </div>
    </div>
    <div class="back-btn-wrap">
        <a href="#header" class="back-btn"><i class="bx bx-chevron-up"></i></a>
    </div>
</footer>

</main>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?php includeJS('isotope.pkgd.min.js'); ?>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<?php includeJS('scripts.js'); ?>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>
<script src="https://js.stripe.com/v3/"></script>
<script src="https://www.paypal.com/sdk/js?client-id=<?php echo htmlspecialchars($config['paypal']['client_id'], ENT_QUOTES, 'UTF-8'); ?>&currency=EUR"></script>
<script>
    // Stripe Checkout
    var stripe = Stripe(<?php echo json_encode($config['stripe']['publishable_key']); ?>);
    var checkoutButton = document.getElementById('stripe-button');

    checkoutButton.addEventListener('click', function() {
        fetch('/atelier_mrt/order/create_checkout_session', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
            })
            .then(function(response) {
                return response.json();
            })
            .then(function(session) {
                return stripe.redirectToCheckout({
                    sessionId: session.id
                });
            })
            .then(function(result) {
                if (result.error) {
                    alert(result.error.message);
                }
            })
            .catch(function(error) {
                console.error('Error:', error);
            });
    });

    // PayPal Integration
    paypal.Buttons({
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: <?php echo json_encode($totalAmount); ?>
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
                // Appeler le serveur pour traiter le paiement PayPal
                fetch('process_payment.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        orderID: data.orderID
                    })
                }).then(response => response.json()).then(data => {
                    alert(data.message);
                }).catch(error => {
                    alert('Payment failed');
                });
            });
        }
    }).render('#paypal-button');
</script>
</body>

</html>