<?php
require_once '../../connections.php';
require_once '../../classes/data_entry_clerk.php';
require_once '../../classes/event_coordinators.php';
require_once '../../classes/managers.php';

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$tel = $_POST['tel'];
$manager_id = $_POST['manager_id'];
$password = password_hash($_POST['pass'], PASSWORD_DEFAULT);


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
    echo "<script> alert('Email already exists!'); window.location.replace('employees.php') </script>";
    die();
}

$test = Manager::check_by_phone($tel);
if ($test->num_rows > 0) {
    echo "<script> alert('Phone number already exists!'); window.location.replace('employees.php') </script>";
    die();
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



$result = $conn->query("INSERT INTO `data_entry_clerks`(`first_name`, `last_name`, `email`, `phone_number`, `direct_manager_id`,`password`) VALUES ('$fname','$lname','$email','$tel',$manager_id,'$password')");

if (!$result) {
    echo "<script> alert('DB Error!'); window.location.replace('employees.php') </script>";
    die();
}

header('location: employees.php');
