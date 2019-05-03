<?php

if (isset($_POST['username'])) {
    $uploader = array(
        'username' => $_POST['username'],
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'password' => hash_password($_POST['password'],$_POST['username']),
        'password_confirm' => hash_password($_POST['comfirm-password'],$_POST['username'])
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