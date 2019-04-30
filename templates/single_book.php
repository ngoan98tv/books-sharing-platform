<?php
function show_a_book($book) {
echo <<<_SINGLE_BOOK_TEMPLATE
    <div class='single-book'>
        <img src='$book[cover_url]'>
        <p class='title'>$book[title]</p>
        <p class='author'>$book[author]</p>
        <p class='year'>$book[year]</p>
    </div>
_SINGLE_BOOK_TEMPLATE;
}
?>