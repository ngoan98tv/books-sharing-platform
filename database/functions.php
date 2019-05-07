<?php

function connect_db() {
    $host = "localhost";
    $user = "tvngoan";
    $pass = "password";
    $db = "books";

    $conn = new mysqli($host, $user, $pass, $db);
    $conn->set_charset("utf8");

    if ($conn->connect_error) {
        die("Connection failed: ".$conn->connect_error);
    }

    return $conn;
}

function get_book_by_id($id) {
    $conn = connect_db();
    $result = $conn->query("SELECT * FROM book WHERE id = '$id'");
    $book = $result->fetch_assoc();
    return $book;
}

function get_books_all_total() {
    $conn = connect_db();
    $result = $conn->query("SELECT COUNT(*) as num FROM book");
    $total = $result->fetch_assoc();
    return $total['num'];
}

function get_books_all($page, $books_per_page) {
    $conn = connect_db();
    $result = $conn->query("SELECT b.id as id, title, author, year, c.name as category, cover_url, file_url, u.name as uploader
    FROM book b JOIN category c ON b.category_id = c.id JOIN uploader u ON b.uploader_id = u.id 
    LIMIT ".($page*$books_per_page).",$books_per_page") or die($conn->error);
    $conn->close();
    return $result;
}

function get_books_by_cat_total($categoryId) {
    $conn = connect_db();
    $result = $conn->query("SELECT COUNT(*) as num FROM book WHERE category_id = $categoryId") 
        or die("get_books_by_cat_total: ".$conn->error);
    $total = $result->fetch_assoc();
    return $total['num'];
}

function get_books_by_cat($categoryId, $page, $books_per_page) {
    $conn = connect_db();
    $result = $conn->query("SELECT b.id as id, title, author, year, c.name as category, cover_url, file_url, u.name as uploader
        FROM book b JOIN category c ON b.category_id = c.id JOIN uploader u ON b.uploader_id = u.id 
        WHERE b.category_id = $categoryId
        LIMIT ".($page*$books_per_page).",$books_per_page")
            or die("get_books_by_cat: ".$conn->error);
    $conn->close();
    return $result;
}

function get_books_by_uploader_total($uploaderId) {
    $conn = connect_db();
    $result = $conn->query("SELECT COUNT(*) as num FROM book WHERE uploader_id = $uploaderId");
    $total = $result->fetch_assoc();
    return $total['num'];
}

function get_books_by_uploader($uploaderId, $page, $books_per_page) {
    $conn = connect_db();
    $result = $conn->query("SELECT b.id as id, title, author, year, c.name as category, cover_url, file_url, u.name as uploader
        FROM book b JOIN category c ON b.category_id = c.id JOIN uploader u ON b.uploader_id = u.id
        WHERE b.uploader_id = $uploaderId
        LIMIT ".($page*$books_per_page).",$books_per_page");
    $conn->close();
    return $result;
}

function get_categories() {
    $conn = connect_db();
    $result = $conn->query("SELECT * FROM category");
    $conn->close();
    return $result;
}

function get_category_by_id($id) {
    $conn = connect_db();
    $result = $conn->query("SELECT * FROM category WHERE id = '$id'");
    $conn->close();
    $category = $result->fetch_assoc();
    return $category['name'] ?? "";
}

function new_category($name) {
    $conn = connect_db();
    $conn->query("INSERT INTO category (name) VALUES ('$name')") or die($conn->error);
    $result = $conn->query("SELECT * FROM category WHERE name = '$name'") or die($conn->error);
    $conn->close();
    $category = $result->fetch_assoc();
    return $category['id'];
}

function add_book($book) {
    $conn = connect_db();
    if ($book['year']) {
    $conn->query("INSERT INTO book 
        (title, author, year, cover_url, uploader_id, category_id, file_url)
        VALUES ('$book[title]', 
                '$book[author]', 
                '$book[year]', 
                '$book[coverURL]', 
                '$book[uploaderId]', 
                '$book[categoryId]', 
                '$book[fileURL]')") or die($conn->error);
    } else {
        $conn->query("INSERT INTO book 
        (title, author, cover_url, uploader_id, category_id, file_url)
        VALUES ('$book[title]', 
                '$book[author]', 
                '$book[coverURL]', 
                '$book[uploaderId]', 
                '$book[categoryId]', 
                '$book[fileURL]')") or die($conn->error);
    }
    $conn->close();
}

function delete_book($id) {
    $conn = connect_db();
    $conn->query("DELETE FROM book WHERE id = '$id'");
    $conn->close();
}

function check_login($username, $password) {
    $conn = connect_db();
    $result = $conn->query("SELECT * FROM uploader WHERE username = '$username'");
    $conn->close();

    if ($result->num_rows > 0) {
        $uploader = $result->fetch_assoc();
        return $password == $uploader['password'] ? 1 : 0;
    } else {
        return -1;
    }
}

function get_uploader($username) {
    $conn = connect_db();
    $result = $conn->query("SELECT * FROM uploader WHERE username = '$username'");
    $conn->close();
    if ($result->num_rows > 0) {
        $uploader = $result->fetch_assoc();
        return $uploader;
    } else {
        return null;
    }
}

function new_uploader($uploader) {
    $conn = connect_db();
    $conn->query("INSERT INTO uploader 
        (username, name, email, password)
        VALUES ('$uploader[username]', 
                '$uploader[name]', 
                '$uploader[email]', 
                '$uploader[password]')") or die($conn->error);
    $conn->close();
}

function is_valid_username($username) {
    $conn = connect_db();
    $result = $conn->query("SELECT * FROM uploader WHERE username = '$username'");
    $conn->close();
    if ($result->num_rows == 0) {
        return true;
    } else {
        return false;
    }
}

function is_valid_email($email) {
    $conn = connect_db();
    $result = $conn->query("SELECT * FROM uploader WHERE email = '$email'");
    $conn->close();
    if ($result->num_rows == 0) {
        return true;
    } else {
        return false;
    }
}

function get_top_uploaders() {
    $conn = connect_db();
    $result = $conn->query("SELECT uploader_id, username, name, COUNT(*) AS uploaded 
                            FROM book b JOIN uploader u ON b.uploader_id = u.id
                            GROUP BY uploader_id 
                            ORDER BY uploaded DESC 
                            LIMIT 10;");
    $conn->close();
    return $result;
}

function hash_password($password, $username) {
    return sha1(md5($username.$password).$password);
}

function get_search_total($keyword) {
    $conn = connect_db();

    $result = $conn->query("SELECT COUNT(*) as num FROM book 
            WHERE title LIKE '%$keyword%' or author LIKE '%$keyword%';") or die("get_search_total: ".$conn->error);
    
    $total = $result->fetch_assoc();

    return $total['num'];
}

function get_search_result($keyword, $page, $books_per_page) {
    $conn = connect_db();

    $result = $conn->query("SELECT title, author, year, c.name as category, cover_url, file_url, u.name as uploader
    FROM book b JOIN category c ON b.category_id = c.id JOIN uploader u ON b.uploader_id = u.id 
    WHERE title LIKE '%$keyword%' or author LIKE '%$keyword%'
    LIMIT ".($page*$books_per_page).",$books_per_page");

    return $result;
}

?>