<?php

require 'models/Cart.php';
require 'models/Order.php';

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

    public function addToCart()
    {
        $cart_id = $_POST['cart_id'];
        $artwork_id = $_POST['artwork_id'];
        $quantity = $_POST['quantity'];

        $this->cartItem->cart_id = $cart_id;
        $this->cartItem->artwork_id = $artwork_id;
        $this->cartItem->quantity = $quantity;

        if ($this->cartItem->update()) {
            echo json_encode(['message' => 'Cart updated']);
        } else {
            echo json_encode(['message' => 'Failed to update cart']);
        }
    }

    public function removeFromCart()
    {
        $cart_id = $_POST['cart_id'];
        $artwork_id = $_POST['artwork_id'];

        $this->cartItem->cart_id = $cart_id;
        $this->cartItem->artwork_id = $artwork_id;

        if ($this->cartItem->delete()) {
            echo json_encode(['message' => 'Item removed from cart']);
        } else {
            echo json_encode(['message' => 'Failed to remove item']);
        }
    }

    public function viewCart()
    {
        $cart_id = $_POST['cart_id'];
        $cartItems = $this->cartItem->read($cart_id);

        $items = [];
        while ($row = $cartItems->fetch(PDO::FETCH_ASSOC)) {
            $items[] = $row;
        }

        echo json_encode($items);
    }
}
?>