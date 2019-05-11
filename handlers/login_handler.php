<?php
    if ($_SESSION['logged_in']) {
        header("Location: $_REQUEST[location]");
    }

    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = hash_password($_POST['password'],$_POST['username']);
        
        switch (check_login($username, $password)) {
            case 1:
                $_SESSION['logged_in'] = true;
                $_SESSION['uploader'] = get_uploader($username);
                echo "<div class='success'>
                        <p>Log-in success!</p>
                        <p><a href='upload.php'>Upload book now</a> or <a href='index.php'>Go to homepage</a></p>
                    </div>";
                break;
            case 0:
                echo "<div class='warning'>Password incorrect!</div>";
                break;
            case -1:
                echo "<div class='warning'>Username isn't exist!</div>";
                break;
            default:
                echo "<div class='warning'>Something went wrong! Please try again.</div>";
        }
    }
?>