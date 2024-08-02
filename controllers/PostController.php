<?php

require_once '../models/Post.php';

class PostController
{
    private $post;

    public function __construct($pdo)
    {
        $this->post = new Post($pdo);
    }

    public function create()
    {
        $this->post->title = $_POST['title'];
        $this->post->slug = $_POST['slug'];
        $this->post->content = $_POST['content'];
        $this->post->post_type = $_POST['post_type'];
        $this->post->event_date = $_POST['event_date'];
        $this->post->event_location = $_POST['event_location'];

        $postId = $this->post->create();
        if ($postId) {
            echo json_encode(["success" => true, "message" => "Post created successfully.", "post_id" => $postId]);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to create post."]);
        }
    }

    public function read($id)
    {
        $data = $this->post->read($id);
        if ($data) {
            echo json_encode(["success" => true, "data" => $data]);
        } else {
            echo json_encode(["success" => false, "message" => "Post not found."]);
        }
    }

    public function update()
    {
        $this->post->id = $_POST['id'];
        $this->post->title = $_POST['title'];
        $this->post->slug = $_POST['slug'];
        $this->post->content = $_POST['content'];
        $this->post->post_type = $_POST['post_type'];
        $this->post->event_date = $_POST['event_date'];
        $this->post->event_location = $_POST['event_location'];

        if ($this->post->update()) {
            echo json_encode(["success" => true, "message" => "Post updated successfully."]);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to update post."]);
        }
    }

    public function delete($id)
    {
        if ($this->post->delete($id)) {
            echo json_encode(["success" => true, "message" => "Post deleted successfully."]);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to delete post."]);
        }
    }

    public function attachArtwork()
    {
        $postId = $_POST['post_id'];
        $artworkId = $_POST['artwork_id'];

        $this->post->id = $postId;

        if ($this->post->attachArtwork($artworkId)) {
            echo json_encode(["success" => true, "message" => "Artwork attached successfully."]);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to attach artwork."]);
        }
    }

    public function detachArtwork()
    {
        $postId = $_POST['post_id'];
        $artworkId = $_POST['artwork_id'];

        $this->post->id = $postId;

        if ($this->post->detachArtwork($artworkId)) {
            echo json_encode(["success" => true, "message" => "Artwork detached successfully."]);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to detach artwork."]);
        }
    }

    public function getArtworks($postId)
    {
        $this->post->id = $postId;
        $data = $this->post->getArtworks();
        echo json_encode(["success" => true, "data" => $data]);
    }
}
