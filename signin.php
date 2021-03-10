<?php
  $title = "Sign In";
  require_once "header.php";
?>

<br>
<div class="container col-md-4 col-md-offset-4">
    <h2 class="text-center"> Sign In</h2>
        <p class="text-center"> Don't Have An Account? <a href="signup.php">Sign Up</a></p> 
        <p class="text-center"><a href="forgotpassword.php">Forgot Password ?</a></p> 
        <?php 
 $fullurl="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
 if(strpos($fullurl,"signin=empty")==true){
 echo '<div class="text-center alert alert-danger" role="alert">
 Please Fill In The Missing Fields
 </div>';
 }
 if(strpos($fullurl,"signin=notfound")==true){
  echo '<div class="text-center alert alert-danger" role="alert">
  User Name Not Found <a href="signup.php">Sign Up</a> First
  </div>';
  }
  if(strpos($fullurl,"signin=wrongpass")==true){
		echo '<div class="text-center alert alert-danger" role="alert">
		Wrong Password
	  </div>';
    }
    ?>
<form method="post" action="verify.php">
    <div class="form-group">
      <label for="InName">UserName</label>
      <input required type="text" class="form-control" id="InName" name="InName" placeholder="UserName...">
    </div>
    <div class="form-group">
      <label for="InPassword">Password</label>
      <input required type="password" class="form-control" id="InPassword" name="InPassword" placeholder="Password...">
    </div>


  <div class="text-center">
  <button type="submit" class="btn btn-primary">Sign In</button>
</div>
<br>

  <br>
</form>
</div>

</body>
