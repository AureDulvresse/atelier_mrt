<?php

use App\Models\CartItem;

$cartItem = new CartItem($pdo);

$cartItems = $cartItem->read($_SESSION['cart']);

$totalAmount = array_reduce($cartItems, function ($sum, $item) {
    return $sum + ($item->artwork->price * $item->quantity);
}, 0);

$msg = "Finaliser votre paiement";

include __DIR__ . '/../includes/breadcrumb.php';
?>
<section class="section cart">
    <div class="container">
        <div class="grid-2">
            <table class="cart-table">
                <thead>
                    <th>Oeuvre</th>
                    <th>Prix</th>
                    <th>Quantité</th>
                    <th>Total</th>
                </thead>

                <tbody>
                    <?php
                    $totalPrice = 0;
                    foreach ($cartItems as $item) :
                    ?>
                        <tr>
                            <td><?php echo $item->artwork->title; ?></td>
                            <td>
                                <?php echo $item->artwork->price; ?>
                            </td>
                            <td>
                                <?php echo $item->quantity; ?>
                            </td>
                            <td>
                                <?php echo $item->artwork->price * $item->quantity; ?> €
                            </td>
                        </tr>

                    <?php
                    endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3">Total</td>
                        <td><?php echo number_format($totalAmount, 2, ',', ' '); ?> €</td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
            <div class="checkout-form">
                <h3>Informations client</h3>
                <!-- Stripe Payment Form -->
                <form id="stripe-form">
                    <div class="row">
                        <input type="text" class="form-input" name="full_name" id="full_name" placeholder="Nom complet" />
                    </div>

                    <div class="row">
                        <input type="email" class="form-input" name="email" id="email" placeholder="Email" />
                    </div>
                    <div class="row">
                        <h3>Payment</h3>
                    </div>

                    <div class="row">
                        <label for="card-element">Credit or debit card</label>
                        <div id="card-element" class="form-control"></div>
                    </div>

                    <button id="stripe-button" class="btn black">Pay with Stripe</button>
                </form>
                <hr>
                <!-- PayPal Payment Button -->
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
                <p class="text">
                    Découvrez une collection exceptionnelle d'œuvres d'art contemporaine
                </p>
            </div>

            <div class="grid-3-col footer-links">
                <h3 class="title-sm">Liens Rapide</h3>
                <ul>
                    <li>
                        <a href="#header">Accueil</a>
                    </li>
                    <li>
                        <a href="#gallery">Galerie</a>
                    </li>
                    <li>
                        <a href="#about">A Propos</a>
                    </li>
                    <li>
                        <a href="#blog">Actualité & évènements</a>
                    </li>
                    <li>
                        <a href="#contact">Contact</a>
                    </li>
                </ul>
            </div>

            <div class="grid-3-col footer-links">
                <h3 class="title-sm">Contact</h3>
                <ul>
                    <li>
                        <a href="#">Web Design</a>
                    </li>
                    <li>
                        <a href="#">Web Dev</a>
                    </li>
                    <li>
                        <a href="#">App Design</a>
                    </li>
                    <li>
                        <a href="#">Marketing</a>
                    </li>
                </ul>
            </div>

        </div>

        <div class="bottom-footer">
            <div class="copyright">
                <p class="text">
                    Copyright&copy;2024 Atelier MrT
                </p>
            </div>
        </div>
    </div>
    <div class="back-btn-wrap">
        <a href="#header" class="back-btn">
            <i class="bx bx-chevron-up"></i>
        </a>
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
<script src="https://www.paypal.com/sdk/js?client-id=<?php echo $config['paypal']['client_id']; ?>&currency=USD"></script>
<script>
    // Stripe Integration
    var stripe = Stripe('<?php echo $config['stripe']['publishable_key']; ?>');
    var elements = stripe.elements();
    var card = elements.create('card');
    card.mount('#card-element');

    document.getElementById('stripe-form').addEventListener('submit', async function(e) {
        e.preventDefault();
        const {
            token,
            error
        } = await stripe.createToken(card);
        if (error) {
            alert(error.message);
        } else {
            // Envoyer le token au serveur
            fetch('process_payment.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    token: token.id,
                    amount: <?php echo $totalAmount * 100; ?>
                })
            }).then(response => response.json()).then(data => {
                alert(data.message);
            }).catch(error => {
                alert('Payment failed');
            });
        }
    });

    // PayPal Integration
    paypal.Buttons({
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '<?php echo $totalAmount; ?>'
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