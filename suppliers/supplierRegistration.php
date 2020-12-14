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
    <title>Supplier Registration | Hypermartindia</title>

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
                    <a href="../superinfluencers/superInfluencerData.php">Super Influencers</a>
                </li>
                <li>
                    <a href="suppliersData.php">Suppliers</a>
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
                                            <a class="dropdown-item" href="../superinfluencers/superInfluencerRegistration.php">Super Influencer</a>
                                            <a class="dropdown-item" href="supplierRegistration.php">Supplier</a>
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
                        <p><b>Intended supplier personal details:</b></p>
                        <p class="alert-message"></p>
                        <form id="supplierRegistrationForm" method="POST" class="registration-form my-4" enctype="multipart/form-data">
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
                                <label class="control-label col-md-2" for="companyName">Company Name</label>
                                <input type="text" class="form-control col-md-10" id="companyName" placeholder="Enter company name" name="companyName">
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
                                    <p>I/We agree to be a supplier to Makus Mart LLP which carry out their business under <a target="_blank" href="http://www.hypermartindia.com" style="color: #007bff;">http://www.hypermartindia.com</a> for the products and pricing we agree upon as part of the process.  We update the price variation and stock variations time to time, in time to enable Makus Mart LLP plan and strategize their business plan.  We work with Makus Mart LLP to design promotions and discounts for benefit of all parties – Customers, suppliers and Makus Mart LLP.  We are in agreement that tax and other government, legal and regulatory controls will be abide and followed.</p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-2" for="kycUpload">KYC Documents</label>
                                <div class="col-md-10">
                                    <div class="row">
                                        <select class="form-control col-md-4" name="typeOfKyc[]">
                                            <option value="">Select Document Type</option>
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
                            <p><b>Teerms and conditions</b></p>
                            <div class="terms-list">
                                <ol>
                                    <li>Supplier shall provide product description, USPs (Unique Selling points), Cost price to Makus Mart LLP, MRP, GST% and GST HSN code for the product.</li>
                                    <li>Supplier shall extend discounts on festivals and occasions to promote and increase the market share of their product.  Makus Mart LLP needs 4 weeks prior notice to implement the same on their portal.</li>
                                    <li>Prices once signed off can’t be changed without prior concurrence in writing between supplier and Makus Mart LLP.</li>
                                    <li>Any price change will be through written information to Makus Mart LLP through email to the head of sales, Mr. Murali R K whose email id is <a href="mailto:murali.rotti@hypermatindia.com" target="_top" style="color: #007bff;">murali.rotti@hypermatindia.com</a></li>
                                    <li>Suppliers shall inform Makus Mart LLP in case if they foresee any price variation for their product.</li>
                                    <li>All prior approvals from Suppliers’ principles if any is responsibility of suppliers and suppliers are responsible and accountable for any discrepancies and disputes arise out of it.  Further Suppliers indemnify Makus Mart LLP from such inconsistencies and Makus Mart LLP will not take any responsibility and if any damage is done on reputation or monetary, supplier shall compensate the same with appropriate and apt action that is negotiated and agreed between supplier and Makus Mart LLP.</li>
                                    <li>Makus Mart LLP shall adhere to the terms and conditions that are agreed upon with suppliers.</li>
                                    <li>Food products suppliers shall submit the valid FSSAI certificate to Makus Mart LLP and the packaging and printing shall be as per the law of FSSAI regulatory.</li>
                                </ol>
                            </div>
                            <button type="submit" class="btn btn-success registerBtn">Register</button>
                            <a href="suppliersData.php" class="btn btn-default cancel ml-3">Cancel</a>
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
    <script src="https://sdk.amazonaws.com/js/aws-sdk-2.357.0.min.js"></script>
    <script src="../assets/js/supplierForm.js"></script>
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
                            '<option value="">Select Document Type</option>' +
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