<?php
include_once '../../connections.php';
session_start();


$stmt_clecks = $conn->prepare("SELECT * FROM data_entry_clerks");
$stmt_clecks->execute();
$result = $stmt_clecks->get_result();

$stmt_coordinator = $conn->prepare("SELECT * FROM event_coordinators");
$stmt_coordinator->execute();
$result_coordinators = $stmt_coordinator->get_result();


$stmt_managers = $conn->prepare("SELECT * FROM managers");
$stmt_managers->execute();
$get_managers = $stmt_managers->get_result();

?>
<!DOCTYPE html>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="emp_style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    <title>Employees</title>
</head>

<body>
    <nav class="navbar fixed-top" style="background-color:#343a40; ">
        <a id='mycollapse' style="color: white; margin-right:0;"><i class="fas fa-bars"></i></a>
        <a style="color: white;" class="navbar-brand" href="../../admin_panel.php">All Tables</a>
    </nav>

    <nav id="navbar">
        <div class="slidebar" style="background-color: #343a40;">
            <ul>
                <li><a name="tab1">Data Clerks</a></li>
                <li><a name="tab2">Managers</a></li>
                <li><a name="tab3">Event Coordinator</a></li>
                <li><a name="tab4">Add Clerk</a></li>
                <li><a name="tab5">Add Manager</a></li>
                <li><a name="tab6">Add Coordinator</a></li>
                <li><a name="tab7">Edit Clerk</a></li>
                <li><a name="tab8">Edit Manager</a></li>
                <li><a name="tab9">Edit Coordinator</a></li>
            </ul>
        </div>
    </nav>

    <main id="main-doc">
        <div class="main">
            <div id="tab1">
                <h1 class="header">Data Clerks</h1>
                <section class="tabl table-responsive">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">id</th>
                                <th scope="col">NAME</th>
                                <th scope="col">email</th>
                                <th scope="col">phone_number</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $index = 1;
                            while ($row = $result->fetch_assoc()) { ?>
                                <tr>
                                    <td>
                                        <?php echo $index; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['id']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['first_name'] . " " . $row['last_name']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['email']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['phone_number']; ?>
                                    </td>
                                </tr>
                            <?php $index = $index + 1;
                            } ?>


                        </tbody>
                    </table>
                </section>

            </div>

            <div id="tab2">
                <h1 class="">Managers</h1>

                <section class="tabl table-responsive">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">id</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">phone_number</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $index = 1;
                            while ($row = $get_managers->fetch_assoc()) { ?>
                                <tr>
                                    <td>
                                        <?php echo $index; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['id']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['first_name'] . " " . $row['last_name']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['email']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['phone_number']; ?>
                                    </td>
                                </tr>
                            <?php $index = $index + 1;
                            } ?>


                        </tbody>
                    </table>
                </section>
            </div>


            <div id="tab3">
                <h1 class="">Event Coordinators</h1>

                <section class="tabl table-responsive">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">id</th>
                                <th scope="col">NAME</th>
                                <th scope="col">email</th>
                                <th scope="col">phone_number</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $index = 1;
                            while ($row = $result_coordinators->fetch_assoc()) { ?>
                                <tr>
                                    <td>
                                        <?php echo $index; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['id']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['first_name'] . " " . $row['last_name']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['email']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['phone_number']; ?>
                                    </td>
                                </tr>
                            <?php $index = $index + 1;
                            } ?>


                        </tbody>
                    </table>
                </section>
            </div>


            <div id="tab4" class="add-form">
                <h1 class="header">Add Clerk</h1>
                <form method="POST" action="add_clerk.php">
                    <section class="form-row">
                        <section class="form-group col-md-6">
                            <label for="first_name">First Name</label>
                            <input pattern="^\S*$" Required class="form-control" name="fname" placeholder="First Name">
                        </section>
                        <section class="form-group col-md-6">
                            <label for="last_name">Last Name</label>
                            <input pattern="^\S*$" Required class="form-control" name="lname" placeholder="Last Name">
                        </section>
                    </section>
                    <section class="form-group">
                        <label for="email">Email</label>
                        <input pattern="^\S*$" Required type="email" class="form-control" name="email" placeholder="Email">
                    </section>
                    <section class="form-row">
                        <section class="form-group col-md-4">
                            <label for="tel">Phone Number</label>
                            <input Required type="tel" pattern="[0-9]{11}" class="form-control" name="tel" placeholder="01*********">
                        </section>
                        <section class="form-group col-md-4">
                            <label for="tel">Password</label>
                            <input pattern="^\S*$" Required type="password" class="form-control" placeholder="Password" name="pass">
                        </section>
                        <section class="form-group col-md-4">
                            <label for="manager_id">Manager</label>
                            <select name="manager_id" class="form-control">
                                <?php $stmt_managers->execute();
                                $get_managers = $stmt_managers->get_result();
                                while ($rows = $get_managers->fetch_assoc()) {  ?>
                                    <option value="<?php echo  $rows['id']; ?>">
                                        <?php echo $rows['first_name'] . " " . $rows['last_name']; ?>
                                    </option>
                                <?php
                                }
                                ?>
                            </select>
                        </section>
                    </section>
                    <button style="margin-left: 80%; width:20%;" type="submit" class=" btn btn-success">Add</button>
                </form>
            </div>

            <div id="tab5" class="add-form">
                <h1 class="header">Add Manager</h1>
                <form method="POST" action="add_mang.php">
                    <section class="form-row">
                        <section class="form-group col-md-6">
                            <label for="first_name">First Name</label>
                            <input pattern="^\S*$" Required class="form-control" name="fname" placeholder="First Name">
                        </section>
                        <section class="form-group col-md-6">
                            <label for="last_name">Last Name</label>
                            <input pattern="^\S*$" Required class="form-control" name="lname" placeholder="Last Name">
                        </section>
                    </section>
                    <section class="form-group">
                        <label for="email">Email</label>
                        <input pattern="^\S*$" Required type="email" class="form-control" name="email" placeholder="Email">
                    </section>
                    <section class="form-row">
                        <section class="form-group col-md-4">
                            <label for="tel">Phone Number</label>
                            <input Required type="tel" pattern="[0-9]{11}" class="form-control" name="tel" placeholder="01*********">
                        </section>
                        <section class="form-group col-md-4">
                            <label for="tel">Password</label>
                            <input pattern="^\S*$" Required type="password" placeholder="Password" class="form-control" name="pass">
                        </section>
                    </section>
                    <button style="position:relative; bottom:55px; margin-left: 80%; width:20%;" type="submit" class=" btn btn-success">Add</button>
                </form>
            </div>

            <div id="tab6" class="add-form">
                <h1 class="header">Add Coordinator</h1>
                <form method="POST" action="add_cord.php">
                    <section class="form-row">
                        <section class="form-group col-md-6">
                            <label for="first_name">First Name</label>
                            <input pattern="^\S*$" Required class="form-control" name="fname" placeholder="First Name">
                        </section>
                        <section class="form-group col-md-6">
                            <label for="last_name">Last Name</label>
                            <input pattern="^\S*$" Required class="form-control" name="lname" placeholder="Last Name">
                        </section>
                    </section>
                    <section class="form-group">
                        <label for="email">Email</label>
                        <input pattern="^\S*$" Required type="email" class="form-control" name="email" placeholder="Email">
                    </section>
                    <section class="form-row">
                        <section class="form-group col-md-4">
                            <label for="tel">Phone Number</label>
                            <input Required type="tel" pattern="[0-9]{11}" class="form-control" name="tel" placeholder="01*********">
                        </section>
                        <section class="form-group col-md-4">
                            <label for="tel">Password</label>
                            <input pattern="^\S*$" Required type="password" placeholder="Password" class="form-control" name="pass">
                        </section>
                        <section class="form-group col-md-4">
                            <label for="manager_id">Manager</label>
                            <select name="manager_id" class="form-control">
                                <?php $stmt_managers->execute();
                                $get_managers = $stmt_managers->get_result();
                                while ($rows = $get_managers->fetch_assoc()) {  ?>
                                    <option value="<?php echo  $rows['id']; ?>">
                                        <?php echo $rows['first_name'] . " " . $rows['last_name']; ?>
                                    </option>
                                <?php
                                }
                                ?>
                            </select>
                        </section>
                    </section>
                    <button style="margin-left: 80%; width:20%;" type="submit" class=" btn btn-success">Add</button>
                </form>
            </div>



            <div id="tab7" class="add-form">
                <h1 class="header">Edit Clerk</h1>
                <form method="POST" action="update_clerk.php">
                    <section style="margin-top:40px;">
                        <section class="col-md-6" style="display:inline-block; ">
                            <label for="id">ID</label>
                            <input pattern="^\S*$" Required id='select-Clerk-id' class="form-control" name="cid" placeholder="ID">
                        </section>
                        <button id='select-Clerk' style="position:relative; bottom:3px; margin-left: 10%; width:20%;" class=" btn btn-primary">Select</button>
                    </section>


                    <section style="margin-top: 70px;" class="form-row">
                        <section class="form-group col-md-6">
                            <label for="first_name">First Name</label>
                            <input pattern="^\S*$" Required id='Clerk-fname' class="form-control" name="fname" placeholder="First Name">
                        </section>
                        <section class="form-group col-md-6">
                            <label for="last_name">Last Name</label>
                            <input pattern="^\S*$" Required id='Clerk-lname' class="form-control" name="lname" placeholder="Last Name">
                        </section>
                    </section>
                    <section class="form-group">
                        <label for="email">Email</label>
                        <input pattern="^\S*$" Required id='Clerk-email' type="email" class="form-control" name="email" placeholder="Email">
                    </section>
                    <section class="form-row">
                        <section class="form-group col-md-6">
                            <label for="tel">Phone Number</label>
                            <input Required id='Clerk-tel' type="tel" pattern="[0-9]{11}" class="form-control" name="tel" placeholder="01*********">
                        </section>
                        <section class="form-group col-md-6">
                            <label for="manager_id">Manager</label>
                            <select id='Clerk-manager' name="manager_id" class="form-control">
                                <?php $stmt_managers->execute();
                                $get_managers = $stmt_managers->get_result();
                                while ($rows = $get_managers->fetch_assoc()) {  ?>
                                    <option value="<?php echo  $rows['id']; ?>">
                                        <?php echo $rows['first_name'] . " " . $rows['last_name']; ?>
                                    </option>
                                <?php
                                }
                                ?>
                            </select>
                        </section>
                    </section>
                    <button style="margin-left: 55%; width:20%;" id="delete_clerk" class=" btn btn-danger">Delete</button>
                    <button style="margin-left: 0%; width:20%;" type="submit" class=" btn btn-success">Update</button>
                </form>
            </div>

            <div id="tab8" class="add-form">
                <h1 class="header">Edit Manager</h1>
                <form method="POST" action="update_mang.php">
                    <section style="margin-top:40px;">
                        <section class="col-md-6" style="display:inline-block; ">
                            <label for="id">ID</label>
                            <input pattern="^\S*$" Required id='select-mang-id' class="form-control" name="cid" placeholder="ID">
                        </section>
                        <button id='select-mang' style="position:relative; bottom:3px; margin-left: 10%; width:20%;" class=" btn btn-primary">Select</button>
                    </section>


                    <section style="margin-top: 70px;" class="form-row">
                        <section class="form-group col-md-6">
                            <label for="first_name">First Name</label>
                            <input pattern="^\S*$" Required id='mang-fname' class="form-control" name="fname" placeholder="First Name">
                        </section>
                        <section class="form-group col-md-6">
                            <label for="last_name">Last Name</label>
                            <input pattern="^\S*$" Required id='mang-lname' class="form-control" name="lname" placeholder="Last Name">
                        </section>
                    </section>
                    <section class="form-group">
                        <label for="email">Email</label>
                        <input pattern="^\S*$" Required id='mang-email' type="email" class="form-control" name="email" placeholder="Email">
                    </section>
                    <section class="form-row">
                        <section class="form-group col-md-6">
                            <label for="tel">Phone Number</label>
                            <input Required id='mang-tel' type="tel" pattern="[0-9]{11}" class="form-control" name="tel" placeholder="01*********">
                        </section>
                    </section>
                    <button style="margin-left: 55%; width:20%;" id="delete_manager" class=" btn btn-danger">Delete</button>
                    <button style="margin-left: 0%; width:20%;" type="submit" class=" btn btn-success">Update</button>
                </form>
            </div>

            <div id="tab9" class="add-form">
                <h1 class="header">Edit Coordinator</h1>
                <form method="POST" action="update_Cord.php">
                    <section style="margin-top:40px;">
                        <section class="col-md-6" style="display:inline-block; ">
                            <label for="id">ID</label>
                            <input pattern="^\S*$" Required id='select-Cord-id' class="form-control" name="cid" placeholder="ID">
                        </section>
                        <button id='select-Cord' style="position:relative; bottom:3px; margin-left: 10%; width:20%;" class=" btn btn-primary">Select</button>
                    </section>


                    <section style="margin-top: 70px;" class="form-row">
                        <section class="form-group col-md-6">
                            <label for="first_name">First Name</label>
                            <input pattern="^\S*$" Required id='Cord-fname' class="form-control" name="fname" placeholder="First Name">
                        </section>
                        <section class="form-group col-md-6">
                            <label for="last_name">Last Name</label>
                            <input pattern="^\S*$" Required id='Cord-lname' class="form-control" name="lname" placeholder="Last Name">
                        </section>
                    </section>
                    <section class="form-group">
                        <label for="email">Email</label>
                        <input pattern="^\S*$" Required id='Cord-email' type="email" class="form-control" name="email" placeholder="Email">
                    </section>
                    <section class="form-row">
                        <section class="form-group col-md-6">
                            <label for="tel">Phone Number</label>
                            <input Required id='Cord-tel' type="tel" pattern="[0-9]{11}" class="form-control" name="tel" placeholder="01*********">
                        </section>
                        <section class="form-group col-md-6">
                            <label for="manager_id">Manager</label>
                            <select id='Cord-manager' name="manager_id" class="form-control">
                                <?php $stmt_managers->execute();
                                $get_managers = $stmt_managers->get_result();
                                while ($rows = $get_managers->fetch_assoc()) {  ?>
                                    <option value="<?php echo  $rows['id']; ?>">
                                        <?php echo $rows['first_name'] . " " . $rows['last_name']; ?>
                                    </option>
                                <?php
                                }
                                ?>
                            </select>
                        </section>
                    </section>
                    <button style="margin-left: 55%; width:20%;" id="delete_Cord" class=" btn btn-danger">Delete</button>
                    <button style="margin-left: 0%; width:20%;" type="submit" class=" btn btn-success">Update</button>
                </form>
            </div>

        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="work.js"></script>


</body>

</html>