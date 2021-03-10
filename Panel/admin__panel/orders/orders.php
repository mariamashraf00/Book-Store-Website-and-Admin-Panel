<?php
 include_once '../../connections.php';
 $stmt = $conn->prepare("SELECT * FROM orders");
 $stmt->execute();
 $result = $stmt->get_result();
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="book_style.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Orders</title>
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    <style>
         body{
        background-color:  #eee;
        }
        .flip{
        transform: rotate(90deg);
    }
    th {
    cursor: pointer;
    }
    </style>
</head>
<body>

<nav class="sb-nav-fixed sb-topnav navbar navbar-expand navbar-dark bg-dark">
<a style="color: white;" class="navbar-brand" href="../../admin_panel.php">All Tables</a>
    </nav>

  <main>
        <div class="container-fluid">
            <h1 class="text-center text-primary display-3 mt-3">Orders List</h1>
            <input type="text" class=" bg-light mt-5 form-control ml-3" id="myInput" style="width: 50%;" onkeyup="myFunction()" placeholder="Search for ID or Customer Name..">

            <div class="table-responsive tabl">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="background-color: #ffffff;">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID <i class="fas fa-exchange-alt flip"></i></th>
                            <th>Customer Name <i class="fas fa-exchange-alt flip"></i></th>
                            <th>Quantity <i class="fas fa-exchange-alt flip"></i></th>
                            <th>Total Price <i class="fas fa-exchange-alt flip"></i></th>
                            <th>Date <i class="fas fa-exchange-alt flip"></i></th>
                            <th>Discount Code <i class="fas fa-exchange-alt flip"></i></th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
  
  <?php $index = 1;
  while ($row = $result->fetch_assoc()) { ?>
  <tr>
        <td><?php echo $row['id'] ?></td>
        <td><?php echo $row['customer_username'] ?></td>
        <td><?php 
        $order =$row['id'] ;
         $count_items = $conn->prepare("SELECT count(*) as total FROM order_items WHERE order_id  = $order ;");
         $count_items ->execute();
         $result_c = $count_items->get_result();
         $res = mysqli_fetch_assoc($result_c);
         echo $res['total']
         ?> items</td>
        <td><?php echo $row['total_price'] ?></td>
        <td><?php echo $row['date'] ?></td>
        <td><?php echo $row['disount_code'] ?><td>
        <?php echo "<a href= \"./order_items.php?entry_id=$order\"><button  class=\"btn btn-primary\">More details</button></a>"?>
      </tr>
<?php } ?>


</tbody>
                </table>
            </div>  
        </div>
    </main>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="./work.js"></script>
</body>
</html>