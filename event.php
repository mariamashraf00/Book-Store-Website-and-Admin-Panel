<?php
require_once "classes/events.php";
require_once "classes/videos.php";
  $event_id = $_GET['id'];
  $event = Events::retrieve_by_id($event_id);
  $title = $event['title'];
  $video=(Video::retrieve_by_event_id($event_id))->fetch_assoc();
  require_once "header.php";

?>
<br>
<div class="container">
<h3><a href="events.php">All Events</a> &nbsp;> &nbsp;<?php echo $event['title']; ?></h3>
<br>
<iframe class="video" src="<?php echo $video['url']; ?>"> </iframe> 
    <br>
</div>

</body>