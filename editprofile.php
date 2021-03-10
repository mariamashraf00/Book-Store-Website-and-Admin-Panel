<?php
	session_start();
  $title = "Edit Profile";
  require_once "header.php";
  require_once "classes/customer.php";
  if(isset($_SESSION['username'])){
    $customer = Customer::retrieve_by_username($_SESSION['username']);
  }
?>

<br>
<div class="container col-md-4 col-md-offset-4">
    <h2 class="text-center"> Edit Profile</h2>
    <?php
  $fullurl="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
 if(strpos($fullurl,"editprofile=empty")==true){
 echo '<div class="text-center alert alert-danger" role="alert">
 Please Fill In The Missing Fields
 </div>';
 }
 if(strpos($fullurl,"editprofile=invalidemail")==true){
  echo '<div class="text-center alert alert-danger" role="alert"
  Invalid Email
  </div>';
  }
  if(strpos($fullurl,"editprofile=emailtaken")==true){
		echo '<div class="text-center alert alert-danger" role="alert">
		Email Taken by another user
	  </div>';
    }
    if(strpos($fullurl,"editprofile=done")==true){
      echo '<div class="text-center alert alert-success" role="alert">
      Changes Applied
      </div>';
      }
    ?> 
<form method="post" action="editprofilecheck.php">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="FirstName">First Name</label>
      <input type="text" class="form-control" id="FirstName" name="FirstName" value="<?php echo $customer['first_name']?>">
    </div>
    <div class="form-group col-md-6">
      <label for="LastName">Last Name</label>
      <input type="text" class="form-control" id="LastName" name="LastName" value="<?php echo $customer['last_name']?>">
    </div>
    
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="UserName">User Name</label>
      <input type="text" class="form-control" id="UserName" name="UserName" value="<?php echo $customer['username']?>" disabled>
    </div>
    <div class="form-group col-md-6">
      <label for="e-mail">E-mail</label>
      <input type="email" class="form-control" id="e-mail" name="e-mail" value="<?php echo $customer['email']?>">
    </div>
</div>

  <div class="form-group">
    <label for="Address">Address</label>
    <input type="text" class="form-control" id="Address" name="Address" value="<?php echo $customer['address']?>">
  </div>
  <div class="form-group">
    <label for="PhoneNum">Phone Number</label>
    <input type="text" class="form-control" pattern="[0-9]{11}" id="PhoneNum" name="PhoneNum" value="<?php echo $customer['phone_number']?>">
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="City">City</label>
      <input type="text" class="form-control" id="City" name="City" value="<?php echo $customer['city']?>">
    </div>
    <div class="form-group col-md-6">
      <label for="Zip">Zip</label>
      <input type="text" class="form-control" pattern="[0-9]{5}" id="Zip" name="Zip" value="<?php echo $customer['zipcode']?>">
    </div>
  </div>
  <div class="text-center">
  <button type="reset" class="btn btn-primary">Cancel</button>
  <button type="submit" class="btn btn-primary">Save Changes</button>
</div>
  <br>

</form>
</div>

</body>