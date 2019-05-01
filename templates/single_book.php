<?php
function show_a_book($book) {
$year = $book['year'] ? "<p class='hidden'>$book[year]</p>" : '';
echo "<div class='single-book'>".
        "<div>".
            "<img src='$book[cover_url]'>".
            "<p class='title'>$book[title]</p>".
            "<p class='author'>$book[author]</p>".
            $year.
            "<p class='hidden'>$book[category]</p>".
            "<p class='hidden'>by $book[uploader]</p>".
            "<p class='hidden'><a href='$book[file_url]'>Download</a></p>".
        "</div>".
    "</div>";
}
?>