<?php

if(!isset($_GET['username'])){
  header("Location: index.php");
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.79.0">
    <title>Signin Template · Bootstrap v5.0</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">



    <!-- Bootstrap core CSS -->
<link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

    </style>


    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
  </head>
  <body class="text-center">

<main class="form-signin">
  <form action="auth.php" method="POST">
    <img class="mb-4" src="assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
    <h1 class="h3 mb-3 fw-normal">Enter your OTP</h1>
    <?php
    if(isset($_GET['error']) and $_GET['error'] == 1){
      ?>
      <div class="alert alert-danger" role="alert">
       <?php
          $error_m = "Invaid OTP";
          if(isset($_GET['error_m'])){
            $error_m = $_GET['error_m'];
          }
          echo $error_m;
       ?>
      </div>
      <?php
    }
    ?>
    <label for="otp" class="visually-hidden">Enter OTP</label>
    <input type="text" name="otp" id="otp" class="form-control" placeholder="Enter OTP" required autofocus>
    <input type="hidden" id="auth" name="type" value="otp">
    <input type="hidden" id="username" name="username" value="<?=$_GET['username']?>">
    <br>
    <input class="w-100 btn btn-lg btn-success" type="submit" value="Verify">

    <p class="mt-5 mb-3 text-muted">&copy; 2017-2020</p>
  </form>
</main>



  </body>
</html>
