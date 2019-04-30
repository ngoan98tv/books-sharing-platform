<?php
function show_a_book($book) {
echo <<<_SINGLE_BOOK_TEMPLATE
    <div class='single-book'>
        <div>
        <img src='$book[cover_url]'>
        <p class='title'>$book[title]</p>
        <p class='author'>$book[author]</p>
        <p class='year'>$book[year]</p>
        <p class='hidden'>$book[name]</p>
        <button class='hidden'>Download</button>
        </div>
    </div>
_SINGLE_BOOK_TEMPLATE;
}
?>