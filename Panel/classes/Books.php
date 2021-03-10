<?php
include_once 'connections.php';

class Books
{

    public static function insert_Book(
        // return 0 or 1
        $isbn,
        $title,
        $describtion,
        $category_id,
        $house_id,
        $author_id,
        $price,
        $format,
        $image,
        $copies,
        $lanuage
    ) {
        $instance = ConnectionDb::getInstance();
        $conn = $instance->getConnection();
        $book_insert = $conn->prepare("INSERT INTO `books`(`isbn`, `title`, `description`, `category_id`, `publishing_house_id`, `author_id`, `price`, `published_format`, `image`, `copies`, `language`) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
        $book_insert->bind_Param(
            'sssiiiissis',
            $isbn,
            $title,
            $describtion,
            $category_id,
            $house_id,
            $author_id,
            $price,
            $format,
            $image,
            $copies,
            $lanuage
        );
        if ($book_insert->execute()) {
            return 1;
        } else {
            return 0;
        }
    }

    public static function update(
        // return 0 or 1
        $isbn,
        $title,
        $describtion,
        $category_id,
        $house_id,
        $author_id,
        $price,
        $format,
        $image,
        $copies,
        $lanuage
    ) {
        $instance = ConnectionDb::getInstance();
        $conn = $instance->getConnection();
        $book_update = $conn->prepare("UPDATE `books` SET `title`=?,`description`=?,`category_id`=?,`publishing_house_id`=?,`author_id`=?,`price`=?,`published_format`=?,`image`=?,`copies`=?,`language`=? WHERE `isbn`=?;");
        $book_update->bind_Param(
            'ssiiiississ',
            $title,
            $describtion,
            $category_id,
            $house_id,
            $author_id,
            $price,
            $format,
            $image,
            $copies,
            $lanuage,
            $isbn
        );
        if ($book_update->execute()) {
            return 1;
        } else {
            return 0;
        }
    }

    public static function Search($title)
    {
        // returns object of rows get each by "$result->fetch_assoc();"
        $instance = ConnectionDb::getInstance();
        $conn = $instance->getConnection();
        $ret_title = $conn->prepare("SELECT * FROM books,authors,categories,publishing_houses WHERE (author_id=authors.id AND category_id=categories.id AND publishing_house_id=publishing_houses.id) AND
        (title LIKE '%$title%' or language LIKE '%$title%' or authors.name LIKE '%$title%' or categories.name LIKE '%$title%' or publishing_houses.name LIKE '%$title%' );");
        if ($ret_title->execute()) {
            return mysqli_stmt_get_result($ret_title);
        } else {
            return 0;
        }
    }

    public static function retrive_by_isbn($id)
    {
        // return associative array
        $instance = ConnectionDb::getInstance();
        $conn = $instance->getConnection();
        $ret_id = $conn->prepare("SELECT * FROM `books` WHERE isbn = ? ;");
        $ret_id->bind_param('i', $id);
        if ($ret_id->execute()) {
            $result = $ret_id->get_result();
            return $result->fetch_assoc();
        } else {
            return 0;
        }
    }

    public static function check_by_isbn($isbn)
    {
        // return associative array
        $instance = ConnectionDb::getInstance();
        $conn = $instance->getConnection();
        $retrive_isbn = $conn->prepare("SELECT * FROM `books` WHERE isbn = ? ;");
        $retrive_isbn->bind_param('s', $isbn);
        if ($retrive_isbn->execute()) {
            $result = $retrive_isbn->get_result();
            return $result;
        } else {
            return 0;
        }
    }

    public static function retrive_all()
    {
        // returns object of rows get each by "$result->fetch_assoc();"
        $instance = ConnectionDb::getInstance();
        $conn = $instance->getConnection();
        $ret_all = $conn->prepare("SELECT * FROM `books` ;");
        if ($ret_all->execute()) {
            return mysqli_stmt_get_result($ret_all);
        } else {
            return 0;
        }
    }

    public static function retrive_latest()
    {
        // returns object of rows get each by "$result->fetch_assoc();"
        $instance = ConnectionDb::getInstance();
        $conn = $instance->getConnection();
        $ret_all = $conn->prepare("SELECT * FROM `books` ORDER BY isbn DESC ;");
        if ($ret_all->execute()) {
            return mysqli_stmt_get_result($ret_all);
        } else {
            return 0;
        }
    }

    public static function delete_by_id($id)
    {
        // return 0 or 1
        $instance = ConnectionDb::getInstance();
        $conn = $instance->getConnection();
        $deleted_book = $conn->prepare("DELETE FROM `books` WHERE isbn = ?  ;");
        $deleted_book->bind_Param('i', $id);
        if ($deleted_book->execute()) {
            return 1;
        } else {
            return 0;
        }
    }
}
