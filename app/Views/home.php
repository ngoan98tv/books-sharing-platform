<main>
    <div class="subheader">
        <h2><?= $selectedCategory ? $selectedCategory->name : 'All books'?> (<?= $totalBooks ?>)</h2>
    </div>
    <div class="books-container">
        <?php foreach($book_items as $item) echo $item; ?>
    </div>
    <?php include 'Views/components/paging.php' ?>
</main>