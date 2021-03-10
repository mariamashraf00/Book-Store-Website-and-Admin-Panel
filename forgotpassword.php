<?php
  $title = "Forgot Password";
  require_once "header.php";
?>

<br>
<div class="container col-md-4 col-md-offset-4">
    <h2 class="text-center"> Forgot Password</h2>
    <?php
 $fullurl="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
 if(strpos($fullurl,"forgotpassword=empty")==true){
 echo '<div class="text-center alert alert-danger" role="alert">
 Please Fill In The Missing Fields
 </div>';
 }
 if(strpos($fullurl,"forgotpassword=wrong")==true){
    echo '<div class="text-center alert alert-danger" role="alert">
    E-mail does not exist.
    </div>';
    }
    ?>
<form method="post" action="sendemail.php">
    <div class="form-group">
      <label for="inemail">Please Enter Your E-mail</label>
      <input type="text" class="form-control" id="inemail" name="inemail" placeholder="E-mail...">
<br>
  <div class="text-center">
  <button type="submit" class="btn btn-primary">Send e-mail</button>
</div>
<br>

  <br>
</form>
</div>

</body>