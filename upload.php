<?php
    session_start();
    $_SESSION['page_title'] = 'Upload';
    $_SESSION['curr_page'] = $_SERVER['REQUEST_URI'];
    require "templates/header.php";
    require "templates/single_book.php"
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
    <?php if ($_REQUEST['uploader']) { 
        $uploader = get_uploader($_REQUEST['uploader']);
        $books = get_books_by_uploader($uploader['id']);
    ?>
        <hr>
        <div class="subheader">
            <h2>
                Books uploaded by 
                <span><?php echo $uploader['name']; ?></span>
                (<?php echo $books->num_rows ?? 0; ?>)
            </h2>
        </div>
        <div class='books-container'>
        <?php 
            
            while ($book = $books->fetch_assoc()) {
                show_a_book($book);
            }
        ?>
        </div>
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
                    </select>
                    <label for='image'>Cover image (*)</label>
                    <input type="file" required id='image' name="image" accept="image/*"/>
                    <input type='hidden' name='uploaderId' value="<?php echo $_SESSION['uploader']['id']; ?>"/>
                    <button type="submit">Submit</button>
                </fieldset>
            </form>
        <?php } else { ?>
            <div class="warning">
                <p>You have to login to upload new books!</p>
                <a href="login.php?location=upload.php">Login now</a> or <a href="sign-up.php?location=upload.php">Sign up</a>
            </div>
        <?php } ?>
    </div>
    <?php if ($_SESSION['logged_in']) { $books = get_books_by_uploader($_SESSION['uploader']['id']);  ?>
        <hr>
        <div class="subheader">
            <h2>Books uploaded by you (<?php echo $books->num_rows ?? '0'; ?>)</h2>
        </div>
        <div class='books-container'>
        <?php 
            
            while ($book = $books->fetch_assoc()) {
                show_a_book($book);
            }
        ?>
        </div>
    <?php } ?>
</main>
<?php require "templates/footer.php"; ?>