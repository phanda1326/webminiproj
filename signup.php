<?php

include 'library/auth.php';

if(isset($_COOKIE['username']) and isset($_COOKIE['token'])){
  if(verify_session($_COOKIE['username'], $_COOKIE['token'])){
    header("Location: home.php");
  }
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
    <h1 class="h3 mb-3 fw-normal">Welcome, Signup :)</h1>
    <?php
    if(isset($_GET['error']) and $_GET['error'] == 1){
      ?>
      <div class="alert alert-danger" role="alert">
       <?php
          $error_m = "Username already exists. Cannot signup.";
          if(isset($_GET['error_m'])){
            $error_m = $_GET['error_m'];
          }
          echo $error_m;
       ?>
      </div>
      <?php
    }
    ?>
    <label for="fullName" class="visually-hidden">Full Name</label>
    <input type="text" name="full_name" id="fullName" class="form-control" placeholder="Full Name" required autofocus value="<?echo isset($_GET['fn']) ? $_GET['fn'] : "";?>">
    <label for="inputPhone" class="visually-hidden">Mobile Number</label>
    <input type="phone" name="mobile" id="inputPhone" class="form-control" placeholder="Mobile Number" required autofocus value="<?echo isset($_GET['mob']) ? $_GET['mob'] : "";?>">
    <br>
    <label for="inputUsername" class="visually-hidden">Username</label>
    <input type="username" name="username" id="inputUsername" class="form-control" placeholder="Username" required autofocus>
    <label for="inputPassword" class="visually-hidden">Password</label>
    <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
    <input type="hidden" id="auth" name="type" value="signup">
    <input class="w-100 btn btn-lg btn-success" type="submit" value="Sign Up">
    <a class="mt-1 w-100 btn btn-lg btn-primary" href="index.php">Sign in</a>
    <p class="mt-5 mb-3 text-muted">&copy; 2017-2020</p>
  </form>
</main>



  </body>
</html>
