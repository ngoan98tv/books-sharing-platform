<?php
    session_start();
    $_SESSION['page_title'] = 'Home';
    $_SESSION['curr_page'] = $_SERVER['REQUEST_URI'];
    require "templates/header.php";
    require "templates/single_book.php";
?>
<main>
    <?php $books = isset($_REQUEST['category']) ? get_books_by_cat($_REQUEST['category']) : get_books_all(); ?>
    <div class="subheader">
        <h2>
            <?php 
                echo isset($_REQUEST['category']) ? get_category_by_id($_REQUEST['category']) : 'All books' 
            ?>
            (<?php echo $books->num_rows ?? '0'; ?>)
        </h2>
    </div>
    <div class="books-container">    
        <?php 
            
            while ($book = $books->fetch_assoc()) {
                show_a_book($book);
            }
        ?>
    </div>
    <div class="paging">
        <a href="#"><<</a>
        <a href="#"><</a>
        <?php
            for ($i=1; $i < 5; $i++)
                echo "<a href='#'>$i</a> ";
        ?>
        <a href="#">></a>
        <a href="#">>></a>
    </div>
</main>
<?php include "templates/footer.php"; ?>