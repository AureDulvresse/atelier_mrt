<?php

// Simulez les données du panier pour l'exemple
$cartItems = [
    ['name' => 'Artwork 1', 'price' => 100, 'quantity' => 1],
    ['name' => 'Artwork 2', 'price' => 200, 'quantity' => 1],
];
$totalAmount = array_reduce($cartItems, function ($sum, $item) {
    return $sum + ($item['price'] * $item['quantity']);
}, 0);

$msg = "Finaliser votre paiement";

include __DIR__ . '/../includes/breadcrumb.php';
?>

<div class="checkout-container">
    <div class="row">
        <div class="col-md-6">
            <h4>Cart Items</h4>
            <ul class="list-group">
                <?php foreach ($cartItems as $item) : ?>
                    <li class="list-group-item">
                        <?php echo $item['name']; ?> - $<?php echo $item['price']; ?> x <?php echo $item['quantity']; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
            <h4>Total: $<?php echo $totalAmount; ?></h4>
        </div>
        <div class="col-md-6">
            <h4>Payment</h4>
            <!-- Stripe Payment Form -->
            <form id="stripe-form">
                <div class="form-group">
                    <label for="card-element">Credit or debit card</label>
                    <div id="card-element" class="form-control"></div>
                </div>
                <button id="stripe-button" class="btn btn-primary">Pay with Stripe</button>
            </form>
            <hr>
            <!-- PayPal Payment Button -->
            <div id="paypal-button"></div>
        </div>
    </div>
</div>

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