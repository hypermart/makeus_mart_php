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
    <title>Influencer Registration | Hypermartindia</title>

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

  <?php include '../config.php'; ?>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <img src="../assets/images/influe_logo.png">
            </div>

            <ul class="list-unstyled components">
                <li>
                    <a href="dashboard.php">Influencers</a>
                </li>
                <li>
                    <a href="../superinfluencers/superInfluencerData.php">Super Influencers</a>
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
                                <li class="nav-item active" style="cursor: pointer;">
                                    <div class="dropdown">
                                        <a class=" nav-link dropdown-toggle" data-toggle="dropdown">
                                            Register As 
                                        </a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="influencerRegistration.php">Influencer</a>
                                            <a class="dropdown-item" href="../superinfluencers/superInfluencerRegistration.php">Super Influencer</a>
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
                        <p><b>Intended influencer personal details:</b></p>
                        <div class="alert-message"></div>
                        <form id="registrationForm" method="POST" class="registration-form my-4" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label class="control-label col-md-2" for="firstName">First Name</label>
                                <input type="text" class="form-control col-md-10" id="firstName" placeholder="Enter first name" name="firstName">
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-2" for="middleName">Middle Name</label>
                                <input type="text" class="form-control col-md-10" id="middleName" placeholder="Enter middle name" name="middleName">
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-2" for="lastName">Last Name</label>
                                <input type="text" class="form-control col-md-10" id="lastName" placeholder="Enter last name" name="lastName">
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-2" for="dateOfBirth">Date of Birth</label>
                                <input type="date" class="form-control col-md-10" id="dateOfBirth" placeholder="Enter date of birth" name="dateOfBirth">
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
                                <label class="control-label col-md-2" for="addressLineOne">Address Line 1</label>
                                <input type="text" class="form-control col-md-10" id="addressLineOne" placeholder="Enter address line one" name="addressLineOne">
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-2" for="addressLineTwo">Address Line 2</label>
                                <input type="text" class="form-control col-md-10" id="addressLineTwo" placeholder="Enter address line two" name="addressLineTwo">
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-2" for="city">City</label>
                                <input type="text" class="form-control col-md-10" id="city" placeholder="Enter city" name="city">
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-2" for="pincode">Pincode</label>
                                <input type="text" class="form-control col-md-10" id="pincode" placeholder="Enter pincode" name="pincode">
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p>I have solemnly agreed upon to become Influencer / Super Influencer for hypermartindia for marketing and sale of their online e-commerce venture i.e. <a target="_blank" href="http://www.hypermartindia.com">http://www.hypermartindia.com</a> . I understand it is my responsibility to ensure the registration of customers I bring in with my influencer code to avail commercial benefit arising out of each customer I bring in.</p>
                                    <p>I have read and understood the terms and conditions (below) and assure you the compliance to the same.</p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-2" for="kycUpload">KYC Documents</label>
                                <div class="col-md-10">
                                    <div class="row">
                                        <select class="form-control col-md-4" name="typeOfKyc[]">
                                            <option value="passport">Passport</option>
                                            <option value="drivingLicence">Driving Licence</option>
                                            <option value="adharCard">Adhar Card</option>
                                            <option value="voterId">Voter Id</option>
                                            <option value="panCard">Pan Card</option>
                                        </select>
                                        <input type="file" class="ml-2" id="kycUpload" name="kycUpload[]">
                                    </div>
                                    <div id="dvContainer">
                                    </div>
                                    <div class="row">
                                        <a href="#" type="button" id="btnAdd" class="add_more_button mt-3 btn btn-info">Add More files</a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-2" for="bankName">Bank Name</label>
                                <input type="text" class="form-control col-md-10" id="bankName" placeholder="Enter bank name" name="bankName">
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-2" for="bankAddress">Address of bank</label>
                                <input type="text" class="form-control col-md-10" id="bankAddress" placeholder="Enter bank address" name="bankAddress">
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-2" for="accountType">Acocunt type</label>
                                <input type="text" class="form-control col-md-10" id="accountType" placeholder="Enter account type" name="accountType">
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-2" for="accountNumber">Account Number</label>
                                <input type="text" class="form-control col-md-10" id="accountNumber" placeholder="Enter bank account number" name="accountNumber">
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-2" for="ifscCode">IFSC code</label>
                                <input type="text" class="form-control col-md-10" id="ifscCode" placeholder="Enter ifsc code" name="ifscCode">
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-2" for="signature">Signature</label>
                                <input type="file" class="" id="signature" name="signature">
                            </div>
                            <div id="influencerDiv" class="form-group row">
                                <label class="control-label col-md-2" for="superInfluencers">Super Influencer</label>
                                <select class="form-control col-md-10" name="superInfluencers">
                                    <option value="">Select Super Influencer</option>
                                    <?php
                                        $collection=$db->superInfluencerRegister;
                                        $superInfluencers=$collection->find();
                                        foreach ($superInfluencers as $superInfluencer) { ?>
                                            <option name="" value="<?php echo $superInfluencer['_id']?>">
                                                <?php echo $superInfluencer['firstName']." ".$superInfluencer['middleName']." ".$superInfluencer['lastName']?>
                                            </option>
                                        <?php }
                                    ?> 
                                </select>
                            </div>
                            <p><b>Teerms and conditions</b></p>
                            <div class="terms-list">
                                <ol>
                                    <li>Hypermartindia will issue Influencer/Super Influence id.</li>
                                    <li>It is Influencers and Super Influencers responsibility to register customers online.</li>
                                    <li>Influencers and super influencers are requested to ensure the entry of their respective id in “influencer id” field while registering customer online </li>
                                    <li>Influencers will be allocated to only one Super Influencer at any point in time. </li>
                                    <li>Transfers of Influencers between Super Influencers are not allowed.</li>
                                    <li>Influencers and Super Influencers are not permitted to commit any discount to customers.  All discounts are published in the portal <a target="_blank" href="http://www.hypermartindia.com">http://www.hypermartindia.com</a> .</li>
                                    <li>Monthly commission will be calculated based on the commission rate calculation provided and published.</li>
                                    <li>The commission will be paid on or before 10th of next calendar month for the current month transactions by customers.</li>
                                    <li>Influencers and Super Influencers must purchase items worth Rs.2000.00 from <a target="_blank" href="http://www.hypermartindia.com">http://www.hypermartindia.com</a> every month.</li>
                                </ol>
                            </div>
                            <button type="submit" class="btn btn-success registerBtn">Register</button>
                            <a href="dashboard.php" class="btn btn-default cancel ml-3">Cancel</a>
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
    <script src="../assets/js/influencerform.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
        
        $(document).ready(function() {
            var max_fields_limit = 5; 
            var x = 1;
            $('.add_more_button').click(function(e) { 
                e.preventDefault();
                if(x < max_fields_limit) { 
                    x++; 
                    $('#dvContainer').append('<div class="row mt-3">' +
                        '<select class="form-control col-md-4" name="typeOfKyc[]">' +
                            '<option value="passport">Passport</option>'+
                            '<option value="drivingLicence">Driving Licence</option>'+
                            '<option value="adharCard">Adhar Card</option>'+
                            '<option value="voterId">Voter Id</option>'+
                            '<option value="panCard">Pan Card</option>'+
                        '</select>'+
                        '<input type="file" class="ml-2" id="kycUpload'+x+'" name="kycUpload[]">' +
                        '<a href="#" class="remove_field btn btn-danger ml-4" style="margin-left:10px;">Remove</a>' + 
                    '</div>');
                }
            });  
            $('#dvContainer').on("click",".remove_field", function(e) { 
                e.preventDefault(); $(this).parent('div').remove(); x--;
            })
        });
    </script>
  </body>
</html>