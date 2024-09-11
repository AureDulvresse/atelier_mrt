<?php

namespace App\Models;

use PDO;

require_once 'utils/slugify.php';

use App\Models\Artwork;

class Post
{
    private $table_name = 'posts';

    public $id;
    public $title;
    public $slug;
    public $content;
    public $post_type;
    public $event_date;
    public $event_location;
    public $thumbnail;
    public $created_at;
    public $updated_at;

    public function __construct($title, $content = null, $post_type = null, $event_date = null, $event_location = null, $thumbnail = null)
    {
        $this->title = $title;
        $this->slug = $title ? slugify($title) : null; // Gestion des titres nuls
        $this->content = $content;
        $this->post_type = $post_type;
        $this->event_date = $event_date;
        $this->event_location = $event_location;
        $this->thumbnail = $thumbnail;
        $this->created_at = date('Y-m-d H:i:s');
        $this->updated_at = date('Y-m-d H:i:s');
    }

    public static function createFromDatabaseRow($row)
    {
        $instance = new self(
            $row['title'],
            $row['content'],
            $row['post_type'],
            $row['event_date'],
            $row['event_location'],
            $row['thumbnail'],
        );

        $instance->id = $row['id'];
        $instance->created_at = $row['created_at'];
        $instance->updated_at = $row['updated_at'];

        return $instance;
    }

    public function save($pdo)
    {
        $sql = "INSERT INTO " . $this->table_name . " (title, slug, content, post_type, event_date, event_location, thumbnail, created_at, updated_at) 
                VALUES (:title, :slug, :content, :post_type, :event_date, :event_location, :thumbnail, :created_at, :updated_at)";
        $stmt = $pdo->prepare($sql);
        $params = [
            ':title' => $this->title,
            ':slug' => $this->slug,
            ':content' => $this->content,
            ':post_type' => $this->post_type,
            ':event_date' => $this->event_date,
            ':event_location' => $this->event_location,
            ':thumbnail' => $this->thumbnail,
            ':created_at' => $this->created_at,
            ':updated_at' => $this->updated_at
        ];
        return $stmt->execute($params);
    }

    public function update($pdo)
    {
        $sql = "UPDATE " . $this->table_name . " SET title = :title, slug = :slug, content = :content, event_date = :event_date, event_location = :event_location,
                 thumbnail = :thumbnail, updated_at = :updated_at 
                 WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $params = [
            ':title' => $this->title,
            ':slug' => $this->slug,
            ':content' => $this->content,
            ':post_type' => $this->post_type,
            ':event_date' => $this->event_date,
            ':event_location' => $this->event_location,
            ':thumbnail' => $this->thumbnail,
            ':updated_at' => $this->updated_at,
            ':id' => $this->id
        ];
        return $stmt->execute($params);
    }

    public static function find($pdo, $id)
    {
        $sql = "SELECT * FROM posts WHERE id = :id";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return self::createFromDatabaseRow($row);
        }

        return null;
    }


    public static function all($pdo, $order_by = "updated_at DESC")
    {
        // Requête SQL pour récupérer les œuvres avec les noms des catégories et des mediums
        $sql = "SELECT * FROM posts ORDER BY " . $order_by;

        // Préparation et exécution de la requête
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

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
        $sql = "DELETE FROM posts WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    public static function count($pdo)
    {
        $query = "SELECT COUNT(*) as count FROM posts";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'];
    }

    public function attachArtwork($pdo, $artworkId)
    {
        $query = "INSERT INTO post_event_artworks (post_id, artwork_id) VALUES (?, ?)";
        $stmt = $pdo->prepare($query);
        return $stmt->execute([$this->id, $artworkId]);
    }

    public function detachArtwork($pdo, $artworkId)
    {
        $query = "DELETE FROM post_event_artworks WHERE post_id = ? AND artwork_id = ?";
        $stmt = $pdo->prepare($query);
        return $stmt->execute([$this->id, $artworkId]);
    }

    public function getArtworks($pdo)
    {
        $query = "SELECT a.* FROM artworks a JOIN post_event_artworks pea ON a.id = pea.artwork_id WHERE pea.post_id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$this->id]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $artworks = [];
        foreach ($results as $result) {
            $artwork = Artwork::createFromDatabaseRow($result); // Utilisation de la connexion PDO
            $artworks[] = $artwork;
        }

        return $artworks;
    }

}
