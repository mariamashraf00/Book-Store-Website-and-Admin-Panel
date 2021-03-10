<?php
  session_start();
  $title = "Events";
  require_once "header.php";
  require_once "classes/events.php";
  $query=Events::retrieve_all();
?>
<br>
<div class="container">
<h2 class="text-center">All Events</h2>
<br>
<?php while($query_row = mysqli_fetch_assoc($query)){ ?>
        <div class="row event">
            <div class="event-left col-md-4">
                <p class="date" style="font-size: 26px ;"><?php echo $query_row['start_date']; ?><p>
            </div>
            <div class="event-right col-md-8">
                <p class="event-title"><?php echo $query_row['title']; ?></p>
                <p> <?php echo $query_row['description']; ?></p>
                <p class="presenter"> <?php echo $query_row['presenter_name']; ?> <p>
                <a href="event.php?id=<?php echo $query_row['id']; ?>" class="btn btn-primary">Watch Event</a>
                <br>
            </div>
        </div>
        <br>
        <?php } ?>
</div> 
       
</body>