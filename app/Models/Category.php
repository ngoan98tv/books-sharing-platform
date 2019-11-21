<?php

namespace App\Models;

use PDO;

class Category {
    public $id;
    public $name; 

    function __construct($category) {
        $this->id     = $category['id'];
        $this->name   = $category['name']; 
    }
    
    public static function find() {
        $conn = Db::connect();
        $stmt = $conn->prepare("SELECT * FROM category");
        $stmt->execute();
        $categories = [];
        while ($result = $stmt->fetch()) {
            array_push($categories, new Category($result));
        }
        return $categories;
    }

    public static function findById($id) {
        $conn = Db::connect();
        $stmt = $conn->prepare("SELECT * FROM category WHERE id = :id");
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch();
        return new Category($result);
    }

    public static function create($name) {
        $conn = Db::connect();
        $stmt = $conn->prepare("INSERT INTO category (name) VALUES (:name);");
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        return $conn->lastInsertId();
    }

}

?>