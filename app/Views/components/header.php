<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Books Sharing Platform</title>
    <link rel="shortcut icon" type="image/png" href="asset/icon/book-flat.png">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="assets/style/index.css">
</head>
<body style="background-image: url('assets/image/white_grid_paper-background_pattern.jpg');">
<header>
    <h1>Books Sharing Platform</h1>
    <nav>
        <a href="/">All books</a>
        <?php
            foreach($categories as $category) {
                echo "<a href='/?category=$category->id'>$category->name</a>";
            }
        ?>
    </nav>
    <div style="max-width: 300px; margin: auto">
        <form id='searcher' action="/" class="input-group">
            <input type="text" class="form-control" name="search" placeholder="Search book's title or author..." required>
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>
    </div>
    <div id='search-result'></div>
</header>