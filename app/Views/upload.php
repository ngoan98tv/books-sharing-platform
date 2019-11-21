<main>
    <div class='upload'>
        <?php if ($uploader) { ?>
            <form action='upload' method='POST' enctype="multipart/form-data">
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
                        <option disabled selected>Choose a category or create new</option>
                        <?php
                            foreach ($categories as $category) {
                                echo "<option value='$category->id'>$category->name</option>";
                            }
                        ?>
                        <option value="new">New category...</option>
                    </select>
                    <input type="text" id="categoryName" name="categoryName" placeholder="Enter category name..." style="display: none">
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
                    <button type="submit" class="submit-btn">Submit</button>
                </fieldset>
            </form>
        <?php } else { ?>
            <div class="warning">
                <p>You have to login to upload new books!</p>
                <a href="sign_in?callback=upload">Login now</a> or <a href="sign_up?callback=upload">Sign up</a>
            </div>
        <?php } ?>
    </div>
</main>
