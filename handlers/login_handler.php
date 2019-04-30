<?php
    if ($_SESSION['logged_in']) {
        header("Location: $_REQUEST[location]");
    }

    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        switch (check_login($username, $password)) {
            case 1:
                $_SESSION['logged_in'] = true;
                $_SESSION['uploader'] = get_uploader($username);
                header("Location: $_REQUEST[location]");
                break;
            case 0:
                echo "Password incorrect!";
                break;
            case -1:
                echo "Invalid username!";
                break;
            default:
                echo "Something went wrong! Please try again.";
        }
    }
?>