<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title ?> - Books Sharing Platform</title>
    <link rel="stylesheet" href="assets/style/index.css">
    <link rel="shortcut icon" type="image/png" href="asset/icon/book-flat.png">
</head>
<body style="background-image: url('assets/image/white_grid_paper-background_pattern.jpg');">
<header>
    <h1>Books Sharing Platform</h1>
    <div>
        <form action="index.php" method="GET">
            <input type="text" name="search" placeholder="Search book's title or author...">
            <button type="submit">Search</button>
        </form>
    </div>
</header>