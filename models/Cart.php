<?php

namespace App\Models;

use PDO;

class Cart
{
    private $conn;
    // private $table_name = 'carts';

    public $id;
    public $customer_id;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public static function create($pdo, $customer_id)
    {
        $query = "INSERT INTO cart SET customer_id=:customer_id";
        // $stmt = $this->conn->prepare($query);
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':customer_id', $customer_id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public static function get($pdo, $customer_id)
    {
        $query = "SELECT id FROM cart WHERE customer_id = ?";
        // $stmt = $this->conn->prepare($query);
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(1, $customer_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
