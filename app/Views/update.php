<main>
    <div class='upload'>
        <?php if ($uploader && $uploader->id == $book->uploader->id) { ?>
            <form action='update?id=<?= $book->id ?>' method='POST' enctype="multipart/form-data">
                <fieldset>
                    <legend class="text-center">UPDATE YOUR BOOK</legend>
                    <?= $success ? "<div class='alert alert-success'>Cập nhật thành công.</div>" : '' ?>
                    <label for='title'>Title (*)</label>
                    <input class="form-control" type="text" name="title" id="title" value="<?= $book->title ?>" placeholder="Title..." required/>
                    <label for='author'>Author (*)</label>
                    <input class="form-control" type="text" name="author" id="author" value="<?= $book->author ?>" placeholder="Author..." required/>
                    <label for='year'>Publishing Year</label>
                    <input class="form-control" type="number" name="year" id="year" value="<?= $book->year ?>" placeholder="Publishing year..."/>
                    <label for='categoryId'>Category (*)</label>
                    <select class="form-control" id="categoryId" name="categoryId" placeholder="Category..." required>
                        <option disabled>Choose a category or create new</option>
                        <?php
                            foreach($categories as $category) {
                                echo "<option value='$category->id' ".($book->category->id == $category->id ? 'selected' : '').">$category->name</option>";
                            }
                        ?>
                        <option value="new">New category...</option>
                    </select>
                    <input class="form-control" type="text" id="categoryName" name="categoryName" placeholder="Enter category name..." style="display: none">
                    <div class='flex-contain'>
                        <div>
                            <label for='inputImage'>Change cover image (*)</label>
                            <input type="file" id='inputImage' name="newImage" accept="image/*"/>

                            <label for='inputFile'>Upload new file (PDF only) (*)</label>
                            <input type="file" id='inputFile' name="file" accept="application/pdf"/>
                        </div>
                        <label for='inputImage'>
                            <img id='previewImg' src='<?= file_exists($book->coverURL) ? $book->coverURL : 'assets/image/placeholder.jpg'?>' style="width: 90px; height: 120px">
                        </label>
                    </div>
                    <input class="form-control" type='hidden' name='uploaderId' value="<?= $uploader->id ?>"/>
                    <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                </fieldset>
            </form>
        <?php } else { ?>
            <div class="warning">
                <p>You have to login to update your books!</p>
                <a href="sign_in">Login now</a> or <a href="sign_up">Sign up</a>
            </div>
        <?php } ?>
    </div>
</main>