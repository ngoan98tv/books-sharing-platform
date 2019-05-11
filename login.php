<?php
    session_start();
    $_SESSION['page_title'] = 'Login';
    require "templates/header.php";
?>
<main>

<form class='login-form' action="login.php?location=<?php echo $_REQUEST['location'];?>" method="POST">
    <fieldset>
        <legend>LOG-IN</legend>

        <?php require "handlers/login_handler.php"; ?>

        <label for='username'>Username (*)</label>
        <input type="text" 
            name="username" 
            id="username" 
            placeholder="Username" 
            value="<?php echo $_POST['username'] ?? ''; ?>"
            required>

        <label for='password'>Password (*)</label>
        <input type="password" 
            name="password" 
            id="password" 
            placeholder="Password" 
            required>

        <button class="submit-btn" type="submit">Submit</button>
        <em>
            Your don't have any account?
            <a href="sign-up.php?location=<?php echo $_REQUEST['location']; ?>">Sign up</a>
        </em>
        
    </fieldset>
</form>
</main>

<?php require "templates/footer.php"; ?>