<?php
  $title = "Sign Up";
  require_once "header.php";
?>

<br>
<div class="container col-md-4 col-md-offset-4">
    <h2 class="text-center"> Sign Up</h2>
        <p class="text-center"> Already have an account? <a href="signin.php">Sign In</a></p> 
        <?php 
      $fullurl="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    if(strpos($fullurl,"signup=empty")==true){
		echo '<div class="text-center alert alert-danger" role="alert">
		Please Fill In The Missing Fields
	  </div>';
    }
    if(strpos($fullurl,"signup=invalidemail")==true){
		echo '<div class="text-center alert alert-danger" role="alert">
		Enter A Valid E-mail Adress
	  </div>';
    }
    if(strpos($fullurl,"signup=nametaken")==true){
      echo '<div class="text-center alert alert-danger" role="alert">
      Username Already Taken
      </div>';
      }
      if(strpos($fullurl,"signup=emailtaken")==true){
        echo '<div class="text-center alert alert-danger" role="alert">
        E-mail Already Taken
        </div>';
        }
        if(strpos($fullurl,"signup=match")==true){
          echo '<div class="text-center alert alert-danger" role="alert">
          Passwords do not match
          </div>';
          }
    ?>
<form method="post" action="register.php">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="FirstName">First Name</label>
      <input required type="text" class="form-control" id="FirstName" name="FirstName" placeholder="First Name...">
    </div>
    <div class="form-group col-md-6">
      <label for="LastName">Last Name</label>
      <input required type="text" class="form-control" id="LastName" name="LastName" placeholder="Last Name...">
    </div>
    
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="UserName">User Name</label>
      <input required type="text" class="form-control" id="UserName" name="UserName" placeholder="User Name...">
    </div>
    <div class="form-group col-md-6">
      <label for="e-mail">E-mail</label>
      <input required type="text" class="form-control" id="e-mail" name="e-mail" placeholder="E-mail...">
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
      <label for="Password">Password</label>
      <input required type="password" class="form-control" id="Password" name="Password" placeholder="Password...">
    </div>
    <div class="form-group col-md-6">
      <label for="Password2">Confirm Password</label>
      <input required type="password" class="form-control" id="Password2" name="Password2" placeholder="Confirm Password...">
    </div>
</div>

  <div class="form-group">
    <label for="Address">Address</label>
    <input required type="text" class="form-control" id="Address" name="Address" placeholder="Building Num, Street Name...">
  </div>
  <div class="form-group">
    <label for="PhoneNum">Phone Number</label>
    <input required type="text" class="form-control" pattern="[0-9]{11}" id="PhoneNum" name="PhoneNum" placeholder="0111111111">
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="City">City</label>
      <input required type="text" class="form-control" id="City" name="City">
    </div>
    <div class="form-group col-md-6">
      <label for="Zip">Zip</label>
      <input required type="text" class="form-control" pattern="[0-9]{5}" id="Zip" name="Zip">
    </div>
  </div>
  <div class="text-center">
  <button type="submit" class="btn btn-primary">Sign Up</button>
</div>
  <br>
  
</form>
</div>

</body>