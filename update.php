<?php
    session_start();
    $_SESSION['page_title'] = 'Upload';
    $_SESSION['curr_page'] = $_SERVER['REQUEST_URI'];
    require "templates/header.php";
    require "templates/single_book.php";
    require "templates/paging.php";
    $book = get_book_by_id($_REQUEST['id']);
?>
<main>
    <?php require "templates/top_uploaders.php" ?>
    <div class='upload'>
        <?php if ($_SESSION['logged_in']) { ?>
            
            <form action='upload.php' method='POST' enctype="multipart/form-data">
            <?php //require 'handlers/update_handler.php'; ?>
                <fieldset>
                    <legend>UPDATE YOUR BOOK</legend>
                    <label for='title'>Title (*)</label>
                    <input type="text" name="title" id="title" value="<?php echo $book['title'] ?>" placeholder="Title..." required/>
                    <label for='author'>Author (*)</label>
                    <input type="text" name="author" id="author" value="<?php echo $book['author'] ?>" placeholder="Author..." required/>
                    <label for='year'>Publishing Year</label>
                    <input type="number" name="year" id="year" value="<?php echo $book['year'] ?>" placeholder="Publishing year..."/>
                    <label for='categoryId'>Category (*)</label>
                    <select id="categoryId" name="categoryId" placeholder="Category..." required>
                        <option disabled>Choose a category or create new</option>
                        <?php
                            $categories = get_categories();
                            while ($category = $categories->fetch_assoc()) {
                                echo "<option value='$category[id]' ".($book['category_id'] == $category[id] ? 'selected' : '').">$category[name]</option>";
                            }
                        ?>
                        <option value="new">New category...</option>
                    </select>
                    <input type="text" id="categoryName" name="categoryName" placeholder="New category..." style="display: none">
                    <div class='flex-contain'>
                        <div>
                            <label for='inputImage'>Change cover image (*)</label>
                            <input type="file" id='inputImage' name="image" accept="image/*"/>

                            <label for='inputFile'>Upload new file (PDF only) (*)</label>
                            <input type="file" id='inputFile' name="file" accept="application/pdf"/>
                        </div>
                        <label for='inputImage'>
                            <img id='previewImg' src='<?php echo $book['cover_url'] ?>' style="width: 90px; height: 120px">
                        </label>
                    </div>
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
    <?php require "templates/books_uploaded.php" ?>
</main>
<?php require "templates/footer.php"; ?>