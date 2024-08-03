<?php

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Artwork;

class CartController
{
    private $db;
    private $cart;
    private $cartItem;

    public function __construct($pdo)
    {
        $this->db = $pdo;
        $this->cart = new Cart($this->db);
        $this->cartItem = new CartItem($this->db);
    }

    public function addToCart($cart_id, $artwork_id, $quantity)
    {
        $this->cartItem->cart_id = $cart_id;
        $this->cartItem->artwork_id = $artwork_id;
        $this->cartItem->quantity = $quantity;

        if ($this->cartItem->update()) {
            return json_encode(['message' => 'Cart updated']);
        } else {
            return json_encode(['message' => 'Failed to update cart']);
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


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    switch ($action) {
        case 'add':
            $artwork = Artwork::find($pdo, $_POST['artwork_id'] ?? 1);
            $cart = Cart::get($pdo, $_SESSION['cart'] ?? 1);
            $qte = $_POST['quantity'];

            $cart_controller = new CartController($pdo);

            $result = $cart_controller->addToCart($cart, $artwork, $qte);

            header('Location: /atelier/shop/artwork/' . $_POST['artwork_id']);
            break;
        
        default:
            # code...
            break;
    }
}
