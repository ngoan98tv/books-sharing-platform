<?php
if (isset($_POST["title"])) {
    $book = array(
        "title"=>$_POST["title"],
        "author"=>$_POST["author"],
        "year"=>$_POST["year"],
        "categoryId"=>$_POST["categoryId"],
        "uploaderId"=>$_POST["uploaderId"],
        "coverURL"=>"",
        "fileURL"=>"",
    );

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