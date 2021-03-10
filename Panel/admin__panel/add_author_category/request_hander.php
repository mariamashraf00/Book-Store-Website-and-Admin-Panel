<?php
require '../../connections.php';
require '../../classes/author.php';
require '../../classes/categories.php';
require '../../classes/publishing_house.php';


// --------------------- author -------------

if (isset($_POST['delete_author'])) {
    $id = $_POST['id'];
    $stmt = $conn->prepare("DELETE FROM authors WHERE `id` = $id");
    $stmt->execute();
    $data = $id;
    echo $data;
}

if (isset($_POST['add_author'])) {
    $name = $_POST['name'];
    $test = Author::check_by_name($name);
    if ($test->num_rows > 0) {
        echo 0;
        die();
    }
    $stmt = $conn->prepare("INSERT INTO authors (name) VALUES (?);");
    if (!$stmt) {
        $data =  1;
    }
    $stmt->bind_param("s", $name);
    if (!$stmt->execute()) {
        $data =  1;
    }
    echo $data;
}


//---------------- category ------

if (isset($_POST['add_cate'])) {
    $name = $_POST['name'];
    $test = Categories::check_by_name($name);
    if ($test->num_rows > 0) {
        echo 0;
        die();
    }
    $data = $name;
    $stmt = $conn->prepare("INSERT INTO categories (name) VALUES (?);");
    if (!$stmt) {
        $data =  1;
    }
    $stmt->bind_param("s", $name);
    if (!$stmt->execute()) {
        $data =  1;
    }
    echo $data;
}

if (isset($_POST['delete_cat'])) {
    $id = $_POST['id'];
    $stmt = $conn->prepare("DELETE FROM categories WHERE `id` = $id");
    $stmt->execute();
    $data = $id;
    echo $data;
}

//---------------- publishing house ------

if (isset($_POST['add_publish'])) {
    $name = $_POST['name'];
    $test = House::check_by_name($name);
    if ($test->num_rows > 0) {
        echo 0;
        die();
    }
    $data = $name;
    $stmt = $conn->prepare("INSERT INTO publishing_houses (name) VALUES (?);");
    if (!$stmt) {
        $data =  1;
    }
    $stmt->bind_param("s", $data);
    if (!$stmt->execute()) {
        $data =  1;
    }
    echo $data;
}

if (isset($_POST['delete_publish'])) {
    $id = $_POST['id'];
    $stmt = $conn->prepare("DELETE FROM publishing_houses WHERE `id` = $id");
    $stmt->execute();
    $data = $id;
    echo $data;
}
