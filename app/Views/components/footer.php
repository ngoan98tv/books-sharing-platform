<footer>
    <div>
        <?php if (!$uploader) { ?>
            <a href="sign_in">Sign in</a>
            <a href="sign_up">Sign up</a>    
        <?php } else { ?>
            <a href="sign_out">Logout (<em><?= $uploader->name ?></em>)</a>
        <?php }?>
        <a href="upload">Upload</a>
    </div>
    <p><a href='https://ngoan98tv.github.io' style='color: white; text-decoration: none;'>Ngoãn Trần</a> &copy; 2019</p>
</footer>
<script src="assets/script/index.js"></script>
</body>
</html>