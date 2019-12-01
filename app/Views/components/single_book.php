<div class='single-book'>
    <div class='inner'>
    <div>
        <img src='<?= file_exists($book->coverURL) ? $book->coverURL : 'assets/image/placeholder.jpg' ?>'>
        <p class='title'><?= $book->title ?></p>
        <p class='author'><?= $book->author ?></p>
        <p class='hidden'><?= $book->year ?></p>
        <p class='hidden'><?= $book->category->name ?></p>
        <p class='hidden'>By <?= $book->uploader->name ?></p>
        <p class='hidden'><a class="btn btn-info btn-sm btn-block" href='<?= $book->fileURL ?>' target='_blank'>Download</a></p>
        <?php if ($book->uploader->id == $currUploader->id) { ?>
            <form class='hidden' action='delete' method="POST" onsubmit='return confirm(`Are you sure to delete?`);'>
                <p class='hidden' style="display: flex; justify-content: space-between">
                    <button type='submit' name='id' value='<?= $book->id ?>' class="btn btn-danger btn-sm">Delete</button>
                    <a href='update?id=<?= $book->id ?>'><button type='button' class="btn btn-secondary btn-sm">Edit</button></a>
                </p>
            </form>
        <?php } ?>
    </div>
    </div>
</div>
