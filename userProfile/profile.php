<?php 
    session_start(); 
    if($_SESSION['userName'] == '') {
        header('location:userLogin.php');
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
  <?php include '../config.php'; ?>
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <img src="../assets/images/influe_logo.png">
            </div>

            <ul class="list-unstyled components">
                <li calss="">
                    <a href="userDashboard.php">Dashboard</a>
                </li>
                <li class="active">
                    <a href="profile.php">User Profile</a>
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
                            <li class="nav-item">
                                <a class="nav-link"><?php echo $_SESSION['userName'] ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../auth/userLogout.php">Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="container">
                <div class="row">
                    <div class="col-md-12 mx-auto">
                        <?php if($_SESSION['type'] == 'influencer') { 
                            $collection = $db->influencerRegister;
                            $query = array("influencerCode" =>  $_SESSION['code']);
                            $influencers = $collection->find($query);
                            foreach($influencers as $influencer) { ?>
                                <h3 class="influencer"><?php echo $influencer['firstName']." ".$influencer['middleName']." ".$influencer['lastName']?> </h3>
                                <hr>
                                <h5 class="mb-4">Personal Details</h5>
                                <p><i class="fas fa-calendar-alt"></i> <?php echo $influencer['dateOfBirth'] ?> </p>
                                <p><i class="fas fa-phone"></i> <?php echo $influencer['mobileNo'] ?> </p>
                                <p><i class="fas fa-envelope"></i> <?php echo $influencer['email'] ?> </p>
                                <p><i class="fas fa-map-marker-alt"></i> <?php echo $influencer['addressLineOne'] ?> <?php echo $influencer['addressLineTwo'] ?> <?php echo $influencer['city'] ?> <?php echo $influencer['pincode'] ?></p>
                                <hr>
                                <h5 class="mb-4">Bank Details</h5>
                                <p>Bank Name:  <?php echo $influencer['bankName'] ?> </p>
                                <p>Bank Address:  <?php echo $influencer['bankAddress'] ?> </p>
                                <p>Account Type:  <?php echo $influencer['accountType'] ?> </p>
                                <p>Account Number:  <?php echo $influencer['accountNumber'] ?> </p>
                                <p>IFSC Code:  <?php echo $influencer['ifscCode'] ?> </p>
                                <hr>
                                <h5 class="mb-4">Documents</h5>
                                <?php 
                                $kycDocuments = $influencer['kycDocument'];
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
                            }
                        } elseif($_SESSION['type'] == 'superinfluencer') { 
                            $collection = $db->superInfluencerRegister;
                            $query = array("superInfluencerCode" =>  $_SESSION['code']);
                            $superInfluencers = $collection->find($query);
                            foreach($superInfluencers as $superInfluencer) { ?>
                                <h3 class="superInfluencer"><?php echo $superInfluencer['firstName']." ".$superInfluencer['middleName']." ".$superInfluencer['lastName']?> </h3>
                                <hr>
                                <h5 class="mb-4">Personal Details</h5>
                                <p><i class="fas fa-calendar-alt"></i> <?php echo $superInfluencer['dateOfBirth'] ?> </p>
                                <p><i class="fas fa-phone"></i> <?php echo $superInfluencer['mobileNo'] ?> </p>
                                <p><i class="fas fa-envelope"></i> <?php echo $superInfluencer['email'] ?> </p>
                                <p><i class="fas fa-map-marker-alt"></i> <?php echo $superInfluencer['addressLineOne'] ?> <?php echo $superInfluencer['addressLineTwo'] ?> <?php echo $superInfluencer['city'] ?> <?php echo $superInfluencer['pincode'] ?></p>
                                <hr>
                                <h5 class="mb-4">Bank Details</h5>
                                <p>Bank Name:  <?php echo $superInfluencer['bankName'] ?> </p>
                                <p>Bank Address:  <?php echo $superInfluencer['bankAddress'] ?> </p>
                                <p>Account Type:  <?php echo $superInfluencer['accountType'] ?> </p>
                                <p>Account Number:  <?php echo $superInfluencer['accountNumber'] ?> </p>
                                <p>IFSC Code:  <?php echo $superInfluencer['ifscCode'] ?> </p>
                                <hr>
                                <h5 class="mb-4">Documents</h5>
                                <?php 
                                $kycDocuments = $superInfluencer['kycDocument'];
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
                            } 
                        } else { 
                            $collection = $db->supplierRegister;
                            $query = array("supplierCode" =>  $_SESSION['code']);
                            echo $_SESSION['code'];
                            $suppliers = $collection->find($query);
                            foreach($suppliers as $supplier) { ?>
                                <h3 class="supplier"><?php echo $supplier['firstName']." ".$supplier['middleName']." ".$supplier['lastName']?> </h3>
                                <hr>
                                <h5 class="mb-4">Personal Details</h5>
                                <p><i class="fas fa-calendar-alt"></i> <?php echo $supplier['dateOfBirth'] ?> </p>
                                <p><i class="fas fa-phone"></i> <?php echo $supplier['mobileNo'] ?> </p>
                                <p><i class="fas fa-envelope"></i> <?php echo $supplier['email'] ?> </p>
                                <p><i class="fas fa-building"></i> <?php echo $supplier['companyName'] ?> </p>
                                <p><i class="fas fa-map-marker-alt"></i> <?php echo $supplier['addressLineOne'] ?> <?php echo $supplier['addressLineTwo'] ?> <?php echo $supplier['city'] ?> <?php echo $supplier['pincode'] ?></p>
                                <hr>
                                <h5 class="mb-4">Bank Details</h5>
                                <p>Bank Name:  <?php echo $supplier['bankName'] ?> </p>
                                <p>Bank Address:  <?php echo $supplier['bankAddress'] ?> </p>
                                <p>Account Type:  <?php echo $supplier['accountType'] ?> </p>
                                <p>Account Number:  <?php echo $supplier['accountNumber'] ?> </p>
                                <p>IFSC Code:  <?php echo $supplier['ifscCode'] ?> </p>
                                <hr>
                                <h5 class="mb-4">Documents</h5>
                                <?php 
                                $kycDocuments = $supplier['kycDocument'];
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
                            }
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
    <script>
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
  </body>
</html>