<div class='top-uploaders'>
<h2>Top Uploaders</h2>
<div>
    <?php 
        $uploaders = get_top_uploaders();
        while ($uploader = $uploaders->fetch_assoc()) {
            echo "<a href='upload.php?uploader=$uploader[username]'>$uploader[name] <span>$uploader[uploaded]</span></a>";
        }
    ?>
</div>
</div>
<?php if (isset($_REQUEST['uploader'])) { 
$page1 = $_REQUEST['page1'] ?? 0;
$item_per_page1 = 5;
$uploader = get_uploader($_REQUEST['uploader']);
$total1 = get_books_by_uploader_total($uploader['id']);
$books = get_books_by_uploader($uploader['id'],$page1,$item_per_page1);
?>
<hr>
<div class="subheader">
    <h2>
        Books uploaded by 
        <span><?php echo $uploader['name']; ?></span>
        (<?php echo $books->num_rows." of $total1"; ?>)
    </h2>
</div>
<div class='books-container'>
<?php 
    
    while ($book = $books->fetch_assoc()) {
        show_a_book($book);
    }
?>
</div>
<?php 
    if ($total1 != 0)
        show_paging('page1', $page1, $total1/$item_per_page1, $_REQUEST['uploader'] ? '&uploader='.$_REQUEST['uploader'] : '');
?>
<?php } ?>
<hr>
