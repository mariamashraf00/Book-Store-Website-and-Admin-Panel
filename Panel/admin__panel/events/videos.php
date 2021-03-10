<?php
include_once('../../connections.php');
session_start();

$eventstmt = $conn->prepare("SELECT * FROM videos ");
if (!$eventstmt->execute()) {
    echo "<script> alert('sql error'); window.location.href='../admin__panel/employees.php' ;</script>";
}
$result = $eventstmt->get_result();

$event_stmt = $conn->prepare("SELECT * FROM events");
if (!$event_stmt->execute()) {
    echo "<script> alert('sql error'); window.location.href='../admin__panel/employees.php' ;</script>";
}
$result_event = $event_stmt->get_result();
?>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Events</title>
    <link href="../books/book_style.css" rel="stylesheet" />
    <style>
        .des {
            word-wrap: break-word;
        }

        .wrapword {
            white-space: -moz-pre-wrap !important;
            /* Mozilla, since 1999 */
            white-space: -pre-wrap;
            /* Opera 4-6 */
            white-space: -o-pre-wrap;
            /* Opera 7 */
            white-space: pre-wrap;
            /* css-3 */
            word-wrap: break-word;
            /* Internet Explorer 5.5+ */
            white-space: -webkit-pre-wrap;
            /* Newer versions of Chrome/Safari*/
            word-break: break-all;
            white-space: normal;
        }

        body {
            background-color: #eee;
        }

        table {
            background-color: #ffffff;
        }
        th {
    cursor: pointer;
        }
        .flip{
            transform: rotate(90deg);
        }
    </style>
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="sb-nav-fixed sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="main.php">Events</a>
    </nav>
    <main>
        <!-- Modal -->
        <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalLabel">Edit Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <select id="SelectColumn" class="form-control">
                                    <option value="title  1" selected>Title</option>
                                    <option value="url 2">URL</option>
                                    <option value="event_id 3">Event ID</option>
                                    <option value="description 4">Description</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Value:</label>
                                <textarea class="form-control" id="message-text"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button id="send" type="button" data-dismiss="modal" class="btn btn-primary">Done</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal End -->
        <!-- Body -->

        <div class="container-fluid">
            <h1 class="text-center text-primary mt-4 display-3">Videos Management</h1>
            <input type="text" class=" bg-light mt-5 form-control ml-3" id="myInput" style="width: 50%;" onkeyup="myFunction()" placeholder="Search for ID or Title..">
            <div class="table-responsive tabl">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center" style="width: 10%">ID   <i class="fas fa-exchange-alt flip"></i></th>
                            <th class="text-center" style="width: 10%">Title   <i class="fas fa-exchange-alt flip"></i></th>
                            <th style="width: 10%">Event ID   <i class="fas fa-exchange-alt flip"></i></th>
                            <th class="" style="max-width: 35%">Description   <i class="fas fa-exchange-alt flip"></i></th>
                            <th class="text-center" style="width: 20%">Video URL   <i class="fas fa-exchange-alt flip"></i></th>
                            <th class="text-center" style="width : 12%">Control</th>
                        </tr>
                    </thead>
                    <tfoot class="thead-dark">
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">Title</th>
                            <th>Event ID</th>
                            <th>Description</th>
                            <th class="text-center">Video URL</th>
                            <th class="text-center">Control</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $index = 1;
                        while ($row = $result->fetch_assoc()) { ?>
                            <tr>
                                <td class="text-center"><?php echo $row['id']; ?></td>
                                <td class="text-center"> <?php echo $row['title']; ?></td>
                                <td class="text-center des"><?php echo $row['event_id']; ?></td>
                                <td class="wrapword"><?php echo $row['description']; ?></td>
                                <td class="text-center align-center"><a href="<?php echo $row['url']; ?>"> <?php echo $row['title']; ?> Video-link</a> </td>




                                <td style="text-align: center; " class="tr-ctrl align-middle">
                                    <button data-id="<?php echo $row['id']; ?>" data-index="<?php echo $index; ?>" class="crtl-btn  edit btn btn-primary" data-toggle="modal" data-target="#Modal">Edit</button>
                                    <button data-id="<?php echo $row['id']; ?>" class="crtl-btn ml-3 delete_videos btn btn-danger">Delete</button>
                                </td>
                            </tr>
                        <?php $index = $index + 1;
                        } ?>
                        </tbody>
                        <tr class="align-middle">
                            <td> </td>
                            <td class="align-middle"><input type="text" class="form-control" id="video_title" placeholder="Title"></td>
                            <td class="align-middle"> <select select class="form-control align-middle" id="event_id"> <?php while ($row = $result_event->fetch_assoc()) {  ?>
                                        <option class="text-center align-middle" value="<?php echo $row['id']; ?>"><?php echo $row['id']; ?></option>
                                    <?php
                                                                                                                        }
                                    ?>
                                </select></td>
                            <td><textarea class="form-control" id="video_Describtion" placeholder="Describtion"></textarea></td>
                            <td class="align-middle"><input type="text" class="form-control" id="video_url" placeholder="video_link"></td>


                            <td style="text-align: center;" class="align-middle"><button class="add_videos align-middle btn btn-success">Add</button></td>
                        </tr>
                    
                </table>
            </div>
        </div>
    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="script.js"></script>
    <script src="videos.js"></script>
</body>

</html>