<?php

use App\Models\CartItem;

$cartItem = new CartItem($pdo);

$cartItems = $cartItem->read($_SESSION['cart']);

$totalAmount = array_reduce($cartItems, function ($sum, $item) {
    return $sum + ($item->artwork->price * $item->quantity);
}, 0);

$msg = "Finaliser votre paiement";

// Exemple d'initialisation des services
\Stripe\Stripe::setApiKey($stripeSecretKey);

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

<?php include __DIR__ . '/../includes/footer.php'; ?>