<main>
    <form class='login-form' action="sign_in" method="POST">
        <fieldset>
            <legend class="text-center">SIGN-IN</legend>
            <?php 
                switch ($state) {
                    case 'db-error': 
                        echo "<div class='alert alert-danger'>Something went wrong! Please try again.</div>";
                        break;
                    case 'success':
                        echo "<div class='alert alert-success text-center'>
                                <p>Log-in success!</p>
                                <p><a href='upload'>Upload book now</a><br>
                                <a href='/'>Go to homepage</a></p>
                            </div>";
                        break;
                    case 'wrong-passwd':
                        echo "<div class='alert alert-danger'>Password incorrect!</div>";
                        break;
                    case 'wrong-username':
                        echo "<div class='alert alert-danger'>Username isn't exist!</div>";
                        break;
                    default:
                        echo '';
                } 
                if ($state != 'success') {
            ?>
                <label for='username'>Username (*)</label>
                <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="" required>
                <label for='password'>Password (*)</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                <button class="btn btn-primary submit-btn" type="submit">Submit</button>
                <em>
                    Don't have any account?
                    <a href="sign_up">Sign up</a>
                </em>
            <?php } ?>
        </fieldset>
    </form>
</main>