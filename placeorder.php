<?php
	session_start();
    $title = "Order Placed";
    require_once "classes/Books.php";
    require_once "classes/order_items.php";
    require_once "classes/orders.php";
    require_once "classes/author.php";
    require_once "classes/discount_codes.php";
    require_once "header.php";
    ?>
    <div class="container">
<br>
<?php
if (!isset($_SESSION['cart']))
{
  header("Location: index.php");
}
	    
if (isset($_SESSION['cart']))
{
    $customer=Customer::retrieve_by_username($_SESSION['username']);

    $customer_username=$_SESSION['username'];

    $date = date("Y-m-d H:i:s");

    if ($_POST['code']==0)
    {
        Order::insert($customer_username, $date, $_SESSION['price'], NULL);
    }

    else 
    {
        $code=DiscountCodes::retrieve_by_code($_POST['code']);
        $disount_code=$code['code'];
        $total_price=$_SESSION['price']-($_SESSION['price']*$code['percentage']/100);
        Order::insert($customer_username, $date, $total_price, $disount_code);
    }
    

    $order = Order::retrieve_last()->fetch_assoc();

	foreach($_SESSION['cart'] as $isbn => $qty){
        $book= Books::retrive_by_isbn($isbn);
        $copies = $book['copies'];
        Books::update_copies($isbn,$copies-$qty);
        OrderItem::insert($isbn, $order['id'], $qty);
	}

	unset($_SESSION['price']);
	unset($_SESSION['cart']);
    unset($_SESSION['qty']);
    unset($_POST['apply']);
    unset($_POST['discount']);
    unset($_POST['code']);
    

}
?>

<div class="alert alert-success" role="alert">

        Your Order Has Been Placed Successfully. Thanks for visiting our website.
        </div>
        </div>

        </body>
   
