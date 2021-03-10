<?php
	session_start();
	$title = "Register";
    require_once "classes/customer.php";

		$firstname = $_POST['FirstName'];
        $lastname = $_POST['LastName'];
        $username = $_POST['UserName'];
        $password = $_POST['Password'];
        $password2=$_POST['Password2'];
        $email=$_POST['e-mail'];
        $address = $_POST['Address'];
        $phone=$_POST['PhoneNum'];
        $city=$_POST['City'];
        $zip=$_POST['Zip'];
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

		if(empty($firstname) || empty($lastname) || empty($username)||empty($password)||empty($password2)|| empty($email) || empty($address)||empty($city)||empty($zip)||empty($phone)){
				header("Location:signup.php?signup=empty");
        }
        else if (!filter_var($email,FILTER_VALIDATE_EMAIL)){
				header("Location:signup.php?signup=invalidemail");
        }
        else if(Customer::retrieve_by_username($username)!=0)
        {
            header("Location:signup.php?signup=nametaken");

        }
        else if(Customer::retrieve_by_email($email)!=0)
        {
            header("Location:signup.php?signup=emailtaken");

        }
        else if($password!=$password2){
            header("Location:signup.php?signup=match");


        }
        else{
            Customer::insert($username,
            $firstname,
            $lastname,
            $hashed_password,
            $email,
            $address,
            $city,
            $zip,
            $phone);
            header("Location: signin.php");

        }
        
?>
	











