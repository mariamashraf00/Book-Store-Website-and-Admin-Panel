<?php
include_once 'connections.php';

class Events
{
    public static function insert($title, $presenter_name, $coordinator_id, $start_date, $description)
    {
        // return 0 or 1
        $instance = ConnectionDb::getInstance();
        $conn = $instance->getConnection();
        $event_insert = $conn->prepare("INSERT INTO `events`(`title`, `presenter_name`, `coordinator_id`, `start_date`, `description`) VALUES (?,?,?,?,?)");
        $event_insert->bind_param("ssiss", $title, $presenter_name, $coordinator_id, $start_date, $description);
        if ($event_insert->execute()) {
            return 1;
        } else {
            return 0;
        }
    }

    public static function update($id, $title, $presenter_name, $coordinator_id, $start_date, $description)
    {
        // return 0 or 1
        $instance = ConnectionDb::getInstance();
        $conn = $instance->getConnection();
        $event_update = $conn->prepare("UPDATE `events` SET `title`=?,`presenter_name`=?,`coordinator_id`=?,`start_date`=?,`description`=? WHERE `id`=?");
        $event_update->bind_param("ssissi", $title, $presenter_name, $coordinator_id, $start_date, $description, $id);
        if ($event_update->execute()) {
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
        $retrieve_event = $conn->prepare("SELECT * FROM `events` WHERE id = ? ;");
        $retrieve_event->bind_param('i', $id);
        if ($retrieve_event->execute()) {
            $result = $retrieve_event->get_result();
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
        $retrive_all = $conn->prepare("SELECT * FROM `events` ;");
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
        $deleted_event = $conn->prepare("DELETE FROM `events` WHERE id = ? ;");
        $deleted_event->bind_Param('i', $id);
        if ($deleted_event->execute()) {
            return 1;
        } else {
            return 0;
        }
    }
}
