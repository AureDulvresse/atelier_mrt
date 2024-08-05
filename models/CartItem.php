<?php

namespace App\Models;

use PDO;

class CartItem
{
    private $pdo;
    private $table_name = 'cart_items';

    public $id;
    public $cart_id;
    public $artwork_id;
    public $artwork;
    public $quantity;

    public function __construct($db)
    {
        $this->pdo = $db;
    }

    public static function add($pdo, $cart_id, $artwork, $quantity)
    {
        // Extraire l'id du tableau $cart_id et de l'objet $artwork
        $cart_id_value = $cart_id['id'];
        $artwork_id_value = $artwork->id;

        $sql = "INSERT INTO cart_items (cart_id, artwork_id, quantity) VALUES (:cart_id, :artwork_id, :quantity)";
        $stmt = $pdo->prepare($sql);

        // Lier les valeurs extraites aux paramètres de la requête
        $stmt->bindParam(':cart_id', $cart_id_value, PDO::PARAM_INT);
        $stmt->bindParam(':artwork_id', $artwork_id_value, PDO::PARAM_INT);
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function update()
    {
        $query = "UPDATE " . $this->table_name . " SET quantity = :quantity WHERE cart_id = :cart_id AND artwork_id = :artwork_id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':quantity', $this->quantity);
        $stmt->bindParam(':cart_id', $this->cart_id);
        $stmt->bindParam(':artwork_id', $this->artwork_id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete()
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE cart_id = :cart_id AND artwork_id = :artwork_id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':cart_id', $this->cart_id);
        $stmt->bindParam(':artwork_id', $this->artwork_id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function read($cart_id)
    {
        $query = "SELECT cart_items.*, artworks.* FROM " . $this->table_name . " 
              INNER JOIN artworks 
              ON " . $this->table_name . ".artwork_id = artworks.id
              WHERE cart_id = :cart_id";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':cart_id', $cart_id, PDO::PARAM_INT);
        $stmt->execute();

        // Utilisation de FETCH_CLASS pour mapper les résultats
        $cartItems = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $cartItem = new self($this->pdo);
            $cartItem->cart_id = $row['cart_id'];
            $cartItem->artwork_id = $row['artwork_id'];
            $cartItem->quantity = $row['quantity'];

            // Mapper les colonnes des artworks à l'objet Artwork
            $cartItem->artwork = new Artwork($row['title'], $row['description'], $row['price'], $row['stock'], $row['width'], $row['height'], $row['thumbnail'], $row['category_id'], $row['medium_id']);
            $cartItem->artwork->id = $row['id'];
            $cartItem->artwork->category_name = $row['category_name'];
            $cartItem->artwork->medium_name = $row['medium_name'];
            $cartItem->artwork->created_at = $row['created_at'];
            $cartItem->artwork->updated_at = $row['updated_at'];

            $cartItems[] = $cartItem;
        }

        return $cartItems;
    }

}
