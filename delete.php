<?php
    session_start();
    require 'database/functions.php';
    $bookId = $_REQUEST['id'];
    $book = get_book_by_id($bookId);

    if ($book['uploader_id'] == $_SESSION['uploader']['id']) {
        delete_book($bookId);
    }

    header("Location: $_SESSION[curr_page]");
?>