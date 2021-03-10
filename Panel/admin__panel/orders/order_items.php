<?php
require_once ('../../connections.php');
$item_id = $_GET['entry_id'];
$item_id = intval($item_id);
//echo $item_id
$stmt = $conn->prepare("SELECT * FROM order_items where order_id = $item_id");
$stmt->execute();
$result = $stmt->get_result();
$num_orders = mysqli_num_rows($result);

$stmt_order = $conn->prepare("SELECT * FROM orders where id = $item_id");
$stmt_order->execute();
$res_order = $stmt_order->get_result();
$order_obj= mysqli_fetch_assoc($res_order);
$order_cus = $order_obj['customer_username'];

$customer_stmt = $conn->prepare("SELECT * FROM customers where username = '$order_cus';");
$customer_stmt->execute();
$res_cus = $customer_stmt->get_result();
$customer_obj= mysqli_fetch_assoc($res_cus);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Orders</title>
    <style>
         body{
        background-color:  #eee;
        }
    </style>
</head>

<body>
    <nav class="sb-nav-fixed sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="orders.php">Order</a>
    </nav>
    <div class="container">
        <h1 class="text-center text-primary my-5 display-3 pb-3 shadow">Order Items</h1>
        <div class="  rounded  my-4">
            <div class="row">
                <div class="col-6">
                    <h3 class="text-secondary my-3 pb-3">Order_ID : <span class="text-warning"><?php echo $item_id?></span></h3>
                    <h3 class="text-secondary my-3 pb-3">Number of items : <span class="text-warning"><?php echo $num_orders?></span></h3>
                <?php while ($row = $result->fetch_assoc()) { 
                    $book_isbn = $row['book_isbn']; 
                    $b_details = $conn->prepare("SELECT * FROM books where isbn = ?");
                    $b_details->bind_param('s',$book_isbn);
                    $b_details->execute();
                    $res_book = $b_details->get_result();
                    $row_books = mysqli_fetch_assoc($res_book);?>
                    <div class="row my-3 bg-light">
                        <div class="col-5 pic">
                            <img  src="<?php echo $row_books['image'];  ?>"  alt="Image1" class="img-fluid">
                        </div>
                        <div class="col-7 py-3">
                            <h5 class="pt-2">Bookisbn : <span class="text-primary"><?php echo $row['book_isbn'] ?></span></h5> 
                            <h5 class="py-2">Book name : <span class="text-primary"><?php echo $row_books['title'] ?></span> </h5>
                            <h5 class="">Format : <span class="text-secondary"><?php echo $row_books['published_format'] ?></span> </h5>
                            <h5 class="pt-2 pb-2">Book Price : <span class="text-success"><?php echo $row_books['price'] ?> $</span> </h5>
                            <h5 class="pt-2 pb-2 ">Quantity : <span class="text-success"><?php echo $row['amount'] ?> item </span></h5>
                        </div>
   
                    </div>
                <?php } ?>
                </div>
                <div class="col-5 pt-2 bg-light border ml-5">
                <h1 class="text-center text-dark mb-3">Customer Information</h1>
                <h3 class="text-secondary py-2" >User Name :<span class="text-primary"> <?php echo $customer_obj['username']; ?></span></h3>
                <h3 class="text-secondary py-2">Full Name : <span class="text-primary"><?php echo $customer_obj['first_name']." ".$customer_obj['last_name']; ?></span></h3>
                <h3 class="text-secondary py-2">Email : <span class="text-primary"><?php echo $customer_obj['email']; ?></span></h3>
                <h3 class="text-secondary py-2">Phone Number : <span class="text-primary"><?php echo $customer_obj['phone_number']; ?></span></h3>
                </div>
                
            </div>
            
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</body>

</html>