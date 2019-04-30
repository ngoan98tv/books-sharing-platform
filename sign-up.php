<?php
    session_start();
    $_SESSION['page_title'] = 'Sign-up';
    require "templates/header.php";
?>
<main>

<form class='login-form' action="sign-up.php?location=<?php echo $_REQUEST['location']; ?>" method="POST" style="max-width: 400px">
    <fieldset>
    <legend>SIGN-UP</legend>
    <?php require "handlers/sign-up_handler.php"; ?>
    <label for='username'>Username (*)</label>
    <input type="text" name="username" id="username" placeholder="Username..." required 
        value="<?php echo $uploader ? $uploader['username'] : ''; ?>">
    <label for='name'>Full name (*)</label>
    <input type="text" name="name" id="name" placeholder="Your full name..." required
        value="<?php echo $uploader ? $uploader['name'] : ''; ?>">
    <label for='email'>Email (*)</label>
    <input type="email" name="email" id="email" placeholder="Email..." required
        value="<?php echo $uploader ? $uploader['email'] : ''; ?>">
    <label for='password'>Password (*)</label>
    <input type="password" name="password" id="password" placeholder="Password..." required
        value="<?php echo $uploader ? $uploader['password'] : ''; ?>">
    <label for='comfirm-password'>Re-enter password (*)</label>
    <input type="password" name="comfirm-password" id="comfirm-password"  placeholder="Re-enter password..." required
        value="<?php echo $uploader ? $uploader['password_confirm'] : ''; ?>">
    
    <button type="submit">Submit</button>
    <em>Your already have an account?
    <a href="login.php?location=<?php echo $_REQUEST['location'];?>">Log in</a></em>
    </fieldset>
</form>
</main>
<?php require "templates/footer.php"; ?>