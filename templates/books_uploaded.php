<?php if ($_SESSION['logged_in']) { 
        $page2 = $_REQUEST['page2'] ?? 0;
        $item_per_page2 = 10;
        $total2 = get_books_by_uploader_total($_SESSION['uploader']['id']);
        $books = get_books_by_uploader($_SESSION['uploader']['id'],$page2,$item_per_page2);
    ?>
        <hr>
        <div class="subheader">
            <h2>Books uploaded by you (<?php echo $books->num_rows." of $total2"; ?>)</h2>
        </div>
        <div class='books-container'>
        <?php 
            while ($book = $books->fetch_assoc()) {
                show_a_book($book, true);
            }
        ?>
        </div>
        <?php
        if ($total2 != 0)
            show_paging('page2', $page2, $total2/$item_per_page2,$_REQUEST['uploader'] ? '&uploader='.$_REQUEST['uploader'] : '');
        ?>
    <?php } ?>