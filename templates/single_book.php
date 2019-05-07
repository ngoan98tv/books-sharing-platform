<?php
function show_a_book($book, $del = false) {
$year = $book['year'] ? "<p class='hidden'>$book[year]</p>" : '';
echo "<div class='single-book'>".
        "<div>".
            "<img src='$book[cover_url]'>".
            "<p class='title'>$book[title]</p>".
            "<p class='author'>$book[author]</p>".
            $year.
            "<p class='hidden'>$book[category]</p>".
            "<p class='hidden'>by $book[uploader]</p>".
            "<p class='hidden'><a href='$book[file_url]' target='_blank'>Download</a></p>".
            ($del ? "<form action='delete.php?id=$book[id]' method='POST' onsubmit='return confirm(`Do you sure to delete?`);'><p class='hidden'><button type='submit' style='color: red'>Delete</button></p></form>" : '').
        "</div>".
    "</div>";
}
?>