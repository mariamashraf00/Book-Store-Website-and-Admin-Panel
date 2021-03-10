<?php
	session_start();
  $title = "Reset Password";
  require_once "header.php";
  require_once "classes/customer.php";
  $token=$_GET['t'];  
?>

<br>
<div class="container col-md-4 col-md-offset-4">
    <h2 class="text-center"> Reset Password</h2>
    <?php 
      $fullurl="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
      
    if(strpos($fullurl,"resetpassword=empty")==true){
		echo '<div class="text-center alert alert-danger" role="alert">
		Please Fill In The Missing Fields
	  </div>';
    }
        if(strpos($fullurl,"resetpassword=match")==true){
          echo '<div class="text-center alert alert-danger" role="alert">
          Passwords do not match
          </div>';
          }
           if(strpos($fullurl,"resetpassword=done")==true)
          {
            echo '<div class="text-center alert alert-success" role="alert">
            Password Updated <a href="signin.php">Sign In </a>
            </div>';
          }
          else{
            ?>
<form method="post" action="resetpasscheck.php">
    <div class="form-group">
      <label for="newpass2">New Password</label>
      <input required type="password" class="form-control" id="newpass2" name="newpass2">
    </div>
    <div class="form-group">
      <label for="newpass3">Confirm New Password</label>
      <input required type="password" class="form-control" id="newpass3" name="newpass3">
    </div>
    <input type="text" class="form-control" id="token" name="token" value="<?php echo $token ?>" hidden>
  <div class="text-center">
  <button type="submit" class="btn btn-primary">Reset</button>
</div>
  <br>
</form>
</div>
<?php }?>

</body>