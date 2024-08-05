<?php

namespace App\Controllers;

use App\Models\Artwork;
use App\Models\Cart;
use App\Models\CartItem;
use PDO; 


class CartController
{
    private $pdo;
    private $cart;
    private $cartItem;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
        $this->cart = new Cart($this->pdo);
        $this->cartItem = new CartItem($this->pdo);
    }

    public function addToCart($cart_id, $artwork_id, $quantity)
    {
        // Trouver l'artwork par son ID
        $artwork = Artwork::find($this->pdo, $artwork_id);

        // Ajouter l'article au panier
        $result = CartItem::add($this->pdo, $cart_id, $artwork, $quantity);

        if ($result) {
            echo json_encode(['status' => 'success', 'message' => 'L\'article a été ajouté au panier.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Une erreur est survenue.']);
        }
    }

    public function removeFromCart($cart_id, $artwork_id)
    {
        $this->cartItem->cart_id = $cart_id;
        $this->cartItem->artwork_id = $artwork_id;

        if ($this->cartItem->delete()) {
            return json_encode(['message' => 'Item removed from cart']);
        } else {
            return json_encode(['message' => 'Failed to remove item']);
        }
    }

    public function viewCart($cart_id)
    {
        $cartItems = $this->cartItem->read($cart_id);

        $items = [];
        while ($row = $cartItems->fetch(PDO::FETCH_ASSOC)) {
            $items[] = $row;
        }

        echo json_encode($items);
    }
}
