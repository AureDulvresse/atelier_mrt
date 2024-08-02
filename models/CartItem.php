<?php


class CartItem
{
    private $conn;
    private $table_name = 'cart_items';

    public $id;
    public $cart_id;
    public $artwork_id;
    public $quantity;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function add()
    {
        $query = "INSERT INTO " . $this->table_name . " SET cart_id=:cart_id, artwork_id=:artwork_id, quantity=:quantity";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':cart_id', $this->cart_id);
        $stmt->bindParam(':artwork_id', $this->artwork_id);
        $stmt->bindParam(':quantity', $this->quantity);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function update()
    {
        $query = "UPDATE " . $this->table_name . " SET quantity = :quantity WHERE cart_id = :cart_id AND artwork_id = :artwork_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':quantity', $this->quantity);
        $stmt->bindParam(':cart_id', $this->cart_id);
        $stmt->bindParam(':artwork_id', $this->artwork_id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete()
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE cart_id = :cart_id AND artwork_id = :artwork_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':cart_id', $this->cart_id);
        $stmt->bindParam(':artwork_id', $this->artwork_id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function read($cart_id)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE cart_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $cart_id);
        $stmt->execute();
        return $stmt;
    }
}
