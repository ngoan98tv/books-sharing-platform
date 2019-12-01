<footer>
    <div>
        <?php if (!$uploader) { ?>
            <a href="sign_in">Sign in</a>
            <a href="sign_up">Sign up</a>    
        <?php } else { ?>
            <p style='color: white; text-decoration: none;'>Logged-in as <?= $uploader->name ?></p>
            <a href="sign_out">Log out</a>
        <?php }?>
        <a href="upload">Upload</a>
    </div>
    
</footer>
<script src="assets/script/index.js"></script>
</body>
</html>