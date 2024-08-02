<?php

use App\Models\Category;

class CategoryController
{
    private $category;

    public function __construct($pdo)
    {
        $this->category = new Category($pdo);
    }

    public function create()
    {
        $this->category->name = $_POST['name'];
        $this->category->description = $_POST['description'];

        if ($this->category->create()) {
            echo json_encode(["success" => true, "message" => "Category created successfully."]);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to create category."]);
        }
    }

    public function read($id)
    {
        $data = $this->category->read($id);
        if ($data) {
            echo json_encode(["success" => true, "data" => $data]);
        } else {
            echo json_encode(["success" => false, "message" => "Category not found."]);
        }
    }

    public function update()
    {
        $this->category->id = $_POST['id'];
        $this->category->name = $_POST['name'];
        $this->category->description = $_POST['description'];

        if ($this->category->update()) {
            echo json_encode(["success" => true, "message" => "Category updated successfully."]);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to update category."]);
        }
    }

    public function delete($id)
    {
        if ($this->category->delete($id)) {
            echo json_encode(["success" => true, "message" => "Category deleted successfully."]);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to delete category."]);
        }
    }

    public function getAll()
    {
        $data = $this->category->getAll();
        echo json_encode(["success" => true, "data" => $data]);
    }
}
