<?php
	session_start();
	$title = "Reset Pass";
    require_once "classes/customer.php";

        $newpass=$_POST['newpass2'];
        $newpass1=$_POST['newpass3'];
        $token=$_POST['token'];

		if(empty($newpass1)||empty($newpass)){

                $url="resetpassword.php?t=".$token."&resetpassword=empty";
				header("Location:".$url);
        }
        else if($newpass!=$newpass1 )
        {
            $url="resetpassword.php?t=".$token."&resetpassword=match";
            header("Location:".$url);

        }

        else{
           
            $customer=Customer::retrieve_by_token($token);
            $hashed_password = password_hash($newpass, PASSWORD_DEFAULT);
            Customer:: update_password_by_email($customer['email'], $hashed_password);
            Customer::delete_by_token($token);
            $url="resetpassword.php?t=".$token."&resetpassword=done";
            header("Location:".$url);

        }
        
?>
	











