<?php
require __DIR__ . '/../../vendor/autoload.php';  // Assurez-vous que le chemin est correct

use App\Models\CartItem;
use Stripe\Stripe;
use Stripe\Checkout\Session;

Stripe::setApiKey($_ENV['STRIPE_SECRET_KEY']);

$cartItem = new CartItem($pdo);
$cartItems = $cartItem->read($_SESSION['cart']);

$totalAmount = array_reduce($cartItems, function ($sum, $item) {
    return $sum + ($item->artwork->price * $item->quantity);
}, 0);

$YOUR_DOMAIN = 'http://localhost/atelier_mrt';

$checkout_session = Session::create([
    'payment_method_types' => ['card'],
    'line_items' => [[
        'price_data' => [
            'currency' => 'eur',
            'product_data' => [
                'name' => 'Total Amount',
            ],
            'unit_amount' => $totalAmount * 100, // montant total en centimes
        ],
        'quantity' => 1,
    ]],
    'mode' => 'payment',
    'success_url' => $YOUR_DOMAIN . '/success_payment',
    'cancel_url' => $YOUR_DOMAIN . '/cancel_payment',
]);

echo json_encode(['id' => $checkout_session->id]);
