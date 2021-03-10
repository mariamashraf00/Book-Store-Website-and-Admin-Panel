<?php
	session_start();
	$title = "Update Pass";
    require_once "classes/managers.php";
    require_once "classes/data_entry_clerk.php";
    require_once "classes/event_coordinators.php";

        $email=$_SESSION['email'];
        $oldpass=$_POST['oldpass'];
        $newpass=$_POST['newpass'];
        $newpass1=$_POST['newpass1'];
        if (isset($_SESSION['manager']))
        $user=Manager::retrieve_by_email($email);
        else if (isset($_SESSION['clerk']))
        $user=Clerk::retrieve_by_email($email);
        else if (isset($_SESSION['cord']))
        $user=Coordinator::retrieve_by_email($email);



		if(empty($newpass1)||empty($newpass)||empty($oldpass)){
				header("Location:changepass.php?changepass=empty");
        }
        else if (password_verify($oldpass,$user['password'])==false){
				header("Location:changepass.php?changepass=wrongpass");
        }
        else if($newpass!=$newpass1 )
        {
            header("Location:changepass.php?changepass=match");

        }

        else{
            if (isset($_SESSION['manager']))
        Manager::update_password_by_email($email, password_hash($newpass, PASSWORD_DEFAULT));
        else if (isset($_SESSION['clerk']))
        Clerk::update_password_by_email($email, password_hash($newpass, PASSWORD_DEFAULT));
        else if (isset($_SESSION['cord']))
        Coordinator::update_password_by_email($email, password_hash($newpass, PASSWORD_DEFAULT));
    header("Location:changepass.php?changepass=done");

        }
        
?>
	











