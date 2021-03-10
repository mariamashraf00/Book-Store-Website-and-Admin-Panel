<?php
	session_start();
	unset($_SESSION['customer']);
	unset($_SESSION['username']);
	header("Location: index.php");
?>