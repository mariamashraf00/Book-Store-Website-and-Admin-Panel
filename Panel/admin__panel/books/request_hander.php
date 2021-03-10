<?php
require '../../connections.php';
require '../../classes/Books.php';

if (isset($_POST['get'])) {
    $id = $_POST['id'];
    $column = $_POST['column'];
    $result = $conn->query("SELECT $column FROM `books` WHERE `isbn` = $id");
    $data = $result->fetch_assoc();
    echo $data[$column];
}

if (isset($_POST['set'])) {
    $column = $_POST['column'];
    $data = $_POST['data'];
    $id = $_POST['id'];
    $result = $conn->query("UPDATE `books` SET $column = $data WHERE `isbn` = $id");
    if (!$result) {
        echo 1;
        die();
    }
    echo $data;
}

if (isset($_POST['delete'])) {
    $id = $_POST['isbn'];
    $stmt = $conn->prepare("DELETE FROM books WHERE `isbn` = $id");
    $stmt->execute();
    echo $data;
}

if (isset($_POST['add'])) {
    $isbn = $_POST['isbn'];
    $title = $_POST['title'];
    $des = $_POST['description'];
    $a_id =  $_POST['author_id'];
    $c_id = $_POST['category_id'];
    $pub_h = $_POST['publishing_house_id'];
    $p_for = $_POST['published_format'];
    $cop = $_POST['copies'];
    $lan = $_POST['language'];
    $price = $_POST['price'];
    $img = $_POST['image'];

    $test = Books::check_by_isbn(trim($isbn, '\'"'));
    if ($test->num_rows > 0) {
        echo 0;
        die();
    }
    $result = $conn->query("INSERT INTO books (isbn, title, description, category_id, publishing_house_id, author_id, price, published_format, image, copies, language) VALUES ($isbn,$title,$des,$c_id,$pub_h, $a_id,$price,$p_for,$img,$cop,$lan)");
    if (!$result)
        echo 1;
    else
        echo 2;
}
