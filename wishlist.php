<?php
session_start();
$count=0;
$title = "Wishlist";
require_once "header.php";
require_once "classes/customer.php";
require_once "classes/author.php";
require_once "classes/wishlists.php";
  if(isset($_SESSION['customer'])){
    $customer = Customer::retrieve_by_username($_SESSION['username']);
    if (isset($_POST['remove']))
      {
        WishList::delete($_SESSION['username'], $_POST['isbn']);
      }
    $list = WishList::retrieve_books_by_customer_username($customer['username']);
    
  }
?>
<br>
<div class="container">

  <h2 class="text-center">Wish List</h2>
  <br>
    <?php 
    if(!isset($_SESSION['customer'])){
		echo '<div class="text-center alert alert-danger" role="alert">
		You Need to <a href="signin.php">Sign in</a> First! 
	  </div>';
    }
    else
    {
    if (mysqli_num_rows($list)==0)
    {
      echo '<div class="text-center alert alert-info" role="alert">
      Your Wishlist is empty! 
      </div>';
    }
    else{
    for($i = 0; $i < mysqli_num_rows($list)/4; $i++){ ?>
        <div class="row">
        <?php while($query_row = mysqli_fetch_assoc($list)){ ?>
          <div class="col-md-3">
          <a href="book.php?bookisbn=<?php echo $query_row['isbn']; ?>">
              <img class="img-thumbnail" style="width: 250px;" src="<?php echo $query_row['image']; ?>">
              </a>
              <table>
                <tr>
                <td><strong><?php echo $query_row['title']; ?></strong></td>
                </tr>
                <tr>
                <?php
                  $author=Author::retrieve_by_id($query_row['author_id']);?>
                <td><?php echo $author['name']; ?></td>
                </tr>
                <tr>
                <td><strong><?php echo $query_row['price']; ?> L.E</strong></td>
                </tr>
                </tr>
                <tr>
                <td><form method="post" action="wishlist.php" class="form-horizontal">
             <input type="text" name="isbn" value="<?php echo $query_row['isbn'] ?>" hidden >            
				<input type="submit" name="remove" value="Remove" class="btn btn-primary" >
			</div>
		</form></td>
                </tr>
              </table>
            </div>
            <?php
          $count++;
          if($count >= 4){
              $count = 0;
              break;
            }
          } ?>
          </div>
          <br>
            <?php
      }
      ?>
  </div>
  <?php
}            } ?> 
      </div>

        </body>


