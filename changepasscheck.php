<?php
	session_start();
	$title = "Update Pass";
    require_once "classes/customer.php";

        $username=$_SESSION['username'];
        $customer=Customer::retrieve_by_username($username);
        $oldpass=$_POST['oldpass'];
        $newpass=$_POST['newpass'];
        $newpass1=$_POST['newpass1'];


		if(empty($newpass1)||empty($newpass)||empty($oldpass)){
				header("Location:changepass.php?changepass=empty");
        }
        else if (password_verify($oldpass,$customer['password'])){
            header("Location:changepass.php?changepass=wrongpass");
        }
        else if($newpass!=$newpass1 )
        {
            header("Location:changepass.php?changepass=match");

        }

        else{
            $hashed_password = password_hash($newpass, PASSWORD_DEFAULT);
            Customer:: update_password_by_email($customer['email'], $hashed_password);
    header("Location:changepass.php?changepass=done");

        }
        
?>
	











