<?php

if (isset($_POST["title"]) && ($_POST["title"] != $book['title'])) {
    update_book_title($book['id'], addslashes($_POST["title"]));
    echo "<div class='complete'>Update title completed!</div>";
}

if (isset($_POST["author"]) && ($_POST["author"] != $book['author'])) {
    update_book_author($book['id'], addslashes($_POST["author"]));
    echo "<div class='complete'>Update author completed!</div>";
}

if (isset($_POST["year"]) && ($_POST["year"] != $book['year'])) {
    update_book_year($book['id'], $_POST["year"]);
    echo "<div class='complete'>Update year completed!</div>";
}

if (isset($_POST["categoryId"]) && ($_POST["categoryId"] != $book['category_id'])) {
    if ($_POST["categoryId"] == 'new') {
        update_book_category($book['id'], new_category($_POST['categoryName']));
    } else {
        update_book_category($book['id'], $_POST["categoryId"]);
    }
    echo "<div class='complete'>Update category completed!</div>";
}

if (isset($_FILES['newImage']) && ($_FILES['newImage']['error'] != 4)) {
    if (($_FILES['newImage']['error'] == 0) && (substr($_FILES['newImage']['type'],0,5) == "image")) {
        $coverURL = "uploads/images/{$book[uploader_id]}-".clean($_FILES['newImage']['name']);
        move_uploaded_file($_FILES['newImage']['tmp_name'],$coverURL);
        update_book_cover($book['id'], $coverURL);
        echo "<div class='complete'>Update image completed!</div>";
    } else {
        echo "<div class='error'>Update image error: ".$_FILES['newImage']['error']."</div>";
    }
}

if (isset($_FILES['file']) && ($_FILES['file']['error'] != 4)) {
    if (($_FILES['file']['error'] == 0) && ($_FILES['file']['type'] == "application/pdf")) {
        $fileURL = "uploads/files/{$book[uploader_id]}-".clean($_FILES['file']['name']);
        move_uploaded_file($_FILES['file']['tmp_name'],$fileURL);
        update_book_file($book['id'], $fileURL);
        echo "<div class='complete'>Update file completed!</div>";
    } else {
        echo "<div class='error'>Update file error: ".$_FILES['file']['error']."</div>";
    }
}

$book = get_book_by_id($_REQUEST['id']);

?>