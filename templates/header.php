<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $_SESSION['page_title']; ?> - Books Sharing Platform</title>
    <link rel="stylesheet" href="./style/index.css">
    <link rel="shortcut icon" type="image/png" href="./asset/icon/book-flat.png">
</head>
<body>
<header>
    <h1>Books Sharing Platform</h1>
    <nav>
        <a href="index.php">All books</a>
        <?php
            require "database/functions.php";
            $categories = get_categories();
            while ($category = $categories->fetch_assoc()) {
                echo "<a href='index.php?category=$category[id]'>$category[name]</a>";
            }
        ?>
    </nav>
    <div>
        <form action="#" method="GET">
            <input type="text" name="search" placeholder="Search book's title or author...">
            <button type="submit">Search</button>
        </form>
    </div>
</header>