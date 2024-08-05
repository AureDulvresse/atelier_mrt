<?php

namespace App\Models;

use PDO;

class CartItem
{
    private $conn;
    private $table_name = 'cart_items';

    public $id;
    public $cart_id;
    public $artwork_id;
    public $quantity;

    public function __construct($db)
    {
        $this->conn = $db;
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
        $stmt = $this->conn->prepare($query);
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
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':cart_id', $this->cart_id);
        $stmt->bindParam(':artwork_id', $this->artwork_id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function read($cart_id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE cart_id = :cart_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':cart_id', $cart_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
