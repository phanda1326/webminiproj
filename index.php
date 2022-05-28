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
    <img class="mb-4" src="assets/brand/logo.jpg" alt="" width="100" height="100">
    <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
    <?php
    if(isset($_GET['error']) and $_GET['error'] == 1){
      ?>
      <div class="alert alert-danger" role="alert">
        There is an error in your credentials. Please check it.
      </div>
      <?php
    }

    if(isset($_GET['success']) and $_GET['success'] == 1){
      ?>
      <div class="alert alert-success" role="alert">
        Signup success, please sign in to continue.
      </div>
      <?php
    }
    ?>
    <label for="inputUsername" class="visually-hidden">Username</label>
    <input type="text" name="username" id="inputUsername" class="form-control" placeholder="Username" required autofocus value=<?echo isset($_GET['username']) ? $_GET['username'] : "" ?>>
    <label for="inputPassword" class="visually-hidden">Password</label>
    <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
    <input type="hidden" id="auth" name="type" value="login">
    <div class="checkbox mb-3">
      <label>
        <input type="checkbox" value="1" name="remember"> Remember me
      </label>
    </div>
    <input class="w-100 btn btn-lg btn-success" type="submit" value="Sign In">

    <a class="mt-1 w-100 btn btn-lg btn-primary" href="signup.php">Sign up</a>
    <p class="mt-5 mb-3 text-muted">&copy; 2017-2020</p>
  </form>
</main>



  </body>
</html>
