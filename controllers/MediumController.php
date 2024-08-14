<?php

use App\Models\Medium;

class MediumController
{
    private $medium;

    public function __construct($pdo)
    {
        $this->medium = new Medium($pdo);
    }

    public function create()
    {
        $this->medium->name = $_POST['name'];

        if ($this->medium->create()) {
            echo json_encode(["success" => true, "message" => "Medium created successfully."]);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to create medium."]);
        }
    }

    public function read($id)
    {
        $data = $this->medium->read($id);
        if ($data) {
            echo json_encode(["success" => true, "data" => $data]);
        } else {
            echo json_encode(["success" => false, "message" => "Medium not found."]);
        }
    }

    public function update()
    {
        $this->medium->id = $_POST['id'];
        $this->medium->name = $_POST['name'];

        if ($this->medium->update()) {
            echo json_encode(["success" => true, "message" => "Medium updated successfully."]);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to update medium."]);
        }
    }

    public function delete($id)
    {
        if ($this->medium->delete($id)) {
            echo json_encode(["success" => true, "message" => "Medium deleted successfully."]);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to delete medium."]);
        }
    }

    public function getAll($pdo)
    {
        $data = Medium::all($pdo);
        echo json_encode(["success" => true, "data" => $data]);
    }
}
