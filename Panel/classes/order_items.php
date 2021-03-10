<?php
include_once 'connections.php';

class OrderItem
{
    public static function insert($book_isbn, $order_id, $amount)
    {
        // return 0 or 1
        $instance = ConnectionDb::getInstance();
        $conn = $instance->getConnection();
        $item_insert = $conn->prepare("INSERT INTO `order_items`(`book_isbn`, `order_id`, `amount`) VALUES (?,?,?);");
        $item_insert->bind_param("sii", $book_isbn, $order_id, $amount);
        if ($item_insert->execute()) {
            return 1;
        } else {
            return 0;
        }
    }

    public static function retrieve_by_order_id($id)
    {
        // returns object of rows get each by "$result->fetch_assoc();"
        $instance = ConnectionDb::getInstance();
        $conn = $instance->getConnection();
        $retrive_id = $conn->prepare("SELECT * FROM `order_items` WHERE order_id = ? ;");
        $retrive_id->bind_param('i', $id);
        if ($retrive_id->execute()) {
            return mysqli_stmt_get_result($retrive_id);
        } else {
            return 0;
        }
    }

    public static function retrieve_by_book_isbn($isbn)
    {
        // returns object of rows get each by "$result->fetch_assoc();"
        $instance = ConnectionDb::getInstance();
        $conn = $instance->getConnection();
        $retrive_isbn = $conn->prepare("SELECT * FROM `order_items` WHERE book_isbn = ? ;");
        $retrive_isbn->bind_param('s', $isbn);
        if ($retrive_isbn->execute()) {
            return mysqli_stmt_get_result($retrive_isbn);
        } else {
            return 0;
        }
    }

    public static function retrieve_all()
    {
        // returns object of rows get each by "$result->fetch_assoc();"
        $instance = ConnectionDb::getInstance();
        $conn = $instance->getConnection();
        $retrive_all = $conn->prepare("SELECT * FROM `order_items`;");
        if ($retrive_all->execute()) {
            return mysqli_stmt_get_result($retrive_all);
        } else {
            return 0;
        }
    }

    public function delete_by_order_id($id)
    {
        // return 0 or 1
        $instance = ConnectionDb::getInstance();
        $conn = $instance->getConnection();
        $deleted_item = $conn->prepare("DELETE FROM `order_items` WHERE order_id = ? ;");
        $deleted_item->bind_Param('i', $id);
        if ($deleted_item->execute()) {
            return 1;
        } else {
            return 0;
        }
    }
}
