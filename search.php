<?php
$count=0;
  $text = $_GET['searchtext'];
  $title = "Search";
  require_once "header.php";
  require_once "classes/Books.php";
  require_once "classes/author.php";
  require_once "classes/publishing_house.php"; 
  require_once "classes/categories.php";
  $books = Books::Search($text);
  ?>

<div class="container">
<br>
<h2 class="text-center">Search Result</h2>
<br>
<?php

if(mysqli_num_rows($books)==0){
    echo '
    <div class="alert alert-warning" role="alert">
    Nothing Found... 
    </div>' . ' <div class="search_top" >
       
 </div>';
  }
  else {
    echo '
    <div class="alert alert-success" role="alert">'
    .mysqli_num_rows($books).' result(s) found
    </div>';
  ?>

<?php for($i = 0; $i < mysqli_num_rows($books)/4; $i++){?>
  <div class="row">

      <?php while($query_row = mysqli_fetch_assoc($books)){ ?>
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
    }
      ?>
        </div>
  </div>

  </body>