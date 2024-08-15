<?php

namespace App\Models;

use PDO;

class Customer
{
    private $table_name = 'customers';

    public $id;
    public $first_name;
    public $last_name;
    public $email;
    public $password;
    public $last_login;
    public $is_staff;
    public $is_superuser;
    public $is_active;
    public $created_at;
    public $updated_at;

    public function __construct($first_name, $last_name, $email, $password, $is_superuser = 0, $is_staff = 0, $is_active = 1)
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_BCRYPT);
        $this->is_superuser = $is_superuser;
        $this->is_staff = $is_staff;
        $this->is_active = $is_active;
    }

    public static function createFromDatabaseRow($row)
    {
        $instance = new self(
            $row['first_name'],
            $row['last_name'],
            $row['email'],
            $row['password'],
            $row['is_superuser'],
            $row['is_staff'],
        );

        $instance->id = $row['id'];
        $instance->created_at = $row['created_at'];
        $instance->updated_at = $row['updated_at'];

        return $instance;
    }

    public function save($pdo)
    {
        $sql = "INSERT INTO " . $this->table_name . " (first_name, last_name, email, password, is_superuser, is_staff, is_active) 
                VALUES (:first_name, :last_name, :email, :password, :is_superuser, :is_staff, :is_active)";
        $stmt = $pdo->prepare($sql);
        $params = [
            ':first_name' => $this->first_name,
            ':last_name' => $this->last_name,
            ':email' => $this->email,
            ':password' => $this->password,
            ':is_superuser' => $this->is_superuser,
            ':is_staff' => $this->is_staff,
            ':is_active' => $this->is_active,
        ];
        return $stmt->execute($params);
    }

    public function update($pdo)
    {
        $sql = "UPDATE " . $this->table_name . " SET first_name = :first_name, last_name = :last_name, email = :email, 
                password = :password, is_superuser = :is_superuser, is_staff = :is_staff, is_active = :is_active, 
                last_login = :last_login WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $params = [
            ':first_name' => $this->first_name,
            ':last_name' => $this->last_name,
            ':email' => $this->email,
            ':password' => $this->password,
            ':is_superuser' => $this->is_superuser,
            ':is_staff' => $this->is_staff,
            ':is_active' => $this->is_active,
            ':last_login' => $this->last_login,
            ':id' => $this->id
        ];
        return $stmt->execute($params);
    }

    public static function all($pdo)
    {
        $sql = "SELECT * FROM customers";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Customer');
    }

    public static function findById($pdo, $id)
    {
        $sql = "SELECT * FROM customers WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return self::createFromDatabaseRow($row);
        }

        return null;
    }

    public static function findByEmail($pdo, $email)
    {
        $sql = "SELECT * FROM customers WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':email' => $email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return self::createFromDatabaseRow($row);
        }

        return null;
    }

    public static function delete($pdo, $id)
    {
        $sql = "DELETE FROM customers WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    public static function count($pdo)
    {
        $query = "SELECT COUNT(*) as count FROM customers";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'];
    }

}
