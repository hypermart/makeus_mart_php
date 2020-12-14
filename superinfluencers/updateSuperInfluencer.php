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
                    <a href="../influencers/dashboard.php">Influencers</a>
                </li>
                <li>
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
                                <li class="nav-item active" style="cursor: pointer;">
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

            <div class="container">
                <div class="row">
                    <div class="col-md-12 mx-auto">
                        <p><b>Edit Super influencer personal details:</b></p>
                        <div class="alert-message"></div>
                        <?php 
                            $id=$_REQUEST['id'];
                            $collection = $db->superInfluencerRegister;
                            $query = array("superInfluencerCode" => $id);
                            $superInfluencers = $collection->find($query); 
                            if($superInfluencers) {
                                foreach ($superInfluencers as $superInfluencer) { ?>
                                    <form id="<?php echo $superInfluencer['superInfluencerCode'] ?>" class="editForms" name="editSuperInfluencerForm" method="POST" enctype="multipart/form-data">
                                        <div class="form-group row">
                                            <input type="hidden" class="form-control col-md-10" id="superInfluencerCode" placeholder="Enter first name" name="superInfluencerCode" value="<?php echo $superInfluencer['superInfluencerCode'] ?>">
                                        </div>    
                                        <div class="form-group row">
                                            <label class="control-label col-md-2" for="firstName">First Name</label>
                                            <input type="text" class="form-control col-md-10" id="firstName" placeholder="Enter first name" name="firstName" value="<?php echo $superInfluencer['firstName'] ?>">
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-2" for="middleName">Middle Name</label>
                                            <input type="text" class="form-control col-md-10" id="middleName" placeholder="Enter middle name" name="middleName" value="<?php echo $superInfluencer['middleName'] ?>">
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-2" for="lastName">Last Name</label>
                                            <input type="text" class="form-control col-md-10" id="lastName" placeholder="Enter last name" name="lastName" value="<?php echo $superInfluencer['lastName'] ?>">
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-2" for="dateOfBirth">Date of Birth</label>
                                            <input type="date" class="form-control col-md-10" id="dateOfBirth" placeholder="Enter date of birth" name="dateOfBirth" value="<?php echo $superInfluencer['dateOfBirth'] ?>">
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-2" for="email">Email</label>
                                            <input type="email" class="form-control col-md-10" id="email" placeholder="Enter email" name="email" value="<?php echo $superInfluencer['email'] ?>">
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-2" for="mobileNo">Mobile No</label>
                                            <input type="text" class="form-control col-md-10" id="mobileNo" placeholder="Enter mobile no" name="mobileNo" value="<?php echo $superInfluencer['mobileNo'] ?>">
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-2" for="addressLineOne">Address Line 1</label>
                                            <input type="text" class="form-control col-md-10" id="addressLineOne" placeholder="Enter address line one" name="addressLineOne" value="<?php echo $superInfluencer['addressLineOne'] ?>">
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-2" for="addressLineTwo">Address Line 2</label>
                                            <input type="text" class="form-control col-md-10" id="addressLineTwo" placeholder="Enter address line two" name="addressLineTwo" value="<?php echo $superInfluencer['addressLineTwo'] ?>">
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-2" for="city">City</label>
                                            <input type="text" class="form-control col-md-10" id="city" placeholder="Enter city" name="city" value="<?php echo $superInfluencer['city'] ?>">
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-2" for="pincode">Pincode</label>
                                            <input type="text" class="form-control col-md-10" id="pincode" placeholder="Enter pincode" name="pincode" value="<?php echo $superInfluencer['pincode'] ?>">
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-2">KYC Documents</label>
                                            <div class="col-md-10">
                                                <div class="row">
                                                    <?php 
                                                        $kycDocuments = $superInfluencer['kycDocument'];
                                                        if(count($kycDocuments) !== 0) { ?>
                                                            <table class="table table-bordered">
                                                                <thead>
                                                                    <th>Doument type</th>
                                                                    <th>Document</th>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                        
                                                                        foreach($kycDocuments as $kycDocumentName => $kycdocument) {
                                                                            $ext = pathinfo($kycdocument, PATHINFO_EXTENSION);
                                                                            $baseName = pathinfo($kycdocument, PATHINFO_BASENAME);
                                                                            echo '<tr>';
                                                                            echo '<td>'.$kycDocumentName.'</td>';
                                                                            if($ext == 'pdf') {
                                                                                echo '<td><a href='.$kycdocument.' target="_blank">'.$baseName.'</td>';
                                                                            } else {
                                                                                echo '<td><a href='.$kycdocument.' target="_blank">'.$baseName.'</td>';
                                                                            }
                                                                            echo '</tr>';
                                                                        }
                                                                    ?>
                                                                </tbody>
                                                            </table>
                                                    <?php } ?>
                                                </div>
                                                <div class="row kycdoc mt-2">
                                                    <div class="col-md-4 pl-0">
                                                        <select class="form-control" name="typeOfKyc[]">
                                                            <option value="">Select Document Type</option>
                                                            <option value="passport">Passport</option>
                                                            <option value="drivingLicence">Driving Licence</option>
                                                            <option value="adharCard">Adhar Card</option>
                                                            <option value="voterId">Voter Id</option>
                                                            <option value="panCard">Pan Card</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="file" class="kycUpload" id="kycUpload" name="kycUpload[]">
                                                    </div>
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
                                            <input type="text" class="form-control col-md-10" id="bankName" placeholder="Enter bank name" name="bankName" value="<?php echo $superInfluencer['bankName'] ?>">
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-2" for="bankAddress">Address of bank</label>
                                            <input type="text" class="form-control col-md-10" id="bankAddress" placeholder="Enter bank address" name="bankAddress" value="<?php echo $superInfluencer['bankAddress'] ?>">
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-2" for="accountType">Acocunt type</label>
                                            <input type="text" class="form-control col-md-10" id="accountType" placeholder="Enter account type" name="accountType" value="<?php echo $superInfluencer['accountType'] ?>">
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-2" for="accountNumber">Account Number</label>
                                            <input type="text" class="form-control col-md-10" id="accountNumber" placeholder="Enter bank account number" name="accountNumber" value="<?php echo $superInfluencer['accountNumber'] ?>">
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-2" for="ifscCode">IFSC code</label>
                                            <input type="text" class="form-control col-md-10" id="ifscCode" placeholder="Enter ifsc code" name="ifscCode" value="<?php echo $superInfluencer['ifscCode'] ?>">
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-2" for="signature">Signature</label>
                                            <div class="col-md-4 pl-0">
                                                <input type="file" class="signature" id="signature" name="signature">
                                            </div>
                                            <div class="col-md-4 pl-0">
                                                <img src="<?php echo $superInfluencer['signature'] ?>" alt="signature" width="30%">
                                            </div>
                                        </div>
                                        <input type="submit" name="registerBtn" id="registerBtn" class="btn btn-success registerBtn" value="Update">
                                        <a href="superInfluencerData.php" class="btn btn-default cancel ml-3">Cancel</a>
                                    </form>
                                <?php  }     
                             } else {
                                echo "not exists";
                            } ?>
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
    <script src="../assets/js/script.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var max_fields_limit = 5; 
            var x = 1;
            $('.add_more_button').click(function(e) { 
                e.preventDefault();
                if(x < max_fields_limit) { 
                    x++; 
                    $('#dvContainer').append('<div class="row mt-3">' +
                        '<div class="col-md-4 pl-0">' +
                            '<select class="form-control" name="typeOfKyc[]">' +
                                '<option value="">Select Document Type</option>' +
                                '<option value="passport">Passport</option>'+
                                '<option value="drivingLicence">Driving Licence</option>'+
                                '<option value="adharCard">Adhar Card</option>'+
                                '<option value="voterId">Voter Id</option>'+
                                '<option value="panCard">Pan Card</option>'+
                            '</select>'+
                        '</div>' +
                        '<div class="col-md-4">' +
                            '<input type="file" id="kycUpload'+x+'" name="kycUpload[]">' +
                        '</div>' +
                        '<a href="#" class="remove_field btn btn-danger col-md-2">Remove</a>' + 
                    '</div>');
                }
            });  
            $('#dvContainer').on("click",".remove_field", function(e) { 
                e.preventDefault(); $(this).parent('div').remove(); x--;
            })
        });
        $(document).ready(function(e){
            $("form[name='editSuperInfluencerForm']").validate({
                rules:{
                    firstName: "required",
                    lastName: "required",
                    middleName: "required",
                    dateOfBirth: "required",
                    'email':{
                        email: true,
                        required: true
                    },
                    'mobileNo':{
                        required : true,
                        minlength:10
                    },
                    addressLineOne: "required",
                    addressLineTwo: "required",
                    city: "required",
                    pincode: "required",
                    bankName: "required",
                    bankAddress: "required",
                    accountType: "required",
                    accountNumber: "required",
                    ifscCode: "required"
                },
                messages: {
                    firstName:"Please fill first name",
                    middleName:"Please fill middle name",
                    lastName:"Please fill last name",
                    dateOfBirth:"Please fill date of birth",
                    email:{
                        email:"Enter valid email",
                        required:"Enter email address"
                    },
                    mobileNo:{
                        minlength:"Please enter valid mobile no.",
                        required:"Please enter mobile no."
                    },
                    addressLineOne: "Please enter address line one",
                    addressLineTwo: "Please enter address line two",
                    city: "Please enter city",
                    pincode: "Please enter pincode",
                    bankName: "Please enter bank name",
                    bankAddress: "Please enter bank address",
                    accountType: "Please enter account type",
                    accountNumber: "Please enter account number",
                    ifscCode: "Please enter ifsc code"
                },
                submitHandler: function (form) {
                    var formData = new FormData(form);
                    $.ajax({
                        type: 'POST',
                        url: 'editSuperInfluencer.php',
                        data: formData,
                        dataType: 'json',
                        contentType: false,
                        cache: false,
                        processData:false,
                        success: function(response){ 
                            console.log("Response is" + JSON.stringify(response));
                            window.location = "superInfluencerData.php";
                            $(".alert-message").html('<div class="alert alert-success alert-dismissible fade show">' +
                                    '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                    'Form is successfully submitted' +
                                '</div>');
                        },
                        error: function(err) {
                            console.log("Error is " + JSON.stringify(err));
                            $(".alert-message").html('<div class="alert alert-danger alert-dismissible fade show">' +
                                    '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                    'Something went wrong' +
                                '</div>');
                        }
                    });
                }
            });  
        });
    </script>
  </body>
</html>