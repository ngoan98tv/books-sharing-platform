<?php

namespace App\Models;

use PDO;

class Db {
    public static function connect() {
        $hostname = "localhost";
        $username = "admin";
        $password = "pass";
        $database = "books";
    
        try {
            $conn = new PDO("mysql:host=$hostname;dbname=$database;charset=utf8", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            return null;
        }
    }
}

?>