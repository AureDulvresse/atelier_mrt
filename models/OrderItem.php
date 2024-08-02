<?php

namespace App\Models;

class OrderItem
{
    private $conn;
    private $table_name = 'order_items';

    public $id;
    public $order_id;
    public $artwork_id;
    public $quantity;
    public $price;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Ajouter un article à une commande
    public function add()
    {
        $query = "INSERT INTO " . $this->table_name . " 
                  SET order_id=:order_id, artwork_id=:artwork_id, quantity=:quantity, price=:price";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':order_id', $this->order_id);
        $stmt->bindParam(':artwork_id', $this->artwork_id);
        $stmt->bindParam(':quantity', $this->quantity);
        $stmt->bindParam(':price', $this->price);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Lire tous les articles d'une commande spécifique
    public function read($order_id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE order_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $order_id);
        $stmt->execute();
        return $stmt;
    }

    // Mettre à jour la quantité d'un article dans une commande
    public function update()
    {
        $query = "UPDATE " . $this->table_name . " 
                  SET quantity = :quantity, price = :price 
                  WHERE order_id = :order_id AND artwork_id = :artwork_id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':quantity', $this->quantity);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':order_id', $this->order_id);
        $stmt->bindParam(':artwork_id', $this->artwork_id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Supprimer un article d'une commande
    public function delete()
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE order_id = :order_id AND artwork_id = :artwork_id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':order_id', $this->order_id);
        $stmt->bindParam(':artwork_id', $this->artwork_id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
