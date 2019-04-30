<?php
if (isset($_POST["delete"])) {
    $isbn = $_POST["isbn"];

    $q = "DELETE FROM classics WHERE isbn = '$isbn'";

    if ($conn->query($q))
        echo "<p>Delete complete!</p>";
    else
        echo "<p>Delete failed: ".$conn->error."</p>";
}
?>