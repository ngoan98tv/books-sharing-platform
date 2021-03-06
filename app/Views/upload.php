<main>
    <div class='top-uploaders'>
        <h2>Top Uploaders</h2>
        <div> 
            <?php 
                foreach ($top_uploaders as $u) {
                    echo "<a href='upload?uploader=$u->id'>
                        $u->name <span>$u->uploaded</span>
                    </a>";
                }
            ?>
        </div>
    </div>
    <hr>
    <div class='upload'>
        <?php if ($uploader) { ?>
            <form action='upload' method='POST' enctype="multipart/form-data">
                <fieldset>
                    <legend class="text-center">UPLOAD A NEW BOOK</legend>
                    <?php 
                        switch ($error) {
                            case '-1':
                                echo '';
                                break;
                            case 0:
                                echo "<div class='alert alert-success'>Upload completed!</div>";
                                break;
                            case 1:
                                echo "<div class='alert alert-danger'>Error while upload file</div>";
                                break;
                            case 2:
                                echo "<div class='alert alert-danger'>Error while upload image</div>";
                                break;
                            default:
                                echo "<div class='alert alert-danger'>$error</div>";
                                break;
                        }
                    ?>
                    <label for='title'>Title (*)</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="Title..." required/>
                    <label for='author'>Author (*)</label>
                    <input type="text" class="form-control" name="author" id="author" placeholder="Author..." required/>
                    <label for='year'>Publishing Year</label>
                    <input type="number" class="form-control" name="year" id="year" placeholder="Publishing year..."/>
                    <label for='categoryId'>Category (*)</label>
                    <select id="categoryId" class="form-control" name="categoryId" placeholder="Category..." required>
                        <option disabled selected>Choose a category or create new</option>
                        <?php
                            foreach ($categories as $category) {
                                echo "<option value='$category->id'>$category->name</option>";
                            }
                        ?>
                        <option value="new">New category...</option>
                    </select>
                    <input type="text" class="form-control" class="form-control" id="categoryName" name="categoryName" placeholder="Enter category name..." style="display: none">
                    <div class='flex-contain'>
                        <div>
                            <label for='inputImage'>Cover image (*)</label>
                            <input type="file" required id='inputImage' name="image" accept="image/*"/>

                            <label for='inputFile'>File (PDF only) (*)</label>
                            <input type="file" required id='inputFile' name="file" accept="application/pdf"/>
                        </div>
                        <label for='inputImage'>
                            <img id='previewImg' src='assets/image/placeholder.jpg' style="width: 90px; height: 120px">
                        </label>
                    </div>
                    <input type='hidden' name='uploaderId' value="<?= $uploader->id ?>"/>
                    <button type="submit" class="submit-btn btn btn-primary">Submit</button>
                </fieldset>
            </form>
            <hr>
            <div class="subheader">
                <h3>Your books (<?= $totalBooks ?>)</h3>
            </div>
            <div class="books-container">
                <?php foreach($book_items as $item) echo $item; ?>
            </div>
            <?php if ($book_items) include 'Views/components/paging.php' ?>
        <?php } else { ?>
            <div class="warning">
                <p>You have to login to upload new books!</p>
                <a href="sign_in?callback=upload">Login now</a> or <a href="sign_up?callback=upload">Sign up</a>
            </div>
        <?php } ?>
    </div>
</main>
