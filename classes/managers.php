<?php
include_once 'connections.php';

class Manager
{
    public function insert($first_name, $last_name, $email, $password, $phone_number)
    {
        // return 0 or 1
        $instance = ConnectionDb::getInstance();
        $conn = $instance->getConnection();
        $manager_insert = $conn->prepare("INSERT INTO `managers`(`first_name`, `last_name`, `email`, `password`, `phone_number`) VALUES (?,?,?,?,?);");
        $manager_insert->bind_param("sssss", $first_name, $last_name, $email, $password, $phone_number);
        if ($manager_insert->execute()) {
            return 1;
        } else {
            return 0;
        }
    }

    public function update($id, $first_name, $last_name, $email, $password, $phone_number)
    {
        // return 0 or 1
        $instance = ConnectionDb::getInstance();
        $conn = $instance->getConnection();
        $manager_update = $conn->prepare("UPDATE `managers` SET `first_name`=?,`last_name`=?,`email`=?,`password`=?,`phone_number`=? WHERE `id`=?;");
        $manager_update->bind_param("sssssi", $first_name, $last_name, $email, $password, $phone_number, $id);
        if ($manager_update->execute()) {
            return 1;
        } else {
            return 0;
        }
    }

    public function retrieve_by_id($id)
    {
        // return associative array
        $instance = ConnectionDb::getInstance();
        $conn = $instance->getConnection();
        $retrieve_id = $conn->prepare("SELECT * FROM `managers` WHERE id = ? ;");
        $retrieve_id->bind_param('i', $id);
        if ($retrieve_id->execute()) {
            $result = $retrieve_id->get_result();
            return $result->fetch_assoc();
        } else {
            return 0;
        }
    }


    public function retrieve_all()
    {
        // returns object of rows get each by "$result->fetch_assoc();"
        $instance = ConnectionDb::getInstance();
        $conn = $instance->getConnection();
        $retrieve_all = $conn->prepare("SELECT * FROM `managers` ;");
        if ($retrieve_all->execute()) {
            return mysqli_stmt_get_result($retrieve_all);
        } else {
            return 0;
        }
    }

    public function delete_by_id($id)
    {
        // return 0 or 1
        $instance = ConnectionDb::getInstance();
        $conn = $instance->getConnection();
        $deleted_manager = $conn->prepare("DELETE FROM `managers` WHERE id = ? ;");
        $deleted_manager->bind_Param('i', $id);
        if ($deleted_manager->execute()) {
            return 1;
        } else {
            return 0;
        }
    }
}
