<?php
include_once 'connections.php';

class Customer
{
    public static function insert(
        $username,
        $first_name,
        $last_name,
        $password,
        $email,
        $address,
        $city,
        $zipcode,
        $phone_number
    ) {
        // return 0 or 1
        $instance = ConnectionDb::getInstance();
        $conn = $instance->getConnection();
        $customer_insert = $conn->prepare("INSERT INTO `customers`(`username`, `first_name`, `last_name`, `password`, `email`, `address`, `city`, `zipcode`, `phone_number`) VALUES (?,?,?,?,?,?,?,?,?);");
        $customer_insert->bind_param(
            "sssssssss",
            $username,
            $first_name,
            $last_name,
            $password,
            $email,
            $address,
            $city,
            $zipcode,
            $phone_number
        );
        if ($customer_insert->execute()) {
            return 1;
        } else {
            return 0;
        }
    }


    public static function update(
        $username,
        $first_name,
        $last_name,
        $password,
        $email,
        $address,
        $city,
        $zipcode,
        $phone_number
    ) {
        // return 0 or 1
        $instance = ConnectionDb::getInstance();
        $conn = $instance->getConnection();
        $customer_update = $conn->prepare("UPDATE `customers` SET `first_name`=?,`last_name`=?,`password`=?,`email`=?,`address`=?,`city`=?,`zipcode`=?,`phone_number`=? WHERE `username`=?");
        $customer_update->bind_param(
            "sssssssss",
            $first_name,
            $last_name,
            $password,
            $email,
            $address,
            $city,
            $zipcode,
            $phone_number,
            $username
        );
        if ($customer_update->execute()) {
            return 1;
        } else {
            return 0;
        }
    }

    public static function retrieve_by_username($username)
    {
        // return associative array
        $instance = ConnectionDb::getInstance();
        $conn = $instance->getConnection();
        $retrive_id = $conn->prepare("SELECT * FROM `customers` WHERE username = ? ;");
        $retrive_id->bind_param('s', $username);
        if ($retrive_id->execute()) {
            $result = $retrive_id->get_result();
            return $result->fetch_assoc();
        } else {
            return 0;
        }
    }

    public static function retrieve_by_email($email)
    {
        // return associative array
        $instance = ConnectionDb::getInstance();
        $conn = $instance->getConnection();
        $retrive_id = $conn->prepare("SELECT * FROM `customers` WHERE email = ? ;");
        $retrive_id->bind_param('s', $email);
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
        $retrive_all = $conn->prepare("SELECT * FROM `customers` ;");
        if ($retrive_all->execute()) {
            return mysqli_stmt_get_result($retrive_all);
        } else {
            return 0;
        }
    }

    public static function delete_by_username($username)
    {
        // return 0 or 1
        $instance = ConnectionDb::getInstance();
        $conn = $instance->getConnection();
        $deleted_customer = $conn->prepare("DELETE FROM `customers` WHERE username = ? ;");
        $deleted_customer->bind_Param('s', $username);
        if ($deleted_customer->execute()) {
            return 1;
        } else {
            return 0;
        }
    }

    public static function insert_token($username,$token) {
        // return 0 or 1
        $instance = ConnectionDb::getInstance();
        $conn = $instance->getConnection();
        $customer_insert = $conn->prepare("INSERT INTO `tokens`(`username`, `token`) VALUES (?,?);");
        $customer_insert->bind_param(
            "ss",
            $username,
            $token,
        );
        if ($customer_insert->execute()) {
            return 1;
        } else {
            return 0;
        }
    }
    
    
public static function retrieve_by_token($token)
    {
        // return associative array
        $instance = ConnectionDb::getInstance();
        $conn = $instance->getConnection();
        $retrive_id = $conn->prepare("SELECT * FROM `customers`,tokens WHERE customers.username=tokens.username AND token = ? ;");
        $retrive_id->bind_param('s', $token);
        if ($retrive_id->execute()) {
            $result = $retrive_id->get_result();
            return $result->fetch_assoc();
        } else {
            return 0;
        }
    }
    
    public static function delete_by_token($token)
    {
        // return 0 or 1
        $instance = ConnectionDb::getInstance();
        $conn = $instance->getConnection();
        $deleted_customer = $conn->prepare("DELETE FROM tokens WHERE token = ? ;");
        $deleted_customer->bind_Param('s', $token);
        if ($deleted_customer->execute()) {
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
        $customer_update = $conn->prepare("UPDATE `customers` SET `password` = ? WHERE `email`=?");
        $customer_update->bind_param("ss", $password, $email);
        if ($customer_update->execute()) {
            return 1;
        } else {
            return 0;
        }
    }
}
