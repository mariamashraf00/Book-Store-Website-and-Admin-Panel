<?php
include_once 'connections.php';

class Coordinator
{
    public static function insert($first_name, $last_name, $email, $password, $phone_number, $manager_id)
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

    public static function check_by_email($email)
    {
        // return associative array
        $instance = ConnectionDb::getInstance();
        $conn = $instance->getConnection();
        $retrive_email = $conn->prepare("SELECT * FROM `event_coordinators` WHERE email = ? ;");
        $retrive_email->bind_param('s', $email);
        if ($retrive_email->execute()) {
            $result = $retrive_email->get_result();
            return $result;
        } else {
            return 0;
        }
    }

    public static function check_by_phone($phone)
    {
        // return associative array
        $instance = ConnectionDb::getInstance();
        $conn = $instance->getConnection();
        $retrive_phone = $conn->prepare("SELECT * FROM `event_coordinators` WHERE phone_number = ? ;");
        $retrive_phone->bind_param('s', $phone);
        if ($retrive_phone->execute()) {
            $result = $retrive_phone->get_result();
            return $result;
        } else {
            return 0;
        }
    }


    public static function retrieve_by_email($email)
    {
        // return associative array
        $instance = ConnectionDb::getInstance();
        $conn = $instance->getConnection();
        $retrive_id = $conn->prepare("SELECT * FROM `event_coordinators` WHERE email = ? ;");
        $retrive_id->bind_param('s', $email);
        if ($retrive_id->execute()) {
            $result = $retrive_id->get_result();
            return $result->fetch_assoc();
        } else {
            return 0;
        }
    }

    public static function update($id, $first_name, $last_name, $email, $password, $phone_number, $manager_id)
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

    public static function retrieve_by_id($id)
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


    public static function retrieve_all()
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

    public static function delete_by_id($id)
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
    public static function update_password_by_email($email, $password)
    {
        // return 0 or 1
        $instance = ConnectionDb::getInstance();
        $conn = $instance->getConnection();
        $customer_update = $conn->prepare("UPDATE `event_coordinators` SET `password` = ? WHERE `email`=?");
        $customer_update->bind_param("ss", $password, $email);
        if ($customer_update->execute()) {
            return 1;
        } else {
            return 0;
        }
    }
}
