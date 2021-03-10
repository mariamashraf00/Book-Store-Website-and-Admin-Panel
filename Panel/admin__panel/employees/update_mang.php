<?php
require_once '../../connections.php';
require_once '../../classes/data_entry_clerk.php';
require_once '../../classes/event_coordinators.php';
require_once '../../classes/managers.php';


$id = $_POST['cid'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$tel = $_POST['tel'];

$test = Clerk::check_by_email($email);
if ($test->num_rows > 0) {
    echo "<script> alert('Email already exists!'); window.location.replace('employees.php') </script>";
    die();
}

$test = Clerk::check_by_phone($tel);
if ($test->num_rows > 0) {
    echo "<script> alert('Phone number already exists!'); window.location.replace('employees.php') </script>";
    die();
}

$test = Manager::check_by_email($email);
if ($test->num_rows > 0) {
    $row = $test->fetch_assoc();
    if ($row['id'] != $id) {
        echo "<script> alert('Email already exists!'); window.location.replace('employees.php') </script>";
        die();
    }
}

$test = Manager::check_by_phone($tel);
if ($test->num_rows > 0) {
    $row = $test->fetch_assoc();
    if ($row['id'] != $id) {
        echo "<script> alert('Phone number already exists!'); window.location.replace('employees.php') </script>";
        die();
    }
}

$test = Coordinator::check_by_email($email);
if ($test->num_rows > 0) {
    echo "<script> alert('Email already exists!'); window.location.replace('employees.php') </script>";
    die();
}

$test = Coordinator::check_by_phone($tel);
if ($test->num_rows > 0) {
    echo "<script> alert('Phone number already exists!'); window.location.replace('employees.php') </script>";
    die();
}



$result = $conn->query("UPDATE `managers` SET `first_name`='$fname',`last_name`='$lname',`email`='$email',`phone_number`='$tel' WHERE id = $id");

if (!$result) {
    echo "<script> alert('DB Error!'); window.location.replace('employees.php') </script>";
    die();
}


header('location: employees.php');
