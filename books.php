<?php
  $title = "Books";
  require_once "header.php";
  require_once "classes/Books.php";
  require_once "classes/author.php";

  $booknum=Books::get_count();
  $pagenum= ceil($booknum / 16);
  if (isset($_GET['page']))
  {
    $currentpage= $_GET['page'];
  }
  else $currentpage=1;

  $query = Books::retrive_limit(($currentpage-1)*16);
  $count = 0;

?>
<br>
<h2 class="text-center">All Books</h2>
<br><br>
<div class="container">
<div>
  <ul class="pagination justify-content-center ">
  <?php for($i = 1; $i <= $pagenum; $i++){ 
    
    echo '
    <li class="page-item ';
    if ($i==$currentpage)
    echo 'active';
    echo'"><a class="page-link" href="books.php?page='.$i.'">'.$i.'</a></li>
    ';
  }?>
  </ul>
</div>
<?php for($i = 0; $i < 4; $i++){?>
      <div class="row">
      <?php while($query_row = mysqli_fetch_assoc($query)){ ?>
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
      ?>
<div>
  <ul class="pagination justify-content-center ">
  <?php for($i = 1; $i <= $pagenum; $i++){ 
    
    echo '
    <li class="page-item ';
    if ($i==$currentpage)
    echo 'active';
    echo'"><a class="page-link" href="books.php?page='.$i.'">'.$i.'</a></li>
    ';
  }?>
  </ul>
</div>

        </div>
       
</div>

</body>