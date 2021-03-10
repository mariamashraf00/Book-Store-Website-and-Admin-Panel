<?php
include_once 'connections.php';

class Clerk
{
    public static function insert($first_name, $last_name, $email, $password, $phone_number, $direct_manager_id)
    {
        // return 0 or 1
        $instance = ConnectionDb::getInstance();
        $conn = $instance->getConnection();
        $clerk_insert = $conn->prepare("INSERT INTO `data_entry_clerks`( `first_name`, `last_name`, `email`, `password`, `phone_number`, `direct_manager_id`) VALUES (?,?,?,?,?,?);");
        $clerk_insert->bind_param("sssssi", $first_name, $last_name, $email, $password, $phone_number, $direct_manager_id);
        if ($clerk_insert->execute()) {
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
        $retrive_email = $conn->prepare("SELECT * FROM `data_entry_clerks` WHERE email = ? ;");
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
        $retrive_phone = $conn->prepare("SELECT * FROM `data_entry_clerks` WHERE phone_number = ? ;");
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
        $retrive_id = $conn->prepare("SELECT * FROM `data_entry_clerks` WHERE email = ? ;");
        $retrive_id->bind_param('s', $email);
        if ($retrive_id->execute()) {
            $result = $retrive_id->get_result();
            return $result->fetch_assoc();
        } else {
            return 0;
        }
    }

    public static function retrieve_by_id($id)
    {
        // return associative array
        $instance = ConnectionDb::getInstance();
        $conn = $instance->getConnection();
        $retrieve_id = $conn->prepare("SELECT * FROM `data_entry_clerks` WHERE id = ? ;");
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
        $retrieve_all = $conn->prepare("SELECT * FROM `data_entry_clerks` ;");
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
        $deleted_clerk = $conn->prepare("DELETE FROM `data_entry_clerks` WHERE id = ? ;");
        $deleted_clerk->bind_Param('i', $id);
        if ($deleted_clerk->execute()) {
            return 1;
        } else {
            return 0;
        }
    }

    public static function update($id, $first_name, $last_name, $email, $password, $phone_number, $direct_manager_id)
    {
        // return 0 or 1
        $instance = ConnectionDb::getInstance();
        $conn = $instance->getConnection();
        $clerk_insert = $conn->prepare("UPDATE `data_entry_clerks` SET `first_name`=?,`last_name`=?,`email`=?,`password`=?,`phone_number`=?,`direct_manager_id`=? WHERE `id`=?;");
        $clerk_insert->bind_param("sssssii", $first_name, $last_name, $email, $password, $phone_number, $direct_manager_id, $id);
        if ($clerk_insert->execute()) {
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
        $customer_update = $conn->prepare("UPDATE `data_entry_clerks` SET `password` = ? WHERE `email`=?");
        $customer_update->bind_param("ss", $password, $email);
        if ($customer_update->execute()) {
            return 1;
        } else {
            return 0;
        }
    }
}
