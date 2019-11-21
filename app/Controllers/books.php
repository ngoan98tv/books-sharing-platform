<?php

namespace controllers;
use Models;

class Books {

    public function update() {
        
    }

    public function create() {
        $book = [
            "title"      => addslashes($_POST["title"]),
            "author"     => addslashes($_POST["author"]),
            "year"       => $_POST["year"],
            "uploaderId" => $_POST["uploaderId"],
        ];
    
        if ($_POST["categoryId"] == 'new') {
            $book['categoryId'] = Models\Category::create($_POST['categoryName']);
        } else {
            $book['categoryId'] = $_POST["categoryId"];
        }
    
        if (($_FILES['image']['error'] == 0) && (substr($_FILES['image']['type'],0,5) == "image")) {
            $book['coverURL'] = "uploads/images/{$book[uploaderId]}-".clean($_FILES['image']['name']);
            move_uploaded_file($_FILES['image']['tmp_name'], $book['coverURL']);
    
            if (($_FILES['file']['error'] == 0) && ($_FILES['file']['type'] == "application/pdf")) {
                $book['fileURL'] = "uploads/files/{$book[uploaderId]}-".clean($_FILES['file']['name']);
                move_uploaded_file($_FILES['file']['tmp_name'],$book['fileURL']);
    
                Models\Book::create($book);
    
                header('Location: upload?state=1');
            } else {
                header('Location: upload?state=2');
            }
    
        } else {
            header('Location: upload?state=3');
        }
    }

    public function delete() {
        
    }
}

function clean($string) {
    $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
    $string = preg_replace('/[^A-Za-z0-9\-\.]/', '', $string); // Removes special chars.
 
    return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
}

?>