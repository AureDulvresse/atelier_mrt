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
    public $medium_id;
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

    // public static function createFromDatabaseRow($row)
    // {
    //     $instance = new self(
    //         $row['first_name'],
    //         $row['last_name'],
    //         $row['email'],
    //         $row['password'],
    //         $row['is_superuser'],
    //         $row['is_staff'],
    //     );

    //     $instance->id = $row['id'];
    //     $instance->created_at = $row['created_at'];
    //     $instance->updated_at = $row['updated_at'];

    //     return $instance;
    // }

    public function save($pdo)
    {
        $sql = "INSERT INTO" . $this->table_name . " (title, slug, description, price, stock, width, height, thumbnail, category_id, medium_id, created_at, updated_at) 
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
        $sql = "UPDATE" . $this->table_name . " SET title = :title, slug = :slug, description = :description, price = :price, stock = :stock, 
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
        $sql = "SELECT * FROM artworks WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Artwork::class);
        return $stmt->fetch();
        // $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // if ($row) {
        //     return self::createFromDatabaseRow($row);
        // }

        // return null;
    }

    public static function all($pdo)
    {
        $sql = "SELECT * FROM artworks";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Artwork');
    }

    public static function delete($pdo, $id)
    {
        $sql = "DELETE FROM artworks WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
