<?php
	session_start();
	$title = "Update";
    require_once "classes/customer.php";
		$firstname = $_POST['FirstName'];
        $lastname = $_POST['LastName'];
        $username = $_SESSION['username'];
        $email=$_POST['e-mail'];
        $address = $_POST['Address'];
        $phone=$_POST['PhoneNum'];
        $city=$_POST['City'];
        $zip=$_POST['Zip'];
        $customer=Customer::retrieve_by_username($username);


		if(empty($firstname) || empty($lastname) || empty($email) || empty($address)||empty($city)||empty($zip)||empty($phone)){
				header("Location:editprofile.php?editprofile=empty");
        }
        else if (!filter_var($email,FILTER_VALIDATE_EMAIL)){
				header("Location:editprofile.php?editprofile=invalidemail");
        }
        else if(Customer::retrieve_by_email($email)!=0 && Customer::retrieve_by_email($email)['username']!=$username )
        {
            header("Location:editprofile.php?editprofile=emailtaken");

        }

        else{
            Customer:: update(
        $username,
        $firstname,
        $lastname,
        $customer['password'],
        $email,
        $address,
        $city,
        $zip,
        $phone
    ) ;
    header("Location:editprofile.php?editprofile=done");

        }
        
?>
	











