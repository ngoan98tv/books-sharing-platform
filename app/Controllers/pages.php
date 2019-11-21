<?php

namespace controllers;

use Views;
use Models\Book;
use Models\Category;

class Pages {

    public function home() {

        $books = Book::find();
        $book_items = array();

        foreach ($books as $book) {
            array_push(
                $book_items,
                Views\create('single_book', (array) $book)
            );
        }
        
        echo Views\render('home', [
            "book_items" => $book_items,
            "uploader" => $_SESSION['uploader']
        ]);
    }

    public function sign_in() {
        echo Views\render('sign_in', [
            'state' => $_GET['state'],
            'uploader' => $_SESSION['uploader']
        ]);
    }

    public function sign_up() {
        echo Views\render('sign_up');
    }

    public function upload() {
        echo Views\render('upload', [
            "uploader" => $_SESSION['uploader'],
            "categories" => Category::find()
        ]);
    }
}

?>