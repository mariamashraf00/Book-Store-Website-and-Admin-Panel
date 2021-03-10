<?php
include_once 'connections.php';

class WishList
{
    public static function insert($customer_username, $book_isbn)
    {
        // return 0 or 1
        $instance = ConnectionDb::getInstance();
        $conn = $instance->getConnection();
        $wish_insert = $conn->prepare("INSERT INTO `wishlists`(`customer_username`, `book_isbn`) VALUES (?,?);");
        $wish_insert->bind_param("ss", $customer_username, $book_isbn);
        if ($wish_insert->execute()) {
            return 1;
        } else {
            return 0;
        }
    }

    public static function retrieve_by_book_isbn($isbn)
    {
        // returns object of rows get each by "$result->fetch_assoc();"
        $instance = ConnectionDb::getInstance();
        $conn = $instance->getConnection();
        $retrive_isbn = $conn->prepare("SELECT * FROM `wishlists` WHERE book_isbn = ? ;");
        $retrive_isbn->bind_param('s', $isbn);
        if ($retrive_isbn->execute()) {
            return mysqli_stmt_get_result($retrive_isbn);
        } else {
            return 0;
        }
    }

    public static function retrieve_by_customer_username($username)
    {
        // returns object of rows get each by "$result->fetch_assoc();"
        $instance = ConnectionDb::getInstance();
        $conn = $instance->getConnection();
        $retrive_username = $conn->prepare("SELECT * FROM `wishlists` WHERE customer_username = ? ;");
        $retrive_username->bind_param('s', $username);
        if ($retrive_username->execute()) {
            return mysqli_stmt_get_result($retrive_username);
        } else {
            return 0;
        }
    }
    public static function retrieve_books_by_customer_username($username)
    {
        // returns object of rows get each by "$result->fetch_assoc();"
        $instance = ConnectionDb::getInstance();
        $conn = $instance->getConnection();
        $retrive_username = $conn->prepare("SELECT * FROM `wishlists`,books WHERE isbn=book_isbn AND customer_username = ? ;");
        $retrive_username->bind_param('s', $username);
        if ($retrive_username->execute()) {
            return mysqli_stmt_get_result($retrive_username);
        } else {
            return 0;
        }
    }

    public static function retrieve_all()
    {
        // returns object of rows get each by "$result->fetch_assoc();"
        $instance = ConnectionDb::getInstance();
        $conn = $instance->getConnection();
        $retrive_all = $conn->prepare("SELECT * FROM `wishlists`;");
        if ($retrive_all->execute()) {
            return mysqli_stmt_get_result($retrive_all);
        } else {
            return 0;
        }
    }

    public static function delete($customer_username, $isbn)
    {
        // return 0 or 1
        $instance = ConnectionDb::getInstance();
        $conn = $instance->getConnection();
        $deleted_wish = $conn->prepare("DELETE FROM `wishlists` WHERE customer_username = ? AND book_isbn = ?  ;");
        $deleted_wish->bind_Param('ss', $customer_username, $isbn);
        if ($deleted_wish->execute()) {
            return 1;
        } else {
            return 0;
        }
    }
}
