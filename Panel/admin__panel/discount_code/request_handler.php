<?php 
require_once ('../../connections.php');
require_once '../../classes/discount_codes.php';

if (isset($_POST['add_code'])) {
    $data = 2;
    $code = $_POST['code'];
    $precentages = $_POST['percentage'];
    $start = $_POST['start_date'];
    $end  =$_POST['expiry_date']; 

    $test = DiscountCodes::check_by_code($code);
    if ($test->num_rows > 0) {
        echo 0;
        die();
    }

    $stmt_code = $conn->prepare("INSERT INTO `disount_codes`(`code`, `percentage`,`start_date`,`expiry_date`) VALUES (?,?,?,?);");
    if (!$stmt_code){
        $data = 1;
    }
    $stmt_code->bind_param("siss",$code,$precentages,$start,$end);
    if(!$stmt_code->execute()){
        $data =  1;
    }
    echo $data;
}

if (isset($_POST['delete_codes'])) {
    $id = $_POST['code'];
    $data = 2;
    $stmt=$conn->prepare("DELETE FROM disount_codes WHERE `code` = '$id';");

    if (!$stmt->execute()){
        $data = 0;
    }
    $data = $id;
    echo $data;
}



if (isset($_POST['get_code'])) {
    $id = $_POST['code'];
    $column = $_POST['column'];
    $result = $conn->query("SELECT * FROM `disount_codes` WHERE `code` = '$id';");
    $data = $result->fetch_assoc();
    echo $data[$column];
}


if (isset($_POST['set_code'])) {
    $column = $_POST['column'];
    $data = $_POST['data'];
    $id = $_POST['code'];
    $test = $conn->query("UPDATE `disount_codes` SET $column = '$data' WHERE `code` = '$id' ;");
    if(!$test) {
        echo 0;
        die();
    }
    echo $data;
}
