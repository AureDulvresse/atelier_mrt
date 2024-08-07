<?php

namespace App\Models;

require_once 'utils/slugify.php';

use PDO;

class Artwork
{

    private $table_name = 'artworks';

    public $id;
    public $title;
    public $slug;
    public $description;
    public $price;
    public $stock;
    public $width;
    public $height;
    public $thumbnail;
    public $category_id;
    public $category_name;
    public $medium_id;
    public $medium_name;
    public $created_at;
    public $updated_at;

    public function __construct($title, $description, $price, $stock, $width, $height, $thumbnail, $category_id, $medium_id)
    {
        $this->title = $title;
        $this->slug = slugify($title);
        $this->description = $description;
        $this->price = $price;
        $this->stock = $stock;
        $this->width = $width;
        $this->height = $height;
        $this->thumbnail = $thumbnail;
        $this->category_id = $category_id;
        $this->medium_id = $medium_id;
        $this->created_at = date('Y-m-d H:i:s');
        $this->updated_at = date('Y-m-d H:i:s');
    }

    public static function createFromDatabaseRow($row)
    {
        $instance = new self(
            $row['title'],
            $row['description'],
            $row['price'],
            $row['stock'],
            $row['width'],
            $row['height'],
            $row['thumbnail'],
            $row['category_id'],
            $row['medium_id']
        );

        $instance->id = $row['id'];
        $instance->category_name = $row['category_name'];
        $instance->medium_name = $row['medium_name'];
        $instance->created_at = $row['created_at'];
        $instance->updated_at = $row['updated_at'];

        return $instance;
    }

    public function save($pdo)
    {
        $sql = "INSERT INTO " . $this->table_name . " (title, slug, description, price, stock, width, height, thumbnail, category_id, medium_id, created_at, updated_at) 
                VALUES (:title, :slug, :description, :price, :stock, :width, :height, :thumbnail, :category_id, :medium_id, :created_at, :updated_at)";
        $stmt = $pdo->prepare($sql);
        $params = [
            ':title' => $this->title,
            ':slug' => $this->slug,
            ':description' => $this->description,
            ':price' => $this->price,
            ':stock' => $this->stock,
            ':width' => $this->width,
            ':height' => $this->height,
            ':thumbnail' => $this->thumbnail,
            ':category_id' => $this->category_id,
            ':medium_id' => $this->medium_id,
            ':created_at' => $this->created_at,
            ':updated_at' => $this->updated_at
        ];
        return $stmt->execute($params);
    }

    public function update($pdo)
    {
        $sql = "UPDATE " . $this->table_name . " SET title = :title, slug = :slug, description = :description, price = :price, stock = :stock, 
                width = :width, height = :height, thumbnail = :thumbnail, category_id = :category_id, medium_id = :medium_id, 
                updated_at = :updated_at WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $params = [
            ':title' => $this->title,
            ':slug' => $this->slug,
            ':description' => $this->description,
            ':price' => $this->price,
            ':stock' => $this->stock,
            ':width' => $this->width,
            ':height' => $this->height,
            ':thumbnail' => $this->thumbnail,
            ':category_id' => $this->category_id,
            ':medium_id' => $this->medium_id,
            ':updated_at' => $this->updated_at,
            ':id' => $this->id
        ];
        return $stmt->execute($params);
    }

    public static function find($pdo, $id)
    {
        $sql = "SELECT artworks.*, categories.name as category_name, mediums.name as medium_name
            FROM artworks
            INNER JOIN categories ON artworks.category_id = categories.id
            INNER JOIN mediums ON artworks.medium_id = mediums.id
            WHERE artworks.id = :id";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return self::createFromDatabaseRow($row);
        }

        return null;
    }


    public static function all($pdo, $order_by = "updated_at")
    {
        // Requête SQL pour récupérer les œuvres avec les noms des catégories et des mediums
        $sql = "SELECT artworks.*, categories.name as category_name, mediums.name as medium_name
            FROM artworks
            INNER JOIN categories ON artworks.category_id = categories.id
            INNER JOIN mediums ON artworks.medium_id = mediums.id
            ORDER BY :order";

        // Préparation et exécution de la requête
        $stmt = $pdo->prepare($sql);
        $stmt->execute([":order" => $order_by]);

        // Récupération des résultats sous forme de tableau associatif
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Vérification si des résultats ont été trouvés
        if ($rows) {
            // Création d'objets Artwork à partir des résultats de la base de données
            $artworks = [];
            foreach ($rows as $row) {
                $artworks[] = self::createFromDatabaseRow($row);
            }
            return $artworks;
        }

        // Retourne null s'il n'y a pas de résultats
        return null;
    }

    public static function delete($pdo, $id)
    {
        $sql = "DELETE FROM artworks WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    public static function count($pdo)
    {
        $query = "SELECT COUNT(*) as count FROM artworks";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'];
    }

}
