<?php
$title = "Index";
require_once "header.php";
require_once "classes/Books.php";
require_once "classes/author.php";
$num = Books::get_count();
$query = Books::retrive_limit($num - 4);
$count = 0;
?>
<div class="jumbotron" style="  background: url('https://www.econlib.org/wp-content/uploads/2018/02/LF-books-background.png') no-repeat center;background-size: cover;height:400px;">
  <h1 style="text-align:center; margin:5% auto;">WELCOME TO BOOKTIVE</h1>
</div>

<br> <br>
<h3 class="text-center">LATEST BOOKS</h3>
<br><br>
<div class="container">
  <div class="row">
    <?php while ($query_row = mysqli_fetch_assoc($query)) { ?>
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
            $author = Author::retrieve_by_id($query_row['author_id']);
            ?>
            <td><?php echo $author['name']; ?></td>
          </tr>
          <tr>
            <td><strong><?php echo $query_row['price']; ?> L.E</strong></td>
          </tr>
        </table>
      </div>
    <?php
      $count++;
      if ($count >= 4) {
        $count = 0;
        break;
      }
    } ?>
  </div>
</div>
</div>
</body>