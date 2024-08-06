<?php

namespace App\Models;

use PDO;

class Order
{
    private $conn;
    private $table_name = 'orders';

    public $id;
    public $uuid;
    public $customer_id;
    public $total_amount;
    public $status;
    public $order;
    public $created_at;
    public $updated_at;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Crée une nouvelle commande
    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . " 
                  SET uuid=:uuid, customer_id=:customer_id, total_amount=:total_amount, status=:status, created_at=:created_at, updated_at=:updated_at";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':uuid', $this->uuid);
        $stmt->bindParam(':customer_id', $this->customer_id);
        $stmt->bindParam(':total_amount', $this->total_amount);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':created_at', $this->created_at);
        $stmt->bindParam(':updated_at', $this->updated_at);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Lire une commande spécifique par son ID
    public function get($id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Lire toutes les commandes d'un client spécifique
    public function getByCustomer($customer_id)
    {
        $query = "SELECT orders.*, customers.name as customer_name, artworks.title as artwork_title
              FROM " . $this->table_name . "
              INNER JOIN customers ON orders.customer_id = customers.id
              INNER JOIN artworks ON orders.artwork_id = artworks.id
              WHERE orders.customer_id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $customer_id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    public static function all($pdo)
    {
        $sql = "SELECT orders.*, customers.first_name as customer_first_name
            FROM orders
            INNER JOIN customers ON orders.customer_id = customers.id";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
