<?php
require_once('../../connections.php');
if (isset($_POST['add_event'])) {
    $title = $_POST['title'];
    $presenter = $_POST['presenter_name'];
    $coor_id = $_POST['coordinator_id'];
    $start_date = $_POST['start_date'];
    $descrip  = $_POST['description'];
    $stmt = $conn->prepare("INSERT INTO `events`( `title`, `presenter_name`, `coordinator_id`, `start_date`, `description`)
         VALUES (?,?,?,?,?);");
    if (!$stmt) {
        $data =  "SQL Error";
    }
    $stmt->bind_param("ssiss", $title, $presenter, $coor_id, $start_date, $descrip);
    if (!$stmt->execute()) {
        $data =  "SQL Error";
    }
    echo $data;
}

if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $stmt = $conn->prepare("DELETE FROM events WHERE `id` = $id");
    $stmt->execute();
    $data = $id;
    echo $data;
}

//---------------------- VIDEOS -------------------------------

if (isset($_POST['add_video'])) {
    $video_title = $_POST['title'];
    $video_url = $_POST['url'];
    $event_id = $_POST['event_id'];
    $video_des  = $_POST['description'];
    $stmt = $conn->prepare("INSERT INTO `videos`( `title`, `url`, `event_id`, `description`) 
        VALUES (?,?,?,?);");
    if (!$stmt) {
        $data =  "SQL Error";
    }
    $stmt->bind_param("ssis", $video_title, $video_url, $event_id, $video_des);
    if (!$stmt->execute()) {
        $data =  "SQL Error";
    }
    // echo $data;
}

if (isset($_POST['delete_videos'])) {
    $id = $_POST['id'];
    $stmt = $conn->prepare("DELETE FROM videos WHERE `id` = $id");
    $stmt->execute();
    $data = $id;
    //echo $data;
}

if (isset($_POST['get'])) {
    $id = $_POST['id'];
    $column = $_POST['column'];
    $result = $conn->query("SELECT $column FROM `events` WHERE `id` = $id");
    $data = $result->fetch_assoc();
    echo $data[$column];
}


if (isset($_POST['set'])) {
    $column = $_POST['column'];
    $data = $_POST['data'];
    $id = $_POST['id'];
    $conn->query("UPDATE `events` SET $column = '$data' WHERE `id` = $id");
    echo $data;
}


if (isset($_POST['get_video'])) {
    $id = $_POST['id'];
    $column = $_POST['column'];
    $result = $conn->query("SELECT $column FROM `videos` WHERE `id` = $id");
    $data = $result->fetch_assoc();
    echo $data[$column];
}


if (isset($_POST['set_video'])) {
    $column = $_POST['column'];
    $data = $_POST['data'];
    $id = $_POST['id'];
    $conn->query("UPDATE `videos` SET $column = '$data' WHERE `id` = $id");
    echo $data;
}
