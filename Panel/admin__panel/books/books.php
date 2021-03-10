<?php
include_once('../../connections.php');
session_start();

$bookstmt = $conn->prepare("SELECT * FROM books order by isbn");
if (!$bookstmt->execute()) {
    echo "<script> alert('sql error'); window.location.href='../admin__panel/employees.php' ;</script>";
}
$result = $bookstmt->get_result();
?>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Books</title>
    <link href="book_style.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #eee;
        }

        table {
            background-color: #ffffff;
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
                                    <option value="isbn  0" selected>ISBN</option>
                                    <option value="title 1">Title</option>
                                    <option value="description 4">Description</option>
                                    <option value="category_id 2">Category ID</option>
                                    <option value="publishing_house_id 8">Publishing House ID</option>
                                    <option value="author_id 3">Author ID</option>
                                    <option value="price 6">price</option>
                                    <option value="published_format 5">Published Format</option>
                                    <option value="image 7">Image URL</option>
                                    <option value="copies 9">Copies</option>
                                    <option value="language 10">Language</option>
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
            <h1 class="text-center text-primary display-3 mt-3">Books Management</h1>
            <input type="text" class=" bg-light mt-5 form-control ml-3" id="myInput" style="width: 50%;" onkeyup="myFunction()" placeholder="Search for ISBN or Title..">
            <div class="table-responsive tabl">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th style="width: 5%">ISBN <i class="fas fa-exchange-alt flip"></i></th>
                            <th style="width: 10%">Title <i class="fas fa-exchange-alt flip"></i></th>
                            <th style="width: 6%">Cat.ID <i class="fas fa-exchange-alt flip"></i></th>
                            <th style="width: 7%">Auth.ID<i class="fas fa-exchange-alt flip"></i></th>
                            <th style="width: 20%">Description <i class="fas fa-exchange-alt flip"></i></th>
                            <th style="width: 6%">Format<i class="fas fa-exchange-alt flip"></i></th>
                            <th style="width: 6%">Price <i class="fas fa-exchange-alt flip"></i></th>
                            <th style="width: 6%">Image <i class="fas fa-exchange-alt flip"></i></th>
                            <th style="width: 6%">PH ID <i class="fas fa-exchange-alt flip"></i></th>
                            <th style="width: 6%">Copies<i class="fas fa-exchange-alt flip"></i></th>
                            <th style="width: 7%">Language<i class="fas fa-exchange-alt flip"></i></th>
                            <th style="width: 12%">Control</th>
                        </tr>
                    </thead>
                    <tfoot class="thead-dark">
                        <tr>
                            <th>ISBN</th>
                            <th>Title</th>
                            <th>Cat. ID</th>
                            <th>Auth. ID</th>
                            <th>Description</th>
                            <th>Format</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>PH ID</th>
                            <th>Copies</th>
                            <th>Language</th>
                            <th>Control</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php $index = 1;
                        while ($row = $result->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $row['isbn']; ?></td>
                                <td><?php echo $row['title']; ?></td>
                                <td><?php echo $row['category_id'];  ?></td>
                                <td><?php echo $row['author_id']; ?></td>
                                <td><?php echo $row['description']; ?></td>
                                <td><?php echo $row['published_format']; ?></td>
                                <td><?php echo $row['price']; ?></td>
                                <td><a href="<?php echo $row['image']; ?>">image <?php echo $index ?></a></td>
                                <td><?php echo $row['publishing_house_id'] ?></td>
                                <td><?php echo $row['copies'] ?></td>
                                <td><?php echo $row['language'] ?></td>
                                <td style="text-align: center; " class="tr-ctrl align-middle">
                                    <button data-id="<?= $row['isbn']  ?>" data-index="<?php echo $index; ?>" class="crtl-btn  edit btn btn-primary" data-toggle="modal" data-target="#Modal">Edit</button>
                                    <button data-id="<?= $row['isbn'] ?>" class="crtl-btn ml-3 delete btn btn-danger">Delete</button>
                                </td>
                            </tr>
                        <?php $index = $index + 1;
                        } ?>
                         </tbody>
                        <tr>
                            <td colspan="11">
                                <input style="display: inline-block; width:47%" type="number" class="form-control" id="isbn" name="isbn" placeholder="ISBN">
                                <input style="display: inline-block; margin-left:5.5%; width:47%" type="text" class="form-control" id="title" name="title" placeholder="Title"><br><br>

                                <textarea class="form-control" id="description" name="description" placeholder="Description" rows="3"></textarea><br>

                                <input style="display: inline-block; width:30%" type="number" class="form-control" id="cat_id" name="cat_id" placeholder="Category ID">
                                <input style="margin-left:4.5%; display: inline-block; width:30%" type="number" class="form-control" id="author_id" name="author_id" placeholder="Author ID">
                                <input style="margin-left:4.5%; display: inline-block; width:30%" type="number" class="form-control" id="pub_house_id" name="pub_house_id" placeholder="Publishing House ID"><br><br>

                                <input type="url" class="form-control" id="img" name="img" placeholder="Image URL"><br>

                                <input style="display: inline-block; width:30%" type="number" class="form-control" id="copies" name="copies" placeholder="Copies">
                                <input style="margin-left:4.5%; display: inline-block; width:30%" type="number" class="form-control" id="price" name="price" placeholder="Price">
                                <input style="margin-left:4.5%; display: inline-block; width:30%" type="text" class="form-control" id="PubFormat" name="PubFormat" placeholder="Published Format"><br><br>

                                <input type="text" class="form-control" id="lang" name="lang" placeholder="Language">
                            </td>
                            <td colspan="1" style="text-align: center;" class="align-middle"><button class="add btn btn-success">Add</button></td>
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