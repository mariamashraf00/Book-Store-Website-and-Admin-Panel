<?php
include_once 'connections.php';

class Coordinator
{
    public function insert($first_name, $last_name, $email, $password, $phone_number, $manager_id)
    {
        // return 0 or 1
        $instance = ConnectionDb::getInstance();
        $conn = $instance->getConnection();
        $coordinator_insert = $conn->prepare("INSERT INTO `event_coordinators`(`first_name`, `last_name`, `email`, `password`, `phone_number`, `manager_id`) VALUES (?,?,?,?,?,?);");
        $coordinator_insert->bind_param("sssssi", $first_name, $last_name, $email, $password, $phone_number, $manager_id);
        if ($coordinator_insert->execute()) {
            return 1;
        } else {
            return 0;
        }
    }

    public function update($id, $first_name, $last_name, $email, $password, $phone_number, $manager_id)
    {
        // return 0 or 1
        $instance = ConnectionDb::getInstance();
        $conn = $instance->getConnection();
        $coordinator_update = $conn->prepare("UPDATE `event_coordinators` `first_name`=?,`last_name`=?,`email`=?,`password`=?,`phone_number`=?,`manager_id`=? WHERE SET `id`=?;");
        $coordinator_update->bind_param("sssssii", $first_name, $last_name, $email, $password, $phone_number, $manager_id, $id);
        if ($coordinator_update->execute()) {
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
        $retrieve_id = $conn->prepare("SELECT * FROM `event_coordinators` WHERE id = ? ;");
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
        $retrieve_all = $conn->prepare("SELECT * FROM `event_coordinators` ;");
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
        $deleted_coordinator = $conn->prepare("DELETE FROM `event_coordinators` WHERE id = ? ;");
        $deleted_coordinator->bind_Param('i', $id);
        if ($deleted_coordinator->execute()) {
            return 1;
        } else {
            return 0;
        }
    }
}
