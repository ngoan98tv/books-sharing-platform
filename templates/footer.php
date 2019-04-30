<footer>
    <div>
        <?php if (!$_SESSION['logged_in']) { ?>
            <a href="login.php?location=<?php echo $_SESSION['curr_page']; ?>">Login</a>
            <a href="sign-up.php?location=<?php echo $_SESSION['curr_page']; ?>">Sign up</a>    
        <?php } else { ?>
            <a href="logout.php">Logout (<?php echo $_SESSION['uploader']['name']; ?></em>)</a>
        <?php }?>
        <a href="upload.php">Upload</a>
    </div>
    <p>Ngoan Tran &copy; 2019</p>
</footer>
<script src="./script/index.js"></script>
</body>
</html>