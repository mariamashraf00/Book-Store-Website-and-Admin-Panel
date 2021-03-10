<?php
    session_start();
    $title = "Shopping Cart";
    require_once "classes/Books.php";
    require_once "classes/order_items.php";
    require_once "classes/orders.php";
    require_once "classes/author.php";
    require_once "classes/customer.php";
    require_once "header.php";
    $price = 0.0;
    $amount=0;
    
    if(isset($_POST['bookisbn']))
    {
        $book_isbn = $_POST['bookisbn'];
    }
    if(isset($book_isbn)){
		if(!isset($_SESSION['cart'])){
			$_SESSION['cart'] = array();
			$_SESSION['qty'] = 0;
			$_SESSION['price'] = 0.00;
		}

        if(!isset($_SESSION['cart'][$book_isbn]))
        {
			$_SESSION['cart'][$book_isbn] = 1;
        } 
        elseif(isset($_POST['cart'])){
			$_SESSION['cart'][$book_isbn]++;
			unset($_POST);
		}
	}

    if(isset($_POST['save'])){
		foreach($_SESSION['cart'] as $isbn =>$qty){
			if($_POST[$isbn] == '0'){
				unset($_SESSION['cart']["$isbn"]);
			} else {
 $thisbook=Books::retrive_by_isbn($isbn);
                if ($_POST["$isbn"]<=$thisbook['copies'])
                $_SESSION['cart']["$isbn"] = $_POST["$isbn"];
                else $_SESSION['cart']["$isbn"] = $thisbook['copies'];		
			}
		}
    }

    if(isset($_SESSION['cart']))
    { if((array_count_values($_SESSION['cart'])))
        {
        foreach($_SESSION['cart'] as $isbn => $qty)
        {
            $book= Books::retrive_by_isbn($isbn);
              $bookprice = $book['price'];
              if($bookprice){
                  $price += $bookprice * $qty;
              }
            }
        $_SESSION['price'] = $price;
        
        foreach($_SESSION['cart'] as $isbn => $qty)
        {
            $amount += $qty;
        }
        $_SESSION['qty'] = $amount;
    }
    else {
        $_SESSION['price']=0.0;
        $_SESSION['qty']=0;        
    }
    }
    
    ?>
<br>
<h2 class="text-center">Your Cart</h2>
<br><br>
<div class="container">
<?php
if ((!isset($_SESSION['price'])  && !isset($_SESSION['qty'])) || ($_SESSION['price']==0 && $_SESSION['qty']==0))
{
echo '<div class="alert alert-info" role="alert">
Your Cart Is Empty, Shop For Books first.
</div>';
}   
else { ?>     
   	<form action="cart.php" method="post">
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
				<td><input type="number" value="<?php echo $qty; ?>" style="width: 50px;" name="<?php echo $isbn; ?>"></td>
				<td><?php echo $qty * $book['price']; ?> L.E</td>
			</tr>
            <?php } ?>
            <tr>
		    	<th>Order Summary</th>
		    	<th>&nbsp;</th>
		    	<th><?php echo $_SESSION['qty']; ?></th>
		    	<th><?php echo $_SESSION['price']; ?> L.E</th>
		    </tr>
	   	</table>
		   <button type="submit" class="btn btn-primary" name="save">Save Cart</button>
	  
	</form>
	<br/>
    <a href="checkout.php" class="btn btn-primary">Checkout</a> 
	<a href="books.php" class="btn btn-primary">Continue Shopping</a>
<?php }?>

	<?php if (isset($_SESSION['customer']))
{
    $history=Customer::retrieve_history_by_username($_SESSION['username']);
    if(mysqli_num_rows($history)!=0){?>
        <br><h2 class="text-center">Your Purchase History</h2><table class="table">
        <tr>
            <th>Item</th>
            <th>Quantity</th>
           <th>Date</th>
        </tr>
        <?php
        for($i = 0; $i < mysqli_num_rows($history); $i++){
			
			while($query_row = mysqli_fetch_assoc($history)){?>

				<tr>
				<td>
                <a href="book.php?bookisbn=<?php echo $query_row['isbn'];?>">
				<img class="img-thumbnail" style="width: 50px;" src="<?php echo $query_row['image'];?>"> 
                </a>
                &nbsp; <?php echo $query_row['title']; ?>
				</td>
				<td>
				<?php echo $query_row['amount'];?>
				</td>
				<td>
				<?php echo $query_row['date'];?>
				</td>
				</tr>
                <?php
			}
        }
        ?>
		</table>
        <?php
    }

}
?>
</div>

</body>
