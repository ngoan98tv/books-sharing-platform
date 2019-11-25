<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Books Sharing Platform</title>
    <link rel="stylesheet" href="assets/style/index.css">
    <link rel="shortcut icon" type="image/png" href="asset/icon/book-flat.png">
</head>
<body style="background-image: url('assets/image/white_grid_paper-background_pattern.jpg');">
<header>
    <h1>Books Sharing Platform</h1>
    <nav>
        <a href="/">All books</a>
        <?php
            foreach($categories as $category) {
                echo "<a href='?category=$category->id'>$category->name</a>";
            }
        ?>
    </nav>
    <div>
        <form id='searcher'>
            <input type="text" name="searchValue" placeholder="Search book's title or author...">
            <button type="submit">Search</button>
        </form>
    </div>
</header>