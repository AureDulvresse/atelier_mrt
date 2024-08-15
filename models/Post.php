<?php

namespace App\Models;

use PDO;

use App\Models\Artwork;

class Post
{
    private $conn;
    private $table = 'posts';

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

    public function __construct($pdo)
    {
        $this->conn = $pdo;
    }

    public function create()
    {
        $query = "INSERT INTO " . $this->table . " (title, slug, content, post_type, event_date, event_location, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())";
        $stmt = $this->conn->prepare($query);

        $stmt->execute([$this->title, $this->slug, $this->content, $this->post_type, $this->event_date, $this->event_location]);

        return $this->conn->lastInsertId();
    }

    public function read($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
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
            $post = new self($pdo);
            $post->fill($result);
            $posts[] = $post;
        }

        return $posts;
    }

    public function update()
    {
        $query = "UPDATE " . $this->table . " SET title = ?, slug = ?, content = ?, post_type = ?, event_date = ?, event_location = ?, updated_at = NOW() WHERE id = ?";
        $stmt = $this->conn->prepare($query);

        return $stmt->execute([$this->title, $this->slug, $this->content, $this->post_type, $this->event_date, $this->event_location, $this->id]);
    }

    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$id]);
    }

    public function attachArtwork($artworkId)
    {
        $query = "INSERT INTO post_event_artworks (post_id, artwork_id) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$this->id, $artworkId]);
    }

    public function detachArtwork($artworkId)
    {
        $query = "DELETE FROM post_event_artworks WHERE post_id = ? AND artwork_id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$this->id, $artworkId]);
    }

    public function getArtworks()
    {
        $query = "SELECT a.* FROM artworks a JOIN post_event_artworks pea ON a.id = pea.artwork_id WHERE pea.post_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$this->id]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $artworks = [];
        foreach ($results as $result) {
            $artwork = Artwork::createFromDatabaseRow($result); // Assurez-vous que la classe Artwork est définie
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
