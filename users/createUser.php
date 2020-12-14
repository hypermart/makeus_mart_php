<?php 
    session_start(); 
    if($_SESSION['userName'] == '') {
        header('location:../index.php');
        exit();
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Create User | Hypermartindia</title>

    <link rel="shortcut icon" href="../assets/images/influe_logo.png" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js"></script>
  </head>

  <body>

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
                <li>
                    <a href="../superinfluencers/superInfluencerdata.php">Super Influencers</a>
                </li>
                <li>
                    <a href="../suppliers/suppliersData.php">Suppliers</a>
                </li>
                <li>
                    <a href="usersData.php">Users</a>
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
                                <li class="nav-item active">
                                    <a class="nav-link" href="createUser.php">Create User</a>
                                </li>
                                <li class="nav-item" style="cursor: pointer;">
                                    <div class="dropdown">
                                        <a class=" nav-link dropdown-toggle" data-toggle="dropdown">
                                            Register As 
                                        </a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="../influencers/influencerRegistration.php">Influencer</a>
                                            <a class="dropdown-item" href="../superInfluencers/superInfluencerRegistration.php">Super Influencer</a>
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

            <div class="container">
                <div class="row">
                    <div class="col-md-12 mx-auto">
                        <div class="alert-message"></div>
                        <form id="userCreateForm" method="POST" class="user-form my-4" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label class="control-label col-md-2" for="userName">User Name</label>
                                <input type="text" class="form-control col-md-10" id="userName" placeholder="Enter user name" name="userName">
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-2" for="firstName">First Name</label>
                                <input type="text" class="form-control col-md-10" id="firstName" placeholder="Enter first name" name="firstName">
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-2" for="lastName">Last Name</label>
                                <input type="text" class="form-control col-md-10" id="lastName" placeholder="Enter last name" name="lastName">
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-2" for="password">Password</label>
                                <input type="password" class="form-control col-md-10" id="password" placeholder="Enter the password" name="password">
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-2" for="email">Email</label>
                                <input type="email" class="form-control col-md-10" id="email" placeholder="Enter email" name="email">
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-2" for="mobileNo">Mobile No</label>
                                <input type="text" class="form-control col-md-10" id="mobileNo" placeholder="Enter mobile no" name="mobileNo">
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-2" for="userRole">User Role</label>
                                <select class="form-control col-md-4" name="userRole">
                                    <option value="create">Create</option>
                                    <option value="read">Read</option>
                                    <option value="edit">Edit</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success createUserBtn">Create User</button>
                            <a href="usersData.php" class="btn btn-default cancel ml-3">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
        
        $(document).ready(function(e){

            $("#userCreateForm").validate({
                rules:{
                    userName: "required",
                    firstName: "required",
                    lastName: "required",
                    'password': {
                        required: true,
                        minlength: 8,
                        pwcheck: true
                    },
                    'email': {
                        email: true,
                        required: true
                    },
                    'mobileNo':{
                        required : true,
                        minlength:10
                    }
                },
                messages: {
                    userName:"Please fill user name",
                    firstName:"Please fill first name",
                    lastName:"Please fill last name",
                    password: {
                        minlength:"Pasword should have 8 characters",
                        required:"Please enter password",
                        pwcheck:"password should have one lowercase, one number"
                    },
                    email:{
                        email:"Enter valid email",
                        required:"Enter email address"
                    },
                    mobileNo:{
                        minlength:"Please enter valid mobile no.",
                        required:"Please enter mobile no."
                    }
                },
                submitHandler: function (form) {
                    var formData = new FormData(form);
                    $.ajax({
                        type: 'POST',
                        url: 'user.php',
                        data: formData,
                        dataType: 'json',
                        contentType: false,
                        cache: false,
                        processData:false,
                        beforeSend: function(){                           
                        },
                        success: function(response){ 
                            console.log("Response is" + JSON.stringify(response));
                            if(response == true) {
                                $("#userCreateForm")[0].reset();
                                $(".alert-message").html('<div class="alert alert-danger alert-dismissible fade show">' +
                                        '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                    'User name already used, please select another' +
                                '</div>');
                            } else {
                                $("#userCreateForm")[0].reset();
                                $(".alert-message").html('<div class="alert alert-success alert-dismissible fade show">' +
                                        '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                    'Form is successfully submitted' +
                                '</div>');
                            }               
                        },
                        error: function(err) {
                            console.log("Error is " + JSON.stringify(err));
                        }
                    });
                }
            });  
            $.validator.addMethod("pwcheck", function(value) {
                return /^[A-Za-z0-9\d=!\-@._*]*$/.test(value) // consists of only these
                    && /[a-z]/.test(value) // has a lowercase letter
                    && /\d/.test(value) // has a digit
            });
        });
    </script>
  </body>
</html>