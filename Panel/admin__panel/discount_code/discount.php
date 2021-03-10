<?php
include_once ('../../connections.php');
session_start();

$stmt = $conn->prepare("SELECT * FROM disount_codes ");
if(!$stmt->execute()){
    echo "<script> alert('sql error'); window.location.href='../admin__panel/employees.php' ;</script>";
}
$result = $stmt->get_result();
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
        .des{
            word-wrap: break-word;
        }
        .wrapword {
    white-space: -moz-pre-wrap !important;  /* Mozilla, since 1999 */
    white-space: -pre-wrap;      /* Opera 4-6 */
    white-space: -o-pre-wrap;    /* Opera 7 */
    white-space: pre-wrap;       /* css-3 */
    word-wrap: break-word;       /* Internet Explorer 5.5+ */
    white-space: -webkit-pre-wrap; /* Newer versions of Chrome/Safari*/
    word-break: break-all;
    white-space: normal;
    }
    body{
        background-color: #eee;
    }
    table{
        background-color: #ffffff;
    }
    .flip{
        transform: rotate(90deg);
    }
    th {
    cursor: pointer;
        }
    </style>
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="sb-nav-fixed sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <a style="color: white;" class="navbar-brand" href="../../admin_panel.php">All Tables</a>
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
                                    <option value="code  1" selected>Code</option>
                                    <option value="percentage 2">Percentage</option>
                                    <option value="start_date 3">Start Date</option>
                                    <option value="expiry_date 4">Expity Date</option>
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

        <div class="container">
        <h1 class="text-center text-primary mt-4 mb-5 display-3">Discount Codes Management</h1>
        <input type="text" class=" bg-light mt-5 form-control" id="myInput" style="width: 70%;" onkeyup="myFunction()" placeholder="Search for Code or Start Date..">
            <div class="table-responsive tabl">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center" style="width: 5%"># </i></th>
                            <th class="text-center" style="width: 20%">Code   <i class="fas fa-exchange-alt flip"></i></th>
                            <th class="text-center" style="width: 12%">Percentage<i class="fas fa-exchange-alt flip"></i></th>
                            <th class="text-center" style="max-width: 20%">Start Date   <i class="fas fa-exchange-alt flip"></i></th>
                            <th class="text-center" style="width: 20%">Expiry Date   <i class="fas fa-exchange-alt flip"></i></th>
                            <th class="text-center" style="width : 25%" >Control</th>
                        </tr>
                    </thead>
                    <tfoot class="thead-dark">
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Code</th>
                            <th>Percentage</th>
                            <th>Start Date</th>
                            <th class="text-center">Expiry Date</th>
                            <th class="text-center">Control</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $index = 1;
                        while ($row = $result->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $index?></td>
                                <td class="text-center"><?php echo $row['code']; ?></td>
                                <td class="text-center"> <?php echo $row['percentage']; ?> %</td>
                                <td class="text-center des"><?php  echo $row['start_date']; ?></td>
                                <td class="text-center wrapword" ><?php echo $row['expiry_date']; ?></td>
                        
                                <td style="text-align: center; " class="tr-ctrl align-middle">
                                    <button data-id="<?php echo $row['code']; ?>" data-index="<?php echo $index; ?>" class="crtl-btn  edit btn btn-primary" data-toggle="modal" data-target="#Modal">Edit</button>
                                    <button data-id="<?php echo $row['code']; ?>" class="crtl-btn ml-3 delete_code btn btn-danger">Delete</button>
                                </td>
                            </tr>
                        <?php $index = $index + 1;
                        } ?>
                        </tbody>
                        <tr class="align-middle"> 
                            <td></td>
                            <td class="align-middle"><input type="text" class="form-control" id="new_code" placeholder=""></td>
                           <td class="align-middle"><input type="number" class="form-control" id="new_per" placeholder=""></td>
                            <td><input type="date" class="form-control" id="start_date" placeholder=""></td>
                            <td class="align-middle"><input type="date" class="form-control" id="end_date" placeholder=""></td>
                       
                        
                            <td style="text-align: center;" class="align-middle"><button class="add_code align-middle btn btn-success">Add</button></td>
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
</body>

</html>