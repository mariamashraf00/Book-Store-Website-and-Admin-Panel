<?php
	session_start();
  $title = "Change Password";
  require_once "header.php";
  require_once "classes/customer.php";
  if(isset($_SESSION['username'])){
    $customer = Customer::retrieve_by_username($_SESSION['username']);
  }
?>

<br>
<div class="container col-md-4 col-md-offset-4">
    <h2 class="text-center"> Change Password</h2>
    <?php 
      $fullurl="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    if(strpos($fullurl,"changepass=empty")==true){
		echo '<div class="text-center alert alert-danger" role="alert">
		Please Fill In The Missing Fields
	  </div>';
    }
    if(strpos($fullurl,"changepass=wrongpass")==true){
		echo '<div class="text-center alert alert-danger" role="alert">
		Wrong Password
	  </div>';
    }
        if(strpos($fullurl,"changepass=match")==true){
          echo '<div class="text-center alert alert-danger" role="alert">
          Passwords do not match
          </div>';
          }
          if(strpos($fullurl,"changepass=done")==true){
            echo '<div class="text-center alert alert-success" role="alert">
            Password Updated
            </div>';
            session_start();
            unset($_SESSION['customer']);
            unset($_SESSION['username']);
	header("Location: signin.php");
            }
    ?>
<form method="post" action="changepasscheck.php">
    <div class="form-group">
      <label for="oldpass">Old Password</label>
      <input required type="password" class="form-control" id="oldpass" name="oldpass">
    </div>
    
    <div class="form-group">
      <label for="newpass">New Password</label>
      <input  required type="password" class="form-control" id="newpass" name="newpass">
    </div>
    <div class="form-group">
      <label for="newpass1">Confirm New Password</label>
      <input required type="password" class="form-control" id="newpass1" name="newpass1">
    </div>
  <div class="text-center">
  <button type="submit" class="btn btn-primary">Save Changes</button>
</div>
  <br>
</form>
</div>

</body>