<?php

include_once 'library/auth.php';
require 'library/user.php';
require 'library/posts.php';
require 'vendor/autoload.php';

use Carbon\Carbon;

if(isset($_COOKIE['username']) and isset($_COOKIE['token']) and isset($_GET['username'])){
  if(!verify_session($_COOKIE['username'], $_COOKIE['token']))
    header("Location: index.php");
} else {
  header("Location: index.php");
}



if(isset($_GET['post'])){
  if(isset($_POST['body']) and isset($_FILES['image'])){
    $target_directory = 'images/';
    $image_type = pathinfo(basename($_FILES['image']['name']))['extension'];
    $target_file = $target_directory . md5(basename($_FILES['image']['name'])) . '_'.time().'.'.$image_type;

    if(strtolower($image_type) == 'jpg' or strtolower($image_type) == "png" or strtolower($image_type) == "jpeg"){
      if(file_exists($target_file)){
        die('File already exists');
      } else {
        if(move_uploaded_file($_FILES['image']['tmp_name'], $target_file)){
          if(do_post($_POST['body'], $target_file, $_COOKIE['username']))
            header("Location: index.php");
        } else {
          die('Error uploading file');
        }
      }
    } else {
      die("Invalid file type");
    }
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
  <title>Album example · Bootstrap v5.0</title>

  <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/album/">



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

    h1.nav-link {
      color: red;
    }
    .typewriter h1{
  overflow: hidden; /* Ensures the content is not revealed until the animation */
  border-right: .15em solid orange; /* The typwriter cursor */
  white-space: nowrap; /* Keeps the content on a single line */
  margin: 0 auto; /* Gives that scrolling effect as the typing happens */
  letter-spacing: .15em; /* Adjust as needed */
  animation: 
    typing 3.5s steps(15, end),
    blink-caret .75s step-end infinite;
}
.container {
  display: inline-block;
}

/* The typing effect */
@keyframes typing {
  from { width: 0% }
  to { width: 25% }
}

/* The typewriter cursor effect */
@keyframes blink-caret {
  from, to { border-color: transparent }
  50% { border-color: orange; }
}
  </style>


</head>
<body>

  <header>
    <div class="navbar navbar-dark bg-light shadow-sm">
      <div class="typewriter container" >
      <a href="#" class="navbar-brand d-flex align-items-center">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true" class="me-2" viewBox="0 0 24 24"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
          <strong>Album</strong>
        </a>
          <?if($_GET['username'] == $_COOKIE['username']){?>
            <h1>Your Posts...</h1>
          <?$user=$_COOKIE['username'];}else{?>
            <h1><?echo $_GET['username']?>'s Posts...</h1>
          <?$user=$_GET['username'];}?>
      </div>
    </div>
  </header>

  <main style="background-color:black">
    <div class="album py-5 bg-black">
      <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
          <?
          $posts = get_user_posts($user);
          foreach($posts as $post){
            $c = Carbon::parse($post['posted_on']);
          ?>
          <form method="POST" action="library/posts.php">
            <div class="col">
              <div class="card shadow-sm">
                <div class="bd-placeholder-img card-img-top" style="height: 255px; width: 100%; background: url(<?=$post['image']?>); background-position: center; background-size: contain;background-repeat: no-repeat;">
                </div>
                <div class="card-body">
                  <p class="card-text"><?=$post['body']?></p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <?if($_GET['username'] == $_COOKIE['username']){?>
                      <button type="submit" class="btn btn-sm btn-outline-danger" name="delete" value="<?=$post['image']?>" value =  >Delete</button>
                      <?}?>
                    </div>
                    <small class="text-muted"><?=$c->diffForHumans()?></small>
                  </div>
                </div>
              </div>
            </div>
          </form>
          <?}?>
        </div>
      </div>
    </div>
  </main>
  <?if($_GET['username'] == $_COOKIE['username']){?>
  <section class="py-7 text-center bg-dark">
      <div class="row py-lg-5">
        <div class="col-lg-6 col-md-8 mx-auto">
          <form method="POST" action="home.php?post" enctype="multipart/form-data">
            <div class="mb-3">
              <textarea class="form-control" id="exampleFormControlTextarea1" rows="1" placeholder="What's on your mind?" name="body"></textarea>
            </div>
            <div class="mb-3">
              <input class="form-control" type="file" id="formFile" name="image">
            </div>
            <div class="mb-3">
              <input class="btn btn-primary" style="width: 100%"  type="submit" value="Post">
            </div>
          </form>
        </div>
      </div>
    </section>
    <?}?>


  <script src="assets/dist/js/bootstrap.bundle.min.js"></script>


</body>
</html>
