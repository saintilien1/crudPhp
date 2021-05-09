<?php
  if(session_status()===PHP_SESSION_NONE) session_start();
  include_once"data/dbConnection.php";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include_once"pages/head.php" ?>
    <style>
    .center{
      margin-left: 30% !important;
      margin-right: 30% !important;
    }
    @media screen and (max-width: 600px) {
      .center{
        margin-left: 30% !important;
        margin-right: 30% !important;
      }
      .form{
        width: 90% !important;
      }
    }
    .form{
      width: 50%;
    }
    img {
      border-radius: 50%;
    }
    </style>
  </head>
  <body>
    <div class="text-center mt-5 ftco-animate">
      <i class="fas fa-user"></i>
      <h2>My userList- <small class="form-text text-muted text-primary">Add new user.</small></h2>
      <?php
        if(isset($_SESSION['msg'])){
          echo '<div class="alert alert-success center" role="alert">
             '.$_SESSION['msg'].'
          </div>';
          unset($_SESSION['msg']);
        }else if($_SESSION['error']){
          echo '<div class="alert alert-danger center" role="alert">
             '.$_SESSION['error'].'
          </div>';
          unset($_SESSION['error']);
        }
      ?>
    </div>
   <a type="button" href="index.php" class="btn btn-primary mb-4 ml-3 mr-3 center">User List</a>
   <form class="mb-5 ftco-animate center" method="POST" enctype="multipart/form-data" action="data/insertUser.php">
    <div class="form-group">
      <label for="city">Full name</label>
      <input type="text" name="nom" class="form-control" id="city" placeholder="Jhon Doe">
    </div>
    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" name="email" class="form-control" id="email" placeholder="qwerty@email.com">
    </div>
    <div class="form-group">
      <label for="picture">Picture</label>
      <input type="file" name="file" class="form-control" id="picture">
    </div>
    <div class="form-group">
      <label for="phone">Phone Number</label>
      <input type="number" name="phone" class="form-control" id="phone" placeholder="0012424000000">
      <input type="hidden" name="status"  value="1" >
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
  </form>
     <?php include_once"pages/links.php"; ?>
  </body>
</html>
