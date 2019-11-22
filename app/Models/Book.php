<?php

namespace App\Models;

use PDO;

class Book {
    public $id;
    public $title;
    public $author; 
    public $year; 
    public $coverURL; 
    public $uploader; 
    public $category; 
    public $fileURL;

    function __construct($book) {
        $this->id           = $book['id'];
        $this->title        = $book['title'];
        $this->author       = $book['author']; 
        $this->year         = $book['year']; 
        $this->coverURL     = $book['cover_url']; 
        $this->uploader     = Uploader::findById($book['uploader_id']);
        $this->category     = Category::findById($book['category_id']); 
        $this->fileURL      = $book['file_url'];
    }

    function save() {
        $conn = Db::connect();
        $stmt = $conn->prepare("UPDATE book SET
            title = :title, 
            author = :author, 
            year = :year, 
            cover_url = :cover_url, 
            category_id = :category_id, 
            file_url = :file_url
            WHERE id = :id;"
        );
        $stmt->bindParam(':id',         $this->id);
        $stmt->bindParam(':title',      $this->title);
        $stmt->bindParam(':author',     $this->author); 
        $stmt->bindParam(':year',       $this->year); 
        $stmt->bindParam(':cover_url',   $this->coverURL); 
        $stmt->bindParam(':category_id', $this->categoryId); 
        $stmt->bindParam(':file_url',    $this->fileURL);
        $stmt->execute();
    }

    function delete() {
        $conn = Db::connect();
        $stmt = $conn->prepare("DELETE FROM book WHERE id = :id");
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
    }

    public static function create($book) {
        $conn = Db::connect();
        $stmt = $conn->prepare("INSERT INTO 
            book   (title,  author,  year,  cover_url,  uploader_id,  category_id,  file_url)
            VALUES (:title, :author, :year, :cover_url, :uploader_id, :category_id, :file_url);");
        $stmt->bindParam(':title',       $book['title']);
        $stmt->bindParam(':author',      $book['author']); 
        $stmt->bindParam(':year',        $book['year']); 
        $stmt->bindParam(':cover_url',   $book['coverURL']); 
        $stmt->bindParam(':uploader_id', $book['uploaderId']); 
        $stmt->bindParam(':category_id', $book['categoryId']); 
        $stmt->bindParam(':file_url',    $book['fileURL']);
        $stmt->execute();
    }

    public static function findById($id) {
        $conn = Db::connect();
        $stmt = $conn->prepare("SELECT * FROM book WHERE id = :id;");
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch();
        return new Book($result);
    }

    public static function find($filter = []) {
        $conn = Db::connect();
        $conditions = '';
        if (count($filter) > 0) {
            foreach($filter as $key=>$val) {
                $conditions = $conditions == ''
                    ? $conditions."$key = $val"
                    : $conditions." AND $key = $val";
            }
        }
        $stmt = $conn->prepare($conditions == ''
            ? "SELECT * FROM book ORDER BY id DESC;"
            : "SELECT * FROM book WHERE $conditions ORDER BY id DESC;");
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $books = array();
        while ($result = $stmt->fetch())  {
            array_push($books, new Book($result));
        }
        return $books;
    }

    public static function search($keyword) {
        $conn = Db::connect();
        $stmt = $conn->prepare("SELECT * FROM book
                                WHERE title LIKE '%$keyword%' or author LIKE '%$keyword%'");
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        // $stmt->bindParam(':keyword', $keyword);
        $stmt->execute();
        $books = array();
        while ($result = $stmt->fetch())  {
            array_push($books, new Book($result));
        }
        return $books;
    }
}

?>