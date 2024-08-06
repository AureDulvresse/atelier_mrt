<?php

namespace App\Models;

use PDO;
use Ramsey\Uuid\Uuid;

class Order
{
    private $conn;
    private $table_name = 'orders';

    public $id;
    public $uuid;
    public $customer_id;
    public $total_amount;
    public $status;
    public $created_at;
    public $updated_at;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Crée une nouvelle commande
    public function create()
    {
        // Générer un UUID v4
        $this->uuid = Uuid::uuid4()->toString();
        $this->created_at = date('Y-m-d H:i:s');
        $this->updated_at = date('Y-m-d H:i:s');

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
        $query = "SELECT * FROM " . $this->table_name . " WHERE customer_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $customer_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lire toutes les commandes et leurs articles
    public static function all($pdo)
    {
        $sql = "SELECT orders.*, customers.name as customer_name, order_items.artwork_id, order_items.quantity, order_items.price as item_price, artworks.title as artwork_title
FROM orders
INNER JOIN customers ON orders.customer_id = customers.id
INNER JOIN order_items ON orders.id = order_items.order_id
INNER JOIN artworks ON order_items.artwork_id = artworks.id";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
