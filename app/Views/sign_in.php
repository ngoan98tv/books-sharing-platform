<main>
    <form class='login-form' action="sign_in" method="POST">
        <fieldset>
            <legend>SIGN-IN</legend>
            <?php 
                switch ($state) {
                    case 0: 
                        echo '';
                        break;
                    case 1:
                        echo "<div class='success'>
                                <p>Log-in success!</p>
                                <p><a href='upload'>Upload book now</a> or <a href='/'>Go to homepage</a></p>
                            </div>";
                        break;
                    case 2:
                        echo "<div class='warning'>Password incorrect!</div>";
                        break;
                    case 3:
                        echo "<div class='warning'>Username isn't exist!</div>";
                        break;
                    default:
                        echo "<div class='warning'>Something went wrong! Please try again.</div>";
                } 
                if ($state != 1) {
            ?>
                <label for='username'>Username (*)</label>
                <input type="text" name="username" id="username" placeholder="Username" value="" required>
                <label for='password'>Password (*)</label>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <button class="submit-btn" type="submit">Submit</button>
                <em>
                    Don't have any account?
                    <a href="sign_up">Sign up</a>
                </em>
            <?php } ?>
        </fieldset>
    </form>
</main>