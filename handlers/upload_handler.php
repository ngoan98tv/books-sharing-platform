<?php

function clean($string) {
    $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
    $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
 
    return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
 }

if (isset($_POST["title"])) {
    $book = array(
        "title"=>addslashes($_POST["title"]),
        "author"=>addslashes($_POST["author"]),
        "year"=>$_POST["year"],
        "uploaderId"=>$_POST["uploaderId"],
    );

    if ($_POST["categoryId"] == 'new') {
        $book['categoryId'] = new_category($_POST['categoryName']);
    } else {
        $book['categoryId'] = $_POST["categoryId"];
    }

    if (($_FILES['image']['error'] == 0) && (substr($_FILES['image']['type'],0,5) == "image")) {
        $book['coverURL'] = "uploads/images/{$book[uploaderId]}-".clean($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'],$book['coverURL']);

        if (($_FILES['file']['error'] == 0) && ($_FILES['file']['type'] == "application/pdf")) {
            $book['fileURL'] = "uploads/files/{$book[uploaderId]}-".clean($_FILES['file']['name']);
            move_uploaded_file($_FILES['file']['tmp_name'],$book['fileURL']);

            add_book($book);

            echo "<div class='complete'>Upload completed!</div>";
        } else {
            echo "<div class='error'>Upload file error: ".$_FILES['file']['error']."</div>";
        }

    } else {
        echo "<div class='error'>Upload image error: ".$_FILES['image']['error']."</div>";
    }
    
}
?>