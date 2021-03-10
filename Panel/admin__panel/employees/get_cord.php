<?php
require '../../connections.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $result = $conn->query("SELECT * FROM `event_coordinators` WHERE `id` = $id");
    $data = $result->fetch_assoc();
    echo json_encode($data );
}