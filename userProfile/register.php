<?php session_start(); ?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <!-- <script>
      window.history.forward();
    </script> -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Hypermartindia</title>
    <link rel="shortcut icon" href="../assets/images/influe_logo.png" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style.css">
    
  </head>
  <body class="auth-page">

    <section >
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-6 banner-image p-0">
            <!-- <img src="banner-1.jpg" alt="banner-image" height="" width="100%"> -->
          </div>
          <div class="col-md-6">
            <div class="form-container">
              <img class="mx-auto text-center d-block my-5" src="../assets/images/influe_logo.png">
              <h3 class="text-center">Create <?php echo $_REQUEST['type'] ?> Profile</h3>
              <div class="alert-message"></div>
                <form class="register p-4" id="register" method="POST">
                <input type="hidden" class="form-control register-input" name="userType" value="<?php echo $_REQUEST['type'] ?>">
                <div class="form-group">
                  <input type="text" class="form-control register-input" name="userName" placeholder="Enter username">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control register-input" name="password" placeholder="Enter password">
                </div>
                <div class="form-group">
                    <?php if($_REQUEST['type'] == 'influencer') { ?>
                        <input type="text" class="form-control register-input" name="code" placeholder="Enter influencer id">
                    <?php } elseif($_REQUEST['type'] == 'superinfluencer') { ?>
                        <input type="text" class="form-control register-input" name="code" placeholder="Enter super influencer id">
                    <?php } else { ?>
                        <input type="text" class="form-control register-input" name="code" placeholder="Enter supplier id">
                    <?php } ?>
                </div>
                <div class="form-group mt-4 pt-3">
                  <button type="submit" class="registerBtn mx-auto d-block text-center">Create</button>
                </div>
              </form>
              <p class="text-center">If you have already creted a profile, please <a href="userLogin.php" style="color: #007bff;">login here</a></p>
            </div>
            <footer class="footer">
              <p>&copy; 2020 hypermartindia</p>
            </footer>
          </div>
        </div>
      </div>
    </section>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>

    <script>
      $(document).ready(function(e) {
        $.validator.addMethod("noSpace", function(value, element) { 
          return value.indexOf(" ") < 0 && value != ""; 
        }, "No space please and don't leave it empty");

        $("#register").validate({
          rules:{
            userName: {
              required: true,
              minlength: 3,
              noSpace: true
            },
            password: "required",
            code: "required"
          },
          messages: {
            userName: "Please specify your name (only letters and spaces are allowed)",
            password: "Please fill password name",
            code: "Please fill id"
          },
          submitHandler: function (form) {
            var formData = new FormData(form);
            $.ajax({
                type: 'POST',
                url: 'userRegister.php',
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
                    console.log("Username alerady exists");
                    $("#register")[0].reset();
                    $(".alert-message").html('<div class="alert alert-danger alert-dismissible fade show">' +
                            '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                            'User name already exists, please select other name' +
                      '</div>');
                  } else {
                    $("#register")[0].reset();
                    $(".alert-message").html('<div class="alert alert-success alert-dismissible fade show">' +
                            '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                            'Regsitered successfully' +
                      '</div>');
                  }
                },
                error: function(err) {
                  console.log("Error is" + JSON.stringify(err));
                  $("#register")[0].reset();
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