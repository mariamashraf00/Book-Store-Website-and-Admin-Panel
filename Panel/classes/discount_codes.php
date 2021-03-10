<?php
include_once 'connections.php';

class DiscountCodes
{
    public static function insert($code, $expiry_date, $start_date, $percentage)
    {
        // return 0 or 1
        $instance = ConnectionDb::getInstance();
        $conn = $instance->getConnection();
        $code_insert = $conn->prepare("INSERT INTO `disount_codes`(`code`, `expiry_date`, `start_date`, `percentage`) VALUES (?,?,?,?)");
        $code_insert->bind_param("sssi", $code, $expiry_date, $start_date, $percentage);
        if ($code_insert->execute()) {
            return 1;
        } else {
            return 0;
        }
    }

    public static function update($code, $expiry_date, $start_date, $percentage)
    {
        // return 0 or 1
        $instance = ConnectionDb::getInstance();
        $conn = $instance->getConnection();
        $code_update = $conn->prepare("UPDATE `disount_codes` SET `expiry_date`=?,`start_date`=?,`percentage`=? WHERE `code`=?");
        $code_update->bind_param("ssis", $expiry_date, $start_date, $percentage, $code);
        if ($code_update->execute()) {
            return 1;
        } else {
            return 0;
        }
    }

    public static function retrieve_by_code($code)
    {
        // return associative array
        $instance = ConnectionDb::getInstance();
        $conn = $instance->getConnection();
        $retrive_code = $conn->prepare("SELECT * FROM `disount_codes` WHERE code = ? ;");
        $retrive_code->bind_param('s', $code);
        if ($retrive_code->execute()) {
            $result = $retrive_code->get_result();
            return $result->fetch_assoc();
        } else {
            return 0;
        }
    }

    public static function check_by_code($code)
    {
        // return associative array
        $instance = ConnectionDb::getInstance();
        $conn = $instance->getConnection();
        $retrive_code = $conn->prepare("SELECT * FROM `disount_codes` WHERE code = ? ;");
        $retrive_code->bind_param('s', $code);
        if ($retrive_code->execute()) {
            $result = $retrive_code->get_result();
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
        $retrive_all = $conn->prepare("SELECT * FROM `disount_codes` ;");
        if ($retrive_all->execute()) {
            return mysqli_stmt_get_result($retrive_all);
        } else {
            return 0;
        }
    }

    public static function delete_by_code($code)
    {
        // return 0 or 1
        $instance = ConnectionDb::getInstance();
        $conn = $instance->getConnection();
        $deleted_code = $conn->prepare("DELETE FROM `disount_codes` WHERE code = ? ;");
        $deleted_code->bind_Param('i', $code);
        if ($deleted_code->execute()) {
            return 1;
        } else {
            return 0;
        }
    }
}
