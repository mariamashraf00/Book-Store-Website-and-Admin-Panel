<?php
	session_start();
    $title = "Check Out";
    require_once "classes/Books.php";
    require_once "classes/order_items.php";
    require_once "classes/orders.php";
    require_once "classes/author.php";
    require_once "classes/discount_codes.php";
    require_once "header.php";
    $new_price=0;
?>
<br>
<h2 class="text-center">Checkout</h2>
<br><br>
<div class="container">
<?php
if(!isset($_SESSION['customer'])){
    echo '<div class="alert alert-danger" role="alert">
    You Need to <a href="signin.php">Signin</a> First! 
  </div>';
}
else {
    $customer=Customer::retrieve_by_username($_SESSION['username']);
	
 if (!isset($_SESSION['cart']))
    {
      header("Location: index.php");
    }
	
if(isset($_SESSION['cart']))  
   {
      if ($_SESSION['price']==0.0 && $_SESSION['qty']==0)
{
echo '<div class="alert alert-info" role="alert">
Your Cart Is Empty, Shop For Books first.
</div>';
}   
else if ((array_count_values($_SESSION['cart']))) 
{
  if (isset($_POST['remove']))
  { 
      unset($_POST['discount']);
    echo '<div class="alert alert-warning" role="alert">
     Code Removed
    </div>'; 
  }

  else
  {
    if (isset($_POST['apply']))
    {
     if (isset($_POST['discount']))
     {
        if (!empty($_POST['discount']))
        {
         $code=DiscountCodes::retrieve_by_code($_POST['discount']);
         if ($code==0 )
         {

        echo '<div class="alert alert-warning" role="alert">
        Code does not exist
        </div>';   
         }
         else if (date("Y-m-d h:i:sa")>=$code['expiry_date'])
         {
        echo '<div class="alert alert-warning" role="alert">
        Code Expired.
        </div>';
        }
        else {
        echo '<div class="alert alert-success" role="alert">
        Code Applied.
        </div>';
         $new_price=$_SESSION['price']-($_SESSION['price']*$code['percentage']/100);
        }
     }
   }
 }
    }



     ?>
	<table class="table">
		<tr>
			<th>Item</th>
			<th>Price</th>
	    	<th>Quantity</th>
	    	<th>Total</th>
	    </tr>
	    	<?php
			    foreach($_SESSION['cart'] as $isbn => $qty){
					$book = Books::retrive_by_isbn($isbn);
                    $author = Author::retrieve_by_id($book['author_id']);
			?>
		<tr>
        <td><img class="img-thumbnail" style="width: 50px;" src="<?php echo $book['image']; ?>"><?php echo $book['title'] ?> by <?php echo $author['name'] ?> </td>
			<td><?php echo $book['price']; ?> L.E</td>
			<td><?php echo $qty; ?></td>
			<td><?php echo $qty * $book['price']; ?> L.E</td>
		</tr>
		<?php } ?>
		<tr>
			<th>Order Summary</th>
			<th>&nbsp;</th>
			<th><?php echo $_SESSION['qty']; ?></th>
			<th><?php if ($new_price==0)echo $_SESSION['price']; else echo $new_price; ?> L.E</th>
		</tr>
        <tr>
			<th>&nbsp;</th>
            
            <form method="post" action="checkout.php" class="form-horizontal">
			<th><input type="text" placeholder="Discount Code..." name="discount"> </th>
			<th><input type="submit" name="apply" value="Apply Code" class="btn btn-primary"></th>
      <th><input type="submit" name="remove" value="Remove Code" class="btn btn-danger"></th>
            </form>
		</tr>
	</table>
			
        <br>
        <h3> Shipping Details</h3>
        <table class="table">
            <tr>
              <td>Address:</td>
              <td><?php echo $customer['address']; ?></td>
            </tr>
            <tr>
              <td>City:</td>
              <td><?php echo $customer['city']; ?></td>
            </tr>
            <tr>
              <td>Zip Code:</td>
              <td><?php echo $customer['zipcode']; ?></td>
            </tr>
            <tr>
              <td>Phone Number:</td>
              <td><?php echo $customer['phone_number']; ?></td>
            </tr>
          </table>
        <h6> To change these details <a href='editprofile.php'> edit your profile </a></h6>
        <br>
        <form method="post" action="placeorder.php" class="form-horizontal">
			<div class="form-group" style="margin-left:0px">
             <input type="text" name="code" value="<?php 
             if (isset($_POST['discount']))
             {
             echo $_POST['discount'];
             }
             else echo 0;
              ?>" hidden>            
				<input type="submit" name="submit" value="Place Order" class="btn btn-primary" >
        <a href="cart.php" class="btn btn-primary">Edit Cart</a> 

			</div>
		</form>

        <?php }
    }
}?>

    </body>
