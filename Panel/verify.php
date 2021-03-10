<?php
	session_start();
    require_once "classes/managers.php";
    require_once "classes/data_entry_clerk.php";
    require_once "classes/event_coordinators.php";

    $title = "Verify";
	$email = $_POST['username'];
    $pass = $_POST['password'];

	if(empty($email) || empty($pass)){
		header("Location:index.php?index=empty");
    }
    else
    { 
            $manager = Manager::retrieve_by_email($email);
            $clerk=Clerk::retrieve_by_email($email);
            $cord = Coordinator::retrieve_by_email($email);

            if ($manager!=0)
            {
                if (password_verify($pass,$manager['password'])==false)
                {
                header("Location:index.php?index=wrongpass"); 
                }
                else {  $_SESSION['manager'] = true;	
                    $_SESSION['email'] = $email;
                    header("Location: admin_panel.php");}  

            }
            else if ($clerk!=0)
            {
                if (password_verify($pass,$clerk['password'])==false)
                header("Location:index.php?index=wrongpass"); 
                else{  $_SESSION['clerk'] = true;	
                    $_SESSION['email'] = $email;
                    header("Location: admin_panel.php");}  

            }
           else if ($cord!=0)
            {
                if (password_verify($pass,$coord['password']))
                header("Location:index.php?index=wrongpass");  
                else{  $_SESSION['cord'] = true;	
                    $_SESSION['email'] = $email;
                    header("Location: admin_panel.php");} 

            }
            else
            {
                header("Location:index.php?index=notfound");  

            }
    }

	
?>
