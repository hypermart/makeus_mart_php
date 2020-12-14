<?php 
    session_start(); 
    if($_SESSION['userName'] == '') {
        header('location:../index.php');
        exit();
    }
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Super Influencers | Hypermartindia</title>

    <link rel="shortcut icon" href="../assets/images/influe_logo.png" type="image/x-icon"> 

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/rowgroup/1.1.2/css/rowGroup.bootstrap4.min.css">
</head>

<body>
<?php include '../config.php'; ?>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <img src="../assets/images/influe_logo.png">
            </div>

            <ul class="list-unstyled components">
                <li>
                    <a href="../influencers/dashboard.php">Influencers</a>
                </li>
                <li class="active">
                    <a href="superInfluencerData.php">Super Influencers</a>
                </li>
                <li>
                    <a href="../suppliers/suppliersData.php">Suppliers</a>
                </li>
                <li>
                    <a href="../users/usersData.php">Users</a>
                </li>
            </ul>
        </nav>

        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left"></i>
                        <span>Toggle Sidebar</span>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <?php if($_SESSION['userRole'] == 'admin' || $_SESSION['userRole'] == 'edit' || $_SESSION['userRole'] == 'create') { ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="../users/createUser.php">Create User</a>
                                </li>
                                <li class="nav-item" style="cursor: pointer;">
                                    <div class="dropdown">
                                        <a class=" nav-link dropdown-toggle" data-toggle="dropdown">
                                            Register As 
                                        </a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="../influencers/influencerRegistration.php">Influencer</a>
                                            <a class="dropdown-item" href="superInfluencerRegistration.php">Super Influencer</a>
                                            <a class="dropdown-item" href="../suppliers/supplierRegistration.php">Supplier</a>
                                        </div>
                                    </div>
                                </li>
                            <?php } ?>
                            <li class="nav-item">
                                <a class="nav-link" href="../auth/logout.php">Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="data">
                <div class="header mb-4">
                    <h2>Super Influencers</h2>
                </div>
                <table id="example" class="table table-bordered table-responsive-sm" style="width:100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile No</th>
                            <th>Address</th>
                            <th>Super Influencer Code</th>
                            <?php if($_SESSION['userRole'] == 'admin' || $_SESSION['userRole'] == 'edit' || $_SESSION['userRole'] == 'create') { ?>
                                <th>Action</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $collection=$db->superInfluencerRegister;
                            $superInfluencers=$collection->find();
                            foreach ($superInfluencers as $superInfluencer) { ?>
                                <tr id="<?php echo $superInfluencer['_id'] ?>">
                                    <td> <?php echo $superInfluencer['firstName']." ".$superInfluencer['middleName']." ".$superInfluencer['lastName']?></td>
                                    <td> <?php echo $superInfluencer['email'] ?> </td>
                                    <td> <?php echo $superInfluencer['mobileNo'] ?> </td>
                                    <td> <?php echo $superInfluencer['addressLineOne']."<br>".$superInfluencer['addressLineTwo']."<br>".$superInfluencer['city'].",".$superInfluencer['pincode']?></td>
                                    <td> <?php echo $superInfluencer['superInfluencerCode'] ?> </td>
                                    <?php if($_SESSION['userRole'] == 'edit' || $_SESSION['userRole'] == 'create') { ?>
                                        <td><a href="updateSuperInfluencer.php?id=<?php echo $superInfluencer['superInfluencerCode']; ?>" class="btn btn-primary editSuperInfluencer" id="edit<?php echo $superInfluencer['_id'] ?>">Edit</a></td>  
                                    <?php } ?>
                                    <?php if($_SESSION['userRole'] == 'admin') { ?>
                                        <td><a href="updateSuperInfluencer.php?id=<?php echo $superInfluencer['superInfluencerCode']; ?>" class="btn btn-primary editSuInfluencer" id="edit<?php echo $superInfluencer['_id'] ?>">Edit</a>
                                            <button href="delete.php" class="btn btn-danger delete" id="<?php echo $superInfluencer['_id'] ?>">Delete</button></td>
                                    <?php } ?>
                                </tr>
                            <?php }
                        ?>                 
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/rowgroup/1.1.2/js/dataTables.rowGroup.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });

        $(document).ready(function() {
            $('#example').DataTable( {
                order: [[2, 'asc']],
                rowGroup: {
                    dataSrc: 2
                }
            } );
        } );

        //Deleting the forthcoming events
        $(".delete").click(function(e){
            e.preventDefault();
            var id = this.id;
            if(confirm("Are you sure you want to delete this?")){
                $.ajax({
                    type: 'POST',
                    url: 'delete.php',
                    data: {"id":id},
                    success: function(response){
                        console.log(JSON.stringify(response));
                        if(response == 'ok'){
                            location.reload();
                        } else {
                            alert("Some problem occurred, please try again.");
                        }
                    },
                    error:function(err){
                      alert(err);
                    }
                });
            } else {
                return false;
            }
        });
    </script>
</body>

</html>