<?php
    session_start();
    $_SESSION['page_title'] = 'Home';
    $_SESSION['curr_page'] = $_SERVER['REQUEST_URI'];
    require "templates/header.php";
    require "templates/paging.php";
    require "templates/single_book.php";
?>
<main>
    <?php
        $page = $_REQUEST['page'] ?? 0;
        $item_per_page = 15;
        $total = isset($_REQUEST['search'])
            ? get_search_total($_REQUEST['search'])
            : (isset($_REQUEST['category']) 
            ? get_books_by_cat_total($_REQUEST['category'])
            : get_books_all_total());
        $books = isset($_REQUEST['search'])
            ? get_search_result($_REQUEST['search'], $page, $item_per_page)
            : (isset($_REQUEST['category']) 
            ? get_books_by_cat($_REQUEST['category'], $page, $item_per_page) 
            : get_books_all($page, $item_per_page)); 
        
            
    ?>
    <div class="subheader">
        <h2>
            <?php 
                echo isset($_REQUEST['search'])
                    ? 'Search results for "'.$_REQUEST['search'].'"'
                    : (isset($_REQUEST['category']) 
                    ? get_category_by_id($_REQUEST['category']) 
                    : 'All books');
            ?>
            (<?php echo $books->num_rows." of $total"; ?>)
        </h2>
    </div>
    <div class="books-container">
        <?php 
            while ($book = $books->fetch_assoc()) {
                show_a_book($book);
            }
        ?>
    </div>
    <?php 
    if ($total > 0)
        show_paging(
            'page',
            $page, 
            $total/$item_per_page, 
            $_REQUEST['search']
                ? '&search='.$_REQUEST['search']
                : ($_REQUEST['category']
                ? '&category='.$_REQUEST['category'] 
                : ''));
    ?>
</main>
<?php include "templates/footer.php"; ?>