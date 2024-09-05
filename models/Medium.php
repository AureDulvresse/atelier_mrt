<?php

namespace App\Models;

use PDO;

class Medium
{
    private $table_name = 'mediums';

    public $id;
    public $name;
    public $created_at;
    public $updated_at;

    public function __construct($name)
    {
        $this->name = $name;
        $this->created_at = date('Y-m-d H:i:s');
        $this->updated_at = date('Y-m-d H:i:s');
    }

    public static function createFromDatabaseRow($row)
    {
        $instance = new self(
            $row['name'],
        );

        $instance->id = $row['id'];
        $instance->created_at = $row['created_at'];
        $instance->updated_at = $row['updated_at'];

        return $instance;
    }

    public function save($pdo)
    {
        $sql = "INSERT INTO " . $this->table_name . " (name, created_at, updated_at) 
                VALUES (:name, :created_at, :updated_at)";
        $stmt = $pdo->prepare($sql);
        $params = [
            ':name' => $this->name,
            ':created_at' => $this->created_at,
            ':updated_at' => $this->updated_at
        ];
        return $stmt->execute($params);
    }

    public function update($pdo)
    {
        $sql = "UPDATE " . $this->table_name . " SET name = :name, updated_at = :updated_at WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $params = [
            ':name' => $this->name,
            ':updated_at' => $this->updated_at,
            ':id' => $this->id
        ];
        return $stmt->execute($params);
    }

    public static function find($pdo, $id)
    {
        $sql = "SELECT * FROM mediums WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return self::createFromDatabaseRow($row);
        }

        return null;
    }


    public static function delete($pdo, $id)
    {
        $query = "DELETE FROM mediums WHERE id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public static function all($pdo, $order_by = "updated_at DESC")
    {
        $query ="SELECT * FROM mediums
                ORDER BY " . $order_by;
        $stmt = $pdo->query($query);

        // Récupération des résultats sous forme de tableau associatif
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Vérification si des résultats ont été trouvés
        if ($rows) {
            // Création d'objets Artwork à partir des résultats de la base de données
            $artworks = [];
            foreach ($rows as $row) {
                $mediums[] = self::createFromDatabaseRow($row);
            }
            return $mediums;
        }

        // Retourne null s'il n'y a pas de résultats
        return null;
    }
}
