<?php

namespace App\Models;

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

        $stmt->bind_param("ssssss", $this->title, $this->slug, $this->content, $this->post_type, $this->event_date, $this->event_location);

        if ($stmt->execute()) {
            return $this->conn->insert_id;
        }
        return false;
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
        $query = "UPDATE " . $this->table . " SET title = ?, slug = ?, content = ?, post_type = ?, event_date = ?, event_location = ?, updated_at = NOW() WHERE id = ?";
        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("ssssssi", $this->title, $this->slug, $this->content, $this->post_type, $this->event_date, $this->event_location, $this->id);

        return $stmt->execute();
    }

    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function attachArtwork($artworkId)
    {
        $query = "INSERT INTO post_event_artworks (post_id, artwork_id) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $this->id, $artworkId);
        return $stmt->execute();
    }

    public function detachArtwork($artworkId)
    {
        $query = "DELETE FROM post_event_artworks WHERE post_id = ? AND artwork_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $this->id, $artworkId);
        return $stmt->execute();
    }

    public function getArtworks()
    {
        $query = "SELECT a.* FROM artworks a JOIN post_event_artworks pea ON a.id = pea.artwork_id WHERE pea.post_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
