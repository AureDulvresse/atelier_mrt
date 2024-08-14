<?php

namespace App\Models;

use PDO;

class Medium
{
    private $conn;
    private $table = 'mediums';

    public $id;
    public $name;
    public $created_at;
    public $updated_at;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create()
    {
        $query = "INSERT INTO " . $this->table . " (name, created_at, updated_at) VALUES (?, NOW(), NOW())";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $this->name);
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
        $query = "UPDATE " . $this->table . " SET name = ?, updated_at = NOW() WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("si", $this->name, $this->id);
        return $stmt->execute();
    }

    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public static function getAll($pdo)
    {
        $query = "SELECT * FROM mediums";
        $result = $pdo->query($query);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
}
