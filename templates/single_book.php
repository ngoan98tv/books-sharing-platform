<?php
function show_a_book($book, $own = false) {
$year = $book['year'] ? "<p class='hidden'>$book[year]</p>" : '';
echo "<div class='single-book'>".
        "<div>".
            "<img src='".(file_exists($book['cover_url']) ? $book['cover_url'] : 'asset/image/placeholder.jpg')."'>".
            "<p class='title'>$book[title]</p>".
            "<p class='author'>$book[author]</p>".
            $year.
            "<p class='hidden'>$book[category]</p>".
            "<p class='hidden'>by $book[uploader]</p>".
            "<p class='hidden'><a href='$book[file_url]' target='_blank'>Download</a></p>".
            ($own ? "<form action='delete.php?id=$book[id]' method='POST' onsubmit='return confirm(`Do you sure to delete?`);'><p class='hidden'><button type='submit' style='color: red'>Delete</button><a href='update.php?id=$book[id]'><button type='button'>Edit</button></a></p></form>" : '').
        "</div>".
    "</div>";
}
?>