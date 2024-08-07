<?php

namespace App\Models;

use PDO;

class Category
{
    private $conn;
    private $table = 'categories';

    public $id;
    public $name;
    public $description;
    public $created_at;
    public $updated_at;

    public function __construct($pdo)
    {
        $this->conn = $pdo;
    }

    public function create()
    {
        $query = "INSERT INTO " . $this->table . " (name, description, created_at, updated_at) VALUES (?, ?, NOW(), NOW())";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ss", $this->name, $this->description);
        return $stmt->execute();
    }

    public function read($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function update()
    {
        $query = "UPDATE " . $this->table . " SET name = ?, description = ?, updated_at = NOW() WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssi", $this->name, $this->description, $this->id);
        return $stmt->execute();
    }

    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public static function all($pdo)
    {
        $query = "SELECT * FROM categories";
        $result = $pdo->query($query);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
}
