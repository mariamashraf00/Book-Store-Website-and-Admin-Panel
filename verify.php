<?php
	session_start();
    require_once "classes/customer.php";
    $title = "Verify";
	$name = $_POST['InName'];
    $pass = $_POST['InPassword'];

	if(empty($name) || empty($pass)){
		header("Location:signin.php?signin=empty");
    }
    else
    { 
            $user = Customer::retrieve_by_username($name); 
            if ($user==0)
            {
                header("Location:signin.php?signin=notfound");   
            }
            else if ((password_verify($pass,$user['password']))==false)
            {
                header("Location:signin.php?signin=wrongpass");   
            }
            else {
                $_SESSION['customer'] = true;	
                $_SESSION['username'] = $name;
                header("Location: index.php");
            }
    }

	
?>