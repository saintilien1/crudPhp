<?php
  if(session_status()===PHP_SESSION_NONE) session_start();
  include_once"data/dbConnection.php";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include_once"pages/head.php" ?>
  </head>
  <body>
    <div class="text-center mt-5 ftco-animate">
      <h2>My userList- <small class="form-text text-muted text-primary">Add new user.</small></h2>
    </div>
   <a type="button" href="index.php" class="btn btn-primary mb-4 ml-3 mr-3">User List</a>
   <form class="mr-3 ml-3 mb-5" method="POST" enctype="multipart/form-data" action="data/insertUser.php">
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
