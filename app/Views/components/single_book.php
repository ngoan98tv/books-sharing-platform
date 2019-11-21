<div class='single-book'>
    <div>
        <img src='<?= $book->coverURL ?>'>
        <p class='title'><?= $book->title ?></p>
        <p class='author'><?= $book->author ?></p>
        <p class='hidden'><?= $book->year ?></p>
        <p class='hidden'><?= $book->category->name ?></p>
        <p class='hidden'>By <?= $book->uploader->name ?></p>
        <p class='hidden'><a href='<?= $book->fileURL ?>' target='_blank'>Download</a></p>
        <?php if ($book->uploader->id == $currUploader->id) { ?>
            <form class='hidden' action='delete_book' method='POST' onsubmit='return confirm(`Are you sure to delete?`);'>
                <p class='hidden' style="display: flex; justify-content: space-between">
                    <button type='submit' style='color: red'>Delete</button>
                    <a href='update?id=<?= $book->id ?>'><button type='button'>Edit</button></a>
                </p>
            </form>
        <?php } ?>
    </div>
</div>
