<?php

use App\Models\Artwork;
use App\Models\Cart;
use App\Controllers\CartController;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $artwork = Artwork::find($pdo, $_POST['artwork_id'] ?? 1);
        $cart = Cart::get($pdo,  $_SESSION['cart'] ?? 1);
        var_dump($_SESSION['cart']);
        $qte = $_POST['quantity'];

        $cart_controller = new CartController($pdo);

        $result = $cart_controller->addToCart($cart, $artwork->id, $qte);

        header('Location: /atelier_mrt/shop/artwork/' . $_POST['artwork_id']);
}
