<?php

namespace App\Controllers;

use App\Models\Book;
use App\Models\Category;

class BookController {

    public function update() {
        
        $book = Book::findById($_GET['id']);
        
        $book->title = (isset($_POST["title"]) && ($_POST["title"] != $book->title))
            ? addslashes($_POST["title"])
            : $book->title;
        
        $book->author = (isset($_POST["author"]) && ($_POST["author"] != $book->author))
            ? addslashes($_POST["author"])
            : $book->author;
        
        $book->year = (isset($_POST["year"]) && ($_POST["year"] != $book->year))
            ? $_POST["year"]
            : $book->year;
        
        if (isset($_POST["categoryId"]) && ($_POST["categoryId"] != $book->category->id)) {
            if ($_POST["categoryId"] == 'new') {
                $book->categoryId = Category::create($_POST['categoryName']);
            } else {
                $book->categoryId = $_POST["categoryId"];
            }
        } else {
            $book->categoryId = $book->category->id;
        }
        
        if (isset($_FILES['newImage']) && ($_FILES['newImage']['error'] != 4)) {
            if (($_FILES['newImage']['error'] == 0) && (substr($_FILES['newImage']['type'],0,5) == "image")) {
                $coverURL = "uploads/images/{$book->uploader->id}-".clean($_FILES['newImage']['name']);
                move_uploaded_file($_FILES['newImage']['tmp_name'],$coverURL);
                $book->coverURL = $coverURL;
            } 
        }
        
        if (isset($_FILES['file']) && ($_FILES['file']['error'] != 4)) {
            if (($_FILES['file']['error'] == 0) && ($_FILES['file']['type'] == "application/pdf")) {
                $fileURL = "uploads/files/{$book->uploader->id}-".clean($_FILES['file']['name']);
                move_uploaded_file($_FILES['file']['tmp_name'],$fileURL);
                $book->fileURL = $fileURL;
                echo "<div class='complete'>Update file completed!</div>";
            } 
        }
         
        $book->save();
        header('Location: update?id='.$book->id);
    }

    public function create() {
        $book = [
            "title"      => addslashes($_POST["title"]),
            "author"     => addslashes($_POST["author"]),
            "year"       => $_POST["year"],
            "uploaderId" => $_POST["uploaderId"],
        ];
    
        if ($_POST["categoryId"] == 'new') {
            $book['categoryId'] = Category::create($_POST['categoryName']);
        } else {
            $book['categoryId'] = $_POST["categoryId"];
        }
    
        if (($_FILES['image']['error'] == 0) && (substr($_FILES['image']['type'],0,5) == "image")) {
            $book['coverURL'] = "uploads/images/{$book[uploaderId]}-".clean($_FILES['image']['name']);
            move_uploaded_file($_FILES['image']['tmp_name'], $book['coverURL']);
    
            if (($_FILES['file']['error'] == 0) && ($_FILES['file']['type'] == "application/pdf")) {
                $book['fileURL'] = "uploads/files/{$book[uploaderId]}-".clean($_FILES['file']['name']);
                move_uploaded_file($_FILES['file']['tmp_name'],$book['fileURL']);
    
                Book::create($book);
    
                header('Location: upload?state=1');
            } else {
                header('Location: upload?state=2');
            }
    
        } else {
            header('Location: upload?state=3');
        }
    }

    public function delete() {
        $book = Book::findById($_POST['id']);
        $book->delete();
        header('Location: /');
    }

    public function search() {
        $keyword = $_GET['q'];
        $books = Book::search($keyword);
        echo json_encode($books);
    }
}

function clean($string) {
    $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
    $string = preg_replace('/[^A-Za-z0-9\-\.]/', '', $string); // Removes special chars.
 
    return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
}

?>