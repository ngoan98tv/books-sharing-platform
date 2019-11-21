<?php

namespace Models;

use Db;
use PDO;

class Book {
    public $id;
    public $title;
    public $author; 
    public $year; 
    public $coverURL; 
    public $uploaderId; 
    public $categoryId; 
    public $fileURL;

    function __construct($book) {
        $this->id           = $book['id'];
        $this->title        = $book['title'];
        $this->author       = $book['author']; 
        $this->year         = $book['year']; 
        $this->coverURL     = $book['cover_url']; 
        $this->uploaderId   = $book['uploader_id']; 
        $this->categoryId   = $book['category_id']; 
        $this->fileURL      = $book['file_url'];
    }

    function save() {
        $conn = Db\connect();
        $stmt = $conn->prepare("UPDATE
            book   (title,  author,  year,  cover_url,  uploader_id,  category_id,  file_url)
            VALUES (:title, :author, :year, :cover_url, :uploader_id, :category_id, :file_url)
            WHERE id = :id;"
        );
        $stmt->bindParam(':id',         $this->id);
        $stmt->bindParam(':title',      $this->title);
        $stmt->bindParam(':author',     $this->author); 
        $stmt->bindParam(':year',       $this->year); 
        $stmt->bindParam(':cover_url',   $this->coverURL); 
        $stmt->bindParam(':uploader_id', $this->uploaderId); 
        $stmt->bindParam(':category_id', $this->categoryId); 
        $stmt->bindParam(':file_url',    $this->fileURL);
        $stmt->execute();
    }

    function delete() {

    }

    public static function create($book) {
        $conn = Db\connect();
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
        $conn = Db\connect();
        $stmt = $conn->prepare("SELECT * FROM book WHERE id = ':id';");
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch();
        return new Book($result);
    }

    public static function find() {
        $conn = Db\connect();
        $stmt = $conn->prepare("SELECT * FROM book;");
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $books = array();
        while ($result = $stmt->fetch())  {
            array_push($books, new Book($result));
        }
        return $books;
    }
}

?>