<?php
    require "../database/functions.php";

    $keyword = $_GET['search'];

    $conn = connect_db();

    $result = $conn->query("SELECT title FROM book WHERE title LIKE '%$keyword%' LIMIT 5;");

    while ($row = $result->fetch_assoc()){
        $arr[] = $row['title'];
    }

    $result = $conn->query("SELECT author FROM book WHERE author LIKE '%$keyword%' LIMIT 5;");

    while ($row = $result->fetch_assoc()){
        $arr[] = $row['author'];
    }

    $conn->close();

    //header('Content-Type: application/json');
    echo json_encode($arr);
?>