<?php

namespace App\Models;

use PDO;

class Medium
{
    private $table = 'mediums';

    public $id;
    public $name;
    public $created_at;
    public $updated_at;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function save($pdo)
    {
        $query = "INSERT INTO " . $this->table . " (name, created_at, updated_at) VALUES (?, NOW(), NOW())";
        $stmt = $pdo->prepare($query);
        $stmt->bind_param("s", $this->name);
        return $stmt->execute();
    }

    public function update($pdo)
    {
        $query = "UPDATE " . $this->table . " SET name = ?, updated_at = NOW() WHERE id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->bind_param("si", $this->name, $this->id);
        return $stmt->execute();
    }

    public static function delete($pdo, $id)
    {
        $query = "DELETE FROM mediums WHERE id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public static function all($pdo)
    {
        $query = "SELECT * FROM mediums";
        $result = $pdo->query($query);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
}
