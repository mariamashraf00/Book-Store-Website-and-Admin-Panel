<?php
include_once 'connections.php';

class House
{
    public static function insert($name)
    {
        // return 0 or 1
        $instance = ConnectionDb::getInstance();
        $conn = $instance->getConnection();
        $house_insert = $conn->prepare("INSERT INTO `publishing_houses`(`name`) VALUES (?);");
        $house_insert->bind_param("s", $name);
        if ($house_insert->execute()) {
            return 1;
        } else {
            return 0;
        }
    }

    public static function retrieve_by_id($id)
    {
        // return associative array
        $instance = ConnectionDb::getInstance();
        $conn = $instance->getConnection();
        $retrive_id = $conn->prepare("SELECT * FROM `publishing_houses` WHERE id = ? ;");
        $retrive_id->bind_param('i', $id);
        if ($retrive_id->execute()) {
            $result = $retrive_id->get_result();
            return $result->fetch_assoc();
        } else {
            return 0;
        }
    }

    public static function check_by_name($name)
    {
        // return associative array
        $instance = ConnectionDb::getInstance();
        $conn = $instance->getConnection();
        $retrive_name = $conn->prepare("SELECT * FROM `publishing_houses` WHERE name = ? ;");
        $retrive_name->bind_param('s', $name);
        if ($retrive_name->execute()) {
            $result = $retrive_name->get_result();
            return $result;
        } else {
            return 0;
        }
    }

    public static function retrieve_all()
    {
        // returns object of rows get each by "$result->fetch_assoc();"
        $instance = ConnectionDb::getInstance();
        $conn = $instance->getConnection();
        $retrive_all = $conn->prepare("SELECT * FROM `publishing_houses`;");
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
        $deleted_house = $conn->prepare("DELETE FROM `publishing_houses` WHERE id = ? ;");
        $deleted_house->bind_Param('i', $id);
        if ($deleted_house->execute()) {
            return 1;
        } else {
            return 0;
        }
    }

    public static function update($id, $name)
    {
        // return 0 or 1
        $instance = ConnectionDb::getInstance();
        $conn = $instance->getConnection();
        $house_update = $conn->prepare("UPDATE `publishing_houses` SET `name`=? WHERE `id`=?;");
        $house_update->bind_param("si", $name, $id);
        if ($house_update->execute()) {
            return 1;
        } else {
            return 0;
        }
    }

    public static function Search($search_word)
    {
        // returns object of rows get each by "$result->fetch_assoc();"
        $instance = ConnectionDb::getInstance();
        $conn = $instance->getConnection();
        $retrive_all = $conn->prepare("SELECT * FROM `publishing_houses` WHERE name LIKE '%$search_word%';");
        if ($retrive_all->execute()) {
            return mysqli_stmt_get_result($retrive_all);
        } else {
            return 0;
        }
    }
}
