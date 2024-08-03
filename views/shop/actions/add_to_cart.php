<?php

use App\Models\Artwork;
use App\Models\Cart;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
            $artwork = Artwork::find($pdo, $_POST['artwork_id'] ?? 1);
            $cart = Cart::get($pdo, $_SESSION['cart'] ?? 1);
            $qte = $_POST['quantity'];

            $cart_controller = new CartController($pdo);

            $result = $cart_controller->addToCart($cart, $artwork, $qte);

            header('Location: /atelier/shop/artwork/' . $_POST['artwork_id']);
          
    }