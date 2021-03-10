<?php
require_once('../../connections.php');

if (isset($_POST['manager'])) {
    $id = $_POST['manager'];
    $stmt = $conn->prepare("DELETE FROM managers WHERE `id` = $id");
    $stmt->execute();
    $data = $id;
    echo $data;
}

if (isset($_POST['clerk'])) {
    $id = $_POST['clerk'];
    $stmt = $conn->prepare("DELETE FROM data_entry_clerks WHERE `id` = $id");
    $stmt->execute();
    $data = $id;
    echo $data;
}

if (isset($_POST['cord'])) {
    $id = $_POST['cord'];
    $stmt = $conn->prepare("DELETE FROM event_coordinators WHERE `id` = $id");
    $stmt->execute();
    $data = $id;
    echo $data;
}
