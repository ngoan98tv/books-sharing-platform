<?php
if (isset($_POST['username'])) {
    $uploader = array(
        'username' => $_POST['username'],
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'password' => $_POST['password'],
        'password_confirm' => $_POST['comfirm-password']
    );

    if (!is_valid_username($uploader['username'])) {
        echo "<div class='warning'>Username already taken, please try another.</div>";
    } elseif (!is_valid_email($uploader['email'])) {
        echo "<div class='warning'>Email already exist, <a href='login.php?location=$_REQUEST[location]'>login now</a> or <a href='forgot-password.php'>forgot password</a>.</div>";
    } elseif ($uploader['password'] != $uploader['password_confirm']) {
        echo "<div class='warning'>Confirm password not match!</div>";
    } else {
        new_uploader($uploader);
        echo "<div class='success'>Sign up success. <a href='login.php?location=$_REQUEST[location]'>Login now!</a></div>";
    }
}
?>