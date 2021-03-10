<?php
include_once 'connections.php';

class Order
{
    public static function insert($customer_username, $date, $total_price, $disount_code)
    {
        // return 0 or 1
        $instance = ConnectionDb::getInstance();
        $conn = $instance->getConnection();
        $order_insert = $conn->prepare("INSERT INTO `orders`(`customer_username`, `date`, `total_price`, `disount_code`) VALUES (?,?,?,?);");
        $order_insert->bind_param("ssis", $customer_username, $date, $total_price, $disount_code);
        if ($order_insert->execute()) {
            return 1;
        } else {
            return 0;
        }
    }

    public static function retrieve_by_customer_username($username)
    {
        // returns object of rows get each by "$result->fetch_assoc();"
        $instance = ConnectionDb::getInstance();
        $conn = $instance->getConnection();
        $retrive_username = $conn->prepare("SELECT * FROM `orders` WHERE `customer_username` = ? ;");
        $retrive_username->bind_param('s', $username);
        if ($retrive_username->execute()) {
            return mysqli_stmt_get_result($retrive_username);
        } else {
            return 0;
        }
    }

    public static function retrieve_last()
    {
        // returns object of rows get each by "$result->fetch_assoc();"
        $instance = ConnectionDb::getInstance();
        $conn = $instance->getConnection();
        $retrive_username = $conn->prepare("SELECT * FROM `orders` ORDER BY id DESC  LIMIT 1");
        if ($retrive_username->execute()) {
            return mysqli_stmt_get_result($retrive_username);
        } else {
            return 0;
        }
    }
    public static function retrieve_by_date($date)
    {
        // returns object of rows get each by "$result->fetch_assoc();"
        $instance = ConnectionDb::getInstance();
        $conn = $instance->getConnection();
        $retrive_date = $conn->prepare("SELECT * FROM `orders` WHERE `date` = ? ;");
        $retrive_date->bind_param('s', $date);
        if ($retrive_date->execute()) {
            return mysqli_stmt_get_result($retrive_date);
        } else {
            return 0;
        }
    }

    public static function retrieve_all()
    {
        // returns object of rows get each by "$result->fetch_assoc();"
        $instance = ConnectionDb::getInstance();
        $conn = $instance->getConnection();
        $retrive_all = $conn->prepare("SELECT * FROM `orders`;");
        if ($retrive_all->execute()) {
            return mysqli_stmt_get_result($retrive_all);
        } else {
            return 0;
        }
    }

    public static function delete_by_id($id)
    {
        // return 0 or 1
        $instance = ConnectionDb::getInstance();
        $conn = $instance->getConnection();
        $deleted_order = $conn->prepare("DELETE FROM `orders` WHERE id = ? ;");
        $deleted_order->bind_Param('i', $id);
        if ($deleted_order->execute()) {
            return 1;
        } else {
            return 0;
        }
    }
}
