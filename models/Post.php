<?php

namespace App\Models;

use PDO;

require_once 'utils/slugify.php';

use App\Models\Artwork;

class Post
{
    private $table = 'posts';
    private $pdo; // Ajout de la connexion PDO

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

    public function __construct($pdo, $title = null, $content = null, $post_type = null, $event_date = null, $event_location = null, $thumbnail = null)
    {
        $this->pdo = $pdo;
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

    public static function createFromDatabaseRow($pdo, $row)
    {
        $instance = new self(
            $pdo,
            $row['title'],
            $row['content'],
            $row['post_type'],
            $row['event_date'],
            $row['event_location'],
            $row['thumbnail']
        );

        $instance->id = $row['id'];
        $instance->created_at = $row['created_at'];
        $instance->updated_at = $row['updated_at'];

        return $instance;
    }

    public function save()
    {
        $query = "INSERT INTO " . $this->table . " (title, slug, content, post_type, event_date, event_location, thumbnail, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";
        $stmt = $this->pdo->prepare($query);

        if ($stmt->execute([$this->title, $this->slug, $this->content, $this->post_type, $this->event_date, $this->event_location, $this->thumbnail])) {
            $this->id = $this->pdo->lastInsertId(); // Ajout de l'ID après l'insertion
            return $this->id;
        }

        return false; // Gérer l'échec
    }

    public function read($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            $this->fill($data);
            return $this;
        }
        return null;
    }

    public static function all($pdo)
    {
        $query = "SELECT * FROM posts";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $posts = [];
        foreach ($results as $result) {
            $post = self::createFromDatabaseRow($pdo, $result);
            $posts[] = $post;
        }

        return $posts;
    }

    public function update()
    {
        $query = "UPDATE " . $this->table . " SET title = ?, slug = ?, content = ?, post_type = ?, event_date = ?, event_location = ?, thumbnail = ?, updated_at = NOW() WHERE id = ?";
        $stmt = $this->pdo->prepare($query);

        return $stmt->execute([$this->title, $this->slug, $this->content, $this->post_type, $this->event_date, $this->event_location, $this->thumbnail, $this->id]);
    }

    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute([$id]);
    }

    public function attachArtwork($artworkId)
    {
        $query = "INSERT INTO post_event_artworks (post_id, artwork_id) VALUES (?, ?)";
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute([$this->id, $artworkId]);
    }

    public function detachArtwork($artworkId)
    {
        $query = "DELETE FROM post_event_artworks WHERE post_id = ? AND artwork_id = ?";
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute([$this->id, $artworkId]);
    }

    public function getArtworks()
    {
        $query = "SELECT a.* FROM artworks a JOIN post_event_artworks pea ON a.id = pea.artwork_id WHERE pea.post_id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$this->id]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $artworks = [];
        foreach ($results as $result) {
            $artwork = Artwork::createFromDatabaseRow($result); // Utilisation de la connexion PDO
            $artworks[] = $artwork;
        }

        return $artworks;
    }

    public static function countEvents($pdo)
    {
        $query = "SELECT COUNT(*) as count FROM posts WHERE post_type = 'event'";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'];
    }

    private function fill($data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }
}
