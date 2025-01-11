<?php
namespace App\Models;

class Product {
    private $conn;
    private $table = 'products';

    public $id;
    public $name;
    public $price;

    public function __construct($db) 
    {
        $this->conn = $db;
    }

    public function getAll() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create() {
        $query = "INSERT INTO " . $this->table . "SET name = :name, price = :price";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':price', $this->price);

        return $stmt->execute();
    }
}