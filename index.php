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
    <link rel="shortcut icon" href="assets/images/influe_logo.png" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    
  </head>
  <body class="login-page">

    <section >
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-6 banner-image p-0">
            <!-- <img src="banner-1.jpg" alt="banner-image" height="" width="100%"> -->
          </div>
          <div class="col-md-6">
            <div class="form-container">
              <img class="mx-auto text-center d-block my-5" src="assets/images/influe_logo.png">
              <h3 class="text-center">Welcome to Hypermartindia</h3>
              <div class="alert-message"></div>
              <form class="login p-5" id="login" method="POST">
                <div class="form-group">
                  <input type="text" class="form-control login-input" name="userName" placeholder="Please enter username">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control login-input" name="password" placeholder="Please enter password">
                </div>
                <div class="form-group mt-4 pt-3">
                  <button type="submit" class="loginBtn mx-auto d-block text-center">Login</button>
                </div>
              </form>
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
        $("#login").validate({
          rules:{
            userName: "required",
            password: "required"
          },
          messages: {
            userName:"Please fill user name",
            password:"Please fill password name"
          },
          submitHandler: function (form) {
            var formData = new FormData(form);
            $.ajax({
                type: 'POST',
                url: 'auth/login.php',
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
                    alert("Login Successful");
                    window.location = "influencers/dashboard.php";
                  } else {
                    $("#login")[0].reset();
                    $(".alert-message").html('<div class="alert alert-danger alert-dismissible fade show">' +
                            '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                            'Login failed!!' +
                      '</div>');
                  }
                },
                error: function(err) {
                  console.log("Error is" + JSON.stringify(err));
                  $("#login")[0].reset();
                  $(".alert-message").html('<div class="alert alert-danger alert-dismissible fade show">' +
                            '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                            'Login failed, please check username and password' +
                      '</div>');
                }
            });
          }
        });  
      });
    </script>
    
  </body>
</html>