<?php
	session_start();
  $title = "Change Password";
  require_once "header.php";
  
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
    ?>
<form method="post" action="changepasscheck.php">
    <div class="form-group">
      <label for="oldpass">Old Password</label>
      <input type="password" class="form-control" id="oldpass" name="oldpass">
    </div>
    
    <div class="form-group">
      <label for="newpass">New Password</label>
      <input type="password" class="form-control" id="newpass" name="newpass">
    </div>
    <div class="form-group">
      <label for="newpass1">Confirm New Password</label>
      <input type="password" class="form-control" id="newpass1" name="newpass1">
    </div>
  <div class="text-center">
  <button type="submit" class="btn btn-primary">Save Changes</button>
</div>
  <br>
</form>
</div>
</body>