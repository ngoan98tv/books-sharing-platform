<main>
    <form class='login-form' action="sign_up" method="POST" style="max-width: 400px">
        <fieldset>
        <legend class="text-center">SIGN-UP</legend>
        <?php
            switch ($error) {
                case '-1':
                    echo '';
                    break;
                case '0':
                    echo "<div class='alert alert-success'>Sign up success. <a href='sign_in'>Login now!</a></div>";
                    break;
                case '1':
                    echo "<div class='alert alert-danger'>Confirm password not match!</div>";
                    break;
                case '2':
                    echo "<div class='alert alert-danger'>Username already taken, please try another.</div>";
                    break;
                case '3':
                    echo "<div class='alert alert-danger'>Email already exist, <a href='sign_in'>login now</a> or <a href='forgot_password'>forgot password</a>.</div>";
                    break;
                default:
                    echo "<div class='alert alert-danger'>Error: $error</div>";
                    break;
            }
        ?>
        <label for='username'>Username (*)</label>
        <input class="form-control" type="text" name="username" id="username" placeholder="Username..." required value="">
        <label for='name'>Full name (*)</label>
        <input class="form-control" type="text" name="name" id="name" placeholder="Your full name..." required value="">
        <label for='email'>Email (*)</label>
        <input class="form-control" type="email" name="email" id="email" placeholder="Email..." required value="">
        <label for='password'>Password (*)</label>
        <input class="form-control" type="password" name="password" id="password" placeholder="Password..." required>
        <label for='comfirm-password'>Re-enter password (*)</label>
        <input class="form-control" type="password" name="comfirm-password" id="comfirm-password"  placeholder="Re-enter password..." required>
        <button type="submit" class="btn btn-primary submit-btn">Submit</button>
        <em>
            Already have an account?
            <a href="sign_in">Log in</a>
        </em>
        </fieldset>
    </form>
</main>