<?php
include_once 'connections.php';

class Video
{
    public static function insert($title, $url, $event_id, $description)
    {
        // return 0 or 1
        $instance = ConnectionDb::getInstance();
        $conn = $instance->getConnection();
        $video_insert = $conn->prepare("INSERT INTO `videos`(`title`, `url`, `event_id`, `description`) VALUES (?,?,?,?)");
        $video_insert->bind_param("ssis", $title, $url, $event_id, $description);
        if ($video_insert->execute()) {
            return 1;
        } else {
            return 0;
        }
    }

    public static function update($id, $title, $url, $event_id, $description)
    {
        // return 0 or 1
        $instance = ConnectionDb::getInstance();
        $conn = $instance->getConnection();
        $video_update = $conn->prepare("UPDATE `videos` SET `title`=?,`url`=?,`event_id`=?,`description`=? WHERE `id`=?");
        $video_update->bind_param("ssisi", $title, $url, $event_id, $description, $id);
        if ($video_update->execute()) {
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
        $retrieve_video = $conn->prepare("SELECT * FROM `videos` WHERE id = ? ;");
        $retrieve_video->bind_param('i', $id);
        if ($retrieve_video->execute()) {
            $result = $retrieve_video->get_result();
            return $result->fetch_assoc();
        } else {
            return 0;
        }
    }

    public static function retrieve_by_event_id($event_id)
    {
        // returns object of rows get each by "$result->fetch_assoc(
        $instance = ConnectionDb::getInstance();
        $conn = $instance->getConnection();
        $retrive_all = $conn->prepare("SELECT * FROM `videos` WHERE event_id = ? ;");
        $retrive_all->bind_param('i', $event_id);
        if ($retrive_all->execute()) {
            return mysqli_stmt_get_result($retrive_all);
        } else {
            return 0;
        }
    }


    public static function retrieve_all()
    {
        // returns object of rows get each by "$result->fetch_assoc();"
        $instance = ConnectionDb::getInstance();
        $conn = $instance->getConnection();
        $retrive_all = $conn->prepare("SELECT * FROM `videos`;");
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
        $deleted_video = $conn->prepare("DELETE FROM `videos` WHERE id = ? ;");
        $deleted_video->bind_Param('i', $id);
        if ($deleted_video->execute()) {
            return 1;
        } else {
            return 0;
        }
    }

    public static function delete_by_event_id($id)
    {
        // return 0 or 1
        $instance = ConnectionDb::getInstance();
        $conn = $instance->getConnection();
        $deleted_video = $conn->prepare("DELETE FROM `videos` WHERE event_id = ? ;");
        $deleted_video->bind_Param('i', $id);
        if ($deleted_video->execute()) {
            return 1;
        } else {
            return 0;
        }
    }
}
