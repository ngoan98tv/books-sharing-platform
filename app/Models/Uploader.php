<?php

namespace Models;

use Db;
use PDO;

class Uploader {
    public $id;
    public $username;
    public $name; 
    public $email; 

    function __construct($uploader) {
        $this->id           = $uploader['id'];
        $this->username     = $uploader['username'];
        $this->name         = $uploader['name']; 
        $this->email        = $uploader['email']; 
    }
        
    public static function sign_in($username, $password) {
        try {
            $conn = Db\connect();
            $stmt = $conn->prepare("SELECT * FROM uploader WHERE username = :username;");
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            $result = $stmt->fetch();

            if (!empty($result)) {
                if ($result['password'] == Uploader::hash_password($password, $username)) {
                    return new Uploader($result);
                } 
                return -1;
            } else {
                return 0;
            }
        } catch(PDOException $e) {
            return -2;
        }
    }

    public static function sign_up($uploader) {
        try {
            $conn = Db\connect();
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

    function get_uploader($username) {
        $conn = connect_db();
        $result = $conn->query("SELECT * FROM uploader WHERE username = '$username'");
        $conn->close();
        if ($result->num_rows > 0) {
            $uploader = $result->fetch_assoc();
            return $uploader;
        } else {
            return null;
        }
    }

    

    function is_valid_username($username) {
        $conn = connect_db();
        $result = $conn->query("SELECT * FROM uploader WHERE username = '$username'");
        $conn->close();
        if ($result->num_rows == 0) {
            return true;
        } else {
            return false;
        }
    }

    function is_valid_email($email) {
        $conn = connect_db();
        $result = $conn->query("SELECT * FROM uploader WHERE email = '$email'");
        $conn->close();
        if ($result->num_rows == 0) {
            return true;
        } else {
            return false;
        }
    }

    function get_top_uploaders() {
        $conn = connect_db();
        $result = $conn->query("SELECT uploader_id, username, name, COUNT(*) AS uploaded 
                                FROM uploader b JOIN uploader u ON b.uploader_id = u.id
                                GROUP BY uploader_id 
                                ORDER BY uploaded DESC 
                                LIMIT 10;");
        $conn->close();
        return $result;
    }

    

}

?>