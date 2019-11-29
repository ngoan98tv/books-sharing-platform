<?php

namespace App\Models;

use PDO;

class Uploader {
    public $id;
    public $username;
    public $name; 
    public $email;
    public $uploaded; 

    function __construct($uploader) {
        $this->id           = $uploader['id'];
        $this->username     = $uploader['username'];
        $this->name         = $uploader['name']; 
        $this->email        = $uploader['email']; 
        $this->uploaded     = $uploader['uploaded']; 
    }
        
    public static function sign_in($username, $password) {
        try {
            $conn = Db::connect();
            $stmt = $conn->prepare("SELECT * FROM uploader WHERE username = :username;");
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            $result = $stmt->fetch();

            if (!empty($result)) {
                if ($result['password'] == Uploader::hash_password($password, $username)) {
                    return new Uploader($result);
                } 
                return 'wrong-passwd';
            } else {
                return 'wrong-username';
            }
        } catch(PDOException $e) {
            return 'db-error';
        }
    }

    public static function sign_up($uploader) {
        if (!Uploader::is_valid_username($uploader['username'])) return 2;
        if (!Uploader::is_valid_email($uploader['email'])) return 3;
        try {
            $conn = Db::connect();
            $stmt = $conn->prepare("INSERT INTO uploader (username, name, email, password)
                                    VALUES (:username, :name, :email, :password);");
            $stmt->bindParam(':username', $uploader['username']);
            $stmt->bindParam(':name', $uploader['name']); 
            $stmt->bindParam(':email', $uploader['email']); 
            $stmt->bindParam(':password', Uploader::hash_password($uploader['password'], $uploader['username']));
            $stmt->execute();
            return 0;
        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }

    public static function hash_password($password, $username) {
        return sha1(md5($username.$password).$password);
    }

    public static function findById($id) {
        try {
            $conn = Db::connect();
            $stmt = $conn->prepare("SELECT * FROM uploader WHERE id = :id");
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $result = $stmt->fetch();
            return new Uploader($result);
        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }

    

    public static function is_valid_username($username) {
        $conn = Db::connect();
        $stmt = $conn->prepare("SELECT * FROM uploader WHERE username = :username;");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->rowCount() == 0;
    }

    public static function is_valid_email($email) {
        $conn = Db::connect();
        $stmt = $conn->prepare("SELECT * FROM uploader WHERE email = :email;");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->rowCount() == 0;
    }

    public static function get_top_uploaders() {
        $conn = Db::connect();
        $stmt = $conn->prepare("SELECT uploader_id as id, username, name, email, COUNT(*) AS uploaded 
                                FROM book b JOIN uploader u ON b.uploader_id = u.id
                                GROUP BY uploader_id 
                                ORDER BY uploaded DESC
                                LIMIT 10;");
        $stmt->execute();
        $uploaders = [];
        while ($result = $stmt->fetch()) {
            array_push($uploaders, new Uploader($result));
        }
        return $uploaders;
    }

}

?>