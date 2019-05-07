<?php
    session_start();
    $_SESSION['page_title'] = 'Upload';
    $_SESSION['curr_page'] = $_SERVER['REQUEST_URI'];
    require "templates/header.php";
    require "templates/single_book.php";
    require "templates/paging.php";
?>
<main>
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
    <div class='upload'>
        <?php if ($_SESSION['logged_in']) { ?>
            
            <form action='upload.php' method='POST' enctype="multipart/form-data">
            <?php require 'handlers/upload_handler.php'; ?>
                <fieldset>
                    <legend>UPLOAD A NEW BOOK</legend>
                    <label for='title'>Title (*)</label>
                    <input type="text" name="title" id="title" placeholder="Title..." required/>
                    <label for='author'>Author (*)</label>
                    <input type="text" name="author" id="author" placeholder="Author..." required/>
                    <label for='year'>Publishing Year</label>
                    <input type="number" name="year" id="year" placeholder="Publishing year..."/>
                    <label for='categoryId'>Category (*)</label>
                    <select id="categoryId" name="categoryId" placeholder="Category..." required>
                        <?php
                            $categories = get_categories();
                            while ($category = $categories->fetch_assoc()) {
                                echo "<option value='$category[id]'>$category[name]</option>";
                            }
                        ?>
                        <option value="new">New category...</option>
                    </select>
                    <input type="text" id="categoryName" name="categoryName" placeholder="New category..." style="display: none">
                    <label for='image'>Cover image (*)</label>
                    <input type="file" required id='image' name="image" accept="image/*"/>
                    <label for='file'>File (PDF only) (*)</label>
                    <input type="file" required id='file' name="file" accept="application/pdf"/>
                    <input type='hidden' name='uploaderId' value="<?php echo $_SESSION['uploader']['id']; ?>"/>
                    <button type="submit" class="submit-btn">Submit</button>
                </fieldset>
            </form>
        <?php } else { ?>
            <div class="warning">
                <p>You have to login to upload new books!</p>
                <a href="login.php?location=upload.php">Login now</a> or <a href="sign-up.php?location=upload.php">Sign up</a>
            </div>
        <?php } ?>
    </div>
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
</main>
<?php require "templates/footer.php"; ?>