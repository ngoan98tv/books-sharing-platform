<div class='single-book'>
    <div>
        <img src='<?= $coverURL ?>'>
        <p class='title'><?= $title ?></p>
        <p class='author'><?= $author ?></p>
        <p class='year'><?= $year ?></p>
        <p class='hidden'><?= $category ?></p>
        <p class='hidden'><a href='<?= $fileURL ?>' target='_blank'>Download</a></p>
        <form action='delete_book' method='POST' onsubmit='return confirm(`Are you sure to delete?`);'>
            <p class='hidden' style="display: flex; justify-content: space-evenly">
                <button type='submit' style='color: red'>Delete</button>
                <a href='update?id=<?= $id ?>'><button type='button'>Edit</button></a>
            </p>
        </form>
    </div>
</div>
