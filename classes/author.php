<?php
include_once 'connections.php';

class Author
{
    public static function insert($name)
    {
        // return 0 or 1
        $instance = ConnectionDb::getInstance();
        $conn = $instance->getConnection();
        $author_insert = $conn->prepare("INSERT INTO `authors`(`name`) VALUES (?);");
        $author_insert->bind_param("s", $name);
        if ($author_insert->execute()) {
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
        $retrive_id = $conn->prepare("SELECT * FROM `authors` WHERE id = ? ;");
        $retrive_id->bind_param('i', $id);
        if ($retrive_id->execute()) {
            $result = $retrive_id->get_result();
            return $result->fetch_assoc();
        } else {
            return 0;
        }
    }


    public static function retrieve_all()
    {
        // returns object of rows get each by "$result->fetch_assoc();"
        $instance = ConnectionDb::getInstance();
        $conn = $instance->getConnection();
        $retrive_all = $conn->prepare("SELECT * FROM `authors` ;");
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
        $deleted_author = $conn->prepare("DELETE FROM `authors` WHERE id = ? ;");
        $deleted_author->bind_Param('i', $id);
        if ($deleted_author->execute()) {
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
        $author_update = $conn->prepare("UPDATE `authors` SET `name`=? WHERE `id`=?;");
        $author_update->bind_param("si", $name, $id);
        if ($author_update->execute()) {
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
        $retrive_all = $conn->prepare("SELECT * FROM `authors` WHERE name LIKE '%$search_word%';");
        if ($retrive_all->execute()) {
            return mysqli_stmt_get_result($retrive_all);
        } else {
            return 0;
        }
    }
}
