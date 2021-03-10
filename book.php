<?php
  $book_isbn = $_GET['bookisbn'];
  require_once "classes/Books.php";
  require_once "classes/author.php";
  require_once "classes/categories.php";
  require_once "classes/publishing_house.php";
  $row=Books::retrive_by_isbn($book_isbn);

  $title = $row['title'];

  require_once "header.php";
  
  $author=Author::retrieve_by_id($row['author_id']);
  $pub = House::retrieve_by_id($row['publishing_house_id']);
  $cat = Categories::retrieve_by_id($row['category_id']);

?>
<br>
<div class="container">
<h3><a href="books.php">All Books</a> &nbsp;> &nbsp;<?php echo $row['title']; ?></h3>
<br>
      <div class="row">
        <div class="col-md-3 text-center">
        <img class="img-thumbnail" style="width: 400px;" src="<?php echo $row['image']; ?>">
        </div>
        <div class="col-md-6">
          <h4>Description:</h4>
          <p><?php echo $row['description']; ?></p>
          <h4>Details:</h4>
          <table class="table">
            <tr>
              <td>Author:</td>
              <td><?php echo $author['name']; ?></td>
            </tr>
            <tr>
              <td>Price:</td>
              <td><?php echo $row['price']; ?> L.E</td>
            </tr>
            <tr>
              <td>Language:</td>
              <td><?php echo $row['language']; ?></td>
            </tr>
            <tr>
              <td>Published Format:</td>
              <td><?php echo $row['published_format']; ?></td>
            </tr>
            <tr>
              <td>Category:</td>
              <td><?php echo $cat['name']; ?></td>
            </tr>
            <tr>
              <td>Publisher:</td>
              <td><?php echo $pub['name']; ?></td>
            </tr>
          </table>
          
          <div class="row">
          <?php
          if ($row['copies']<=0)
          {
            echo '<p class="text-danger"><strong>Out Of Stock </strong></p>';
          }
          else {
          echo'
          <form class = "col-md-3"method="post" action="cart.php">
          <input type="hidden" name="bookisbn" value="'.$book_isbn.'">
            <input type="submit" value="Add To Cart" name="cart" class="btn btn-primary">
          </form>';
          }
          ?>
          <?php
          if (isset($_SESSION['customer']))
          {
            echo'
          <form class = "col-md-3" method="get" action="addtowishlist.php">
          <input type="hidden" name="bookisbn" value="'.$row['isbn'].'">
            <input type="submit" value="Add To Wish List" class="btn btn-primary">
          </form>';
          }
          ?>
          </div>
       	</div>
      </div>
</div>
<br>

</body>
