<?php

namespace App\Controllers;

use App\Views\View;
use App\Models\Category;
use App\Models\Book;

class PageController {

    public function home() {

        $books = Book::find();
        $book_items = array();

        foreach ($books as $book) {
            array_push(
                $book_items,
                View::create('single_book', [
                    'book' => $book,
                    'currUploader' => $_SESSION['uploader']
                ])
            );
        }
        
        echo View::render('home', [
            "book_items" => $book_items,
            "uploader" => $_SESSION['uploader'],
            'categories' => Category::find()
        ]);
    }

    public function sign_in() {
        echo View::render('sign_in', [
            'state' => $_GET['state'],
            'uploader' => $_SESSION['uploader']
        ]);
    }

    public function sign_up() {
        echo View::render('sign_up');
    }

    public function upload() {
        echo View::render('upload', [
            "uploader" => $_SESSION['uploader'],
            "categories" => Category::find()
        ]);
    }
}

?>