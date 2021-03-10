<?php
include_once('../../connections.php');
session_start();

$bookstmt = $conn->prepare("SELECT * FROM books order by isbn");
if (!$bookstmt->execute()) {
    echo "<script> alert('sql error'); window.location.href='../admin__panel/employees.php' ;</script>";
}
$result = $bookstmt->get_result();

$authorstmt = $conn->prepare("SELECT * FROM authors");
if (!$authorstmt->execute()) {
    echo "<script> alert('sql error'); window.location.href='../admin__panel/employees.php' ;</script>";
}
$result_author = $authorstmt->get_result();

$catstmt = $conn->prepare("SELECT * FROM categories");
if (!$catstmt->execute()) {
    echo "<script> alert('sql error'); window.location.href='../admin__panel/employees.php' ;</script>";
}
$result_cat = $catstmt->get_result();

$pubstmt = $conn->prepare("SELECT * FROM publishing_houses");
if (!$pubstmt->execute()) {
    echo "<script> alert('sql error'); window.location.href='../admin__panel/employees.php' ;</script>";
}
$result_pub = $pubstmt->get_result();

?>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Books</title>
    <link href="style.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <style>
        body {
            background-color: #eee;
        }

        table {
            background-color: #ffffff;
        }

        th {
            cursor: pointer;
        }

        .flip {
            transform: rotate(90deg);
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="sb-nav-fixed sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <a style="color: white;" class="navbar-brand" href="../../admin_panel.php">All Tables</a>
    </nav>
    <main>

        <!-- Body -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-4">
                    <h1 class="text-center text-primary mt-4">Authors</h1>
                    <input type="text" class=" bg-light mt-5 mb-4 form-control ml-3" id="myInput" style="width: 50%;" onkeyup="myFunction()" placeholder="Search for ID or Name..">

                    <div class="table-responsive table1">
                        <table class="table table-bordered table1" id="dataTable" width="30%" cellspacing="0">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="text-center" style="width: 5%">ID <i class="fas fa-exchange-alt flip"></i></th>
                                    <th class="text-center" style="width: 12%">Author <i class="fas fa-exchange-alt flip"></i></th>
                                    <th class="text-center" style="width: 6%">Control</th>

                                </tr>
                            </thead>
                            <tfoot class="thead-dark">
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Author</th>
                                    <th class="text-center">Control</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php $index = 1;
                                while ($row = $result_author->fetch_assoc()) { ?>
                                    <tr>
                                        <td><?php echo $row['id']; ?></td>
                                        <td><?php echo $row['name']; ?></td>
                                        <td style="text-align: center; " class="tr-ctrl align-middle">
                                            <button data-id="<?php echo $row['id']; ?>" class="crtl-btn ml-3 delete_author btn btn-danger">Delete</button>
                                        </td>

                                    <?php $index = $index + 1;
                                } ?>
                            </tbody>

                            </tr>
                            <tr>
                                <td></td>
                                <td><input type="text" class="form-control" id="author_name" placeholder="William Shakespeare"></td>
                                <td style="text-align: center;"><button class="add_author btn btn-success">Add</button></td>

                            </tr>

                        </table>
                        <table>

                        </table>
                    </div>
                </div>
                <!-- start categories -->
                <div class="col-4">
                    <h1 class="text-center text-primary mt-4">Categories</h1>
                    <input type="text" class=" bg-light mt-5 mb-4 form-control ml-3" id="myInput2" style="width: 50%;" onkeyup="myFunction2()" placeholder="Search for ID or Name..">

                    <div class="table-responsive table2">

                        <table class="table table-bordered table2" id="dataTable" width="30%" cellspacing="0">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="text-center" style="width: 5%">ID <i class="fas fa-exchange-alt flip"></i></th>
                                    <th class="text-center" style="width: 12%">Category <i class="fas fa-exchange-alt flip"></i></th>
                                    <th class="text-center" style="width: 6%">Control</th>

                                </tr>
                            </thead>
                            <tfoot class="thead-dark">
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Category</th>
                                    <th class="text-center">Control</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php $index = 1;
                                while ($row = $result_cat->fetch_assoc()) { ?>
                                    <tr>
                                        <td><?php echo $row['id']; ?></td>
                                        <td><?php echo $row['name']; ?></td>
                                        <td style="text-align: center; " class="tr-ctrl align-middle">
                                            <button data-id="<?php echo $row['id']; ?>" class="crtl-btn ml-3 delete_cat btn btn-danger">Delete</button>
                                        </td>

                                    <?php $index = $index + 1;
                                } ?>
                            </tbody>
                            </tr>
                            <tr>
                                <td></td>
                                <td><input type="text" class="form-control" id="new_cat" placeholder="Fiction"></td>
                                <td style="text-align: center;"><button class="add_cat btn btn-success">Add</button></td>

                            </tr>

                        </table>
                        <table>

                        </table>
                    </div>
                </div>
                <!-- publishing house -->
                <div class="col-4">
                    <h1 class="text-center text-primary mt-4">Publishing House</h1>
                    <input type="text" class=" bg-light mt-5 mb-4 form-control ml-3" id="myInput3" style="width: 50%;" onkeyup="myFunction3()" placeholder="Search for ID or Name..">
                    <div class="table-responsive ">
                        <table class="table table-bordered table3" id="dataTable" width="30%" cellspacing="0">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="text-center" style="width: 5%">ID <i class="fas fa-exchange-alt flip"></i></th>
                                    <th class="text-center" style="width: 12%">Publishing House <i class="fas fa-exchange-alt flip"></i> </th>
                                    <th class="text-center" style="width: 6%">Control</th>

                                </tr>
                            </thead>
                            <tfoot class="thead-dark">
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Publishing House</th>
                                    <th class="text-center">Control</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php $index = 1;
                                while ($row = $result_pub->fetch_assoc()) { ?>
                                    <tr>
                                        <td><?php echo $row['id']; ?></td>
                                        <td><?php echo $row['name']; ?></td>
                                        <td style="text-align: center; " class="tr-ctrl align-middle">
                                            <button data-id="<?php echo $row['id']; ?>" class="crtl-btn ml-3 delete_publish btn btn-danger">Delete</button>
                                        </td>

                                    <?php $index = $index + 1;
                                } ?>
                            </tbody>
                            </tr>
                            <tr>
                                <td></td>
                                <td><input type="text" class="form-control" id="new_publish" placeholder="HarperCollins"></td>
                                <td style="text-align: center;"><button class="add_publish btn btn-success">Add</button></td>

                            </tr>

                        </table>
                        <table>

                        </table>
                    </div>
                </div>
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