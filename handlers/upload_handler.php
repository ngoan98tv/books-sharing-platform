<?php

if (isset($_POST["title"])) {
    $book = array(
        "title"=>$_POST["title"],
        "author"=>$_POST["author"],
        "year"=>$_POST["year"],
        "uploaderId"=>$_POST["uploaderId"],
        "fileURL"=>"",
    );

    if ($_POST["categoryId"] == 'new') {
        $book['categoryId'] = new_category($_POST['categoryName']);
    } else {
        $book['categoryId'] = $_POST["categoryId"];
    }

    if (($_FILES['image']['error'] == 0) && (substr($_FILES['image']['type'],0,5) == "image")) {
        $book['coverURL'] = "uploads/images/{$book[uploaderId]}-".$_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'],$book['coverURL']);
    } else {
        echo "<div class='error'>Upload image error: ".$_FILES['image']['error']."</div>";
    }

    add_book($book);

    echo "<div class='complete'>Upload completed!</div>";
}
?>