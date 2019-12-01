<?php

namespace App\Controllers;

use App\Views\View;
use App\Models\Category;
use App\Models\Book;
use App\Models\Uploader;

class PageController {

    public function home() {

        if (isset($_GET['category'])) {
            $books = Book::find([
                'category_id' => $_GET['category']
            ], $_GET['page']);
            $totalBooks = Book::count([
                'category_id' => $_GET['category']
            ]);
        } else if (isset($_GET['search'])) {
            $books = Book::search($_GET['search'], $_GET['page']);
            $totalBooks = Book::countSearchResult($_GET['search']);
        } else {
            $books = Book::find([], $_GET['page']);
            $totalBooks = Book::count();
        }

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
            'categories' => Category::find(),
            'selectedCategory' => isset($_GET['category']) ? Category::findById($_GET['category']) : null,
            'totalBooks' => $totalBooks,
            'search' => $_GET['search'] ?? null,
            'name' => 'page',
            'curr' => $_GET['page'] ?? 0, 
            'total' => $totalBooks/10,
            'trailing' => $_GET
        ]);
    }

    public function sign_in() {
        echo View::render('sign_in', [
            'state' => $_GET['state'],
            'uploader' => $_SESSION['uploader'],
            'categories' => Category::find()
        ]);
    }

    public function sign_up() {
        echo View::render('sign_up', [
            'categories' => Category::find(),
            'error' => $_GET['error'] ?? '-1'
        ]);
    }

    public function upload() {

        if (isset($_SESSION['uploader'])) {
            $books = Book::find([
                'uploader_id' => $_SESSION['uploader']->id
            ], $_GET['page'], 5);
            $totalBooks = Book::count([
                'uploader_id' => $_SESSION['uploader']->id
            ]);

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
        }

        echo View::render('upload', [
            "uploader" => $_SESSION['uploader'],
            "categories" => Category::find(),
            "error" => $_GET['error'] ?? '-1',
            "top_uploaders" => Uploader::get_top_uploaders(),
            "book_items" => $book_items,
            'totalBooks' => $totalBooks ?? 0,
            'search' => $_GET['search'] ?? null,
            'name' => 'page',
            'curr' => $_GET['page'] ?? 0, 
            'total' => $totalBooks/5,
            'trailing' => $_GET
        ]);
    }

    public function sign_out() {
        $_SESSION['uploader'] = null;
        header('Location: /');
    }

    public function update() {
        echo View::render('update', [
            "uploader" => $_SESSION['uploader'],
            "book" => Book::findById($_GET['id']),
            "categories" => Category::find()
        ]);
    }
}

?>