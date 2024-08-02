<?php

namespace App\Models;

use PDO;

class Cart
{
    private $conn;
    private $table_name = 'carts';

    public $id;
    public $customer_id;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . " SET customer_id=:customer_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':customer_id', $this->customer_id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function get($customer_id)
    {
        $query = "SELECT id FROM " . $this->table_name . " WHERE customer_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $customer_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
