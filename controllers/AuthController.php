<?php

class Customer
{
    public $id;
    public $password;
    public $last_login;
    public $is_superuser;
    public $username;
    public $first_name;
    public $last_name;
    public $email;
    public $is_staff;
    public $is_active;
    public $date_joined;

    public function __construct($username, $first_name, $last_name, $email, $password, $is_superuser = false, $is_staff = false, $is_active = true)
    {
        $this->username = $username;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_BCRYPT);
        $this->is_superuser = $is_superuser;
        $this->is_staff = $is_staff;
        $this->is_active = $is_active;
        $this->date_joined = date('Y-m-d H:i:s');
    }

    public function save($pdo)
    {
        $sql = "INSERT INTO customers (username, first_name, last_name, email, password, is_superuser, is_staff, is_active, date_joined) 
                VALUES (:username, :first_name, :last_name, :email, :password, :is_superuser, :is_staff, :is_active, :date_joined)";
        $stmt = $pdo->prepare($sql);
        $params = [
            ':username' => $this->username,
            ':first_name' => $this->first_name,
            ':last_name' => $this->last_name,
            ':email' => $this->email,
            ':password' => $this->password,
            ':is_superuser' => $this->is_superuser,
            ':is_staff' => $this->is_staff,
            ':is_active' => $this->is_active,
            ':date_joined' => $this->date_joined
        ];
        return $stmt->execute($params);
    }

    public static function findById($pdo, $id)
    {
        $sql = "SELECT * FROM customers WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Customer');
        return $stmt->fetch();
    }

    public static function findByEmail($pdo, $email)
    {
        $sql = "SELECT * FROM customers WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':email' => $email]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Customer');
        return $stmt->fetch();
    }

    public function update($pdo)
    {
        $sql = "UPDATE customers SET username = :username, first_name = :first_name, last_name = :last_name, email = :email, 
                password = :password, is_superuser = :is_superuser, is_staff = :is_staff, is_active = :is_active, 
                last_login = :last_login WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $params = [
            ':username' => $this->username,
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

    public static function delete($pdo, $id)
    {
        $sql = "DELETE FROM customers WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    public static function all($pdo)
    {
        $sql = "SELECT * FROM customers";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Customer');
    }
}
