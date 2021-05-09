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
      <i class="fas fa-user"></i>
      <h2>My userList - <small class="form-text text-muted text-primary">Update User.</small></h2>
      <?php
        if(isset($_SESSION['msg'])){
          echo '<div class="alert alert-success" role="alert">
             '.$_SESSION['msg'].'
          </div>';
          unset($_SESSION['msg']);
        }else if($_SESSION['error']) {
          // code...
          echo '<div class="alert alert-danger" role="alert">
             '.$_SESSION['error'].'
          </div>';
          unset($_SESSION['error']);
        }
      ?>
    </div>
   <a type="button" href="index.php" class="btn btn-primary mb-4 ml-3 mr-3">User List</a>
<?php
$phone        = "";
$nom          = "";
$image        = "";
$id          = "";
$email  = "";
$image_src    = "";
try{
  $stmt = $pdo->query("SELECT * FROM user  WHERE id =".$_GET['id']."");
  while ($row   =  $stmt->fetch()) {
  $phone  =  $row["phone"];
  $nom          =  $row["nom"];
  $image        =  $row["photo"];
  $id          =  $row["id"];
  $email        =  $row['email'];
  $image_src    =  "data/fileUpload/photo/".$image;
   ?>
   <?php
      }
     }catch(PDOException $e){
       die("ERROR: Could not able to execute $sql. " . $e->getMessage());
     }
     unset($pdo);
  ?>
   <form class="mr-3 ml-3 mb-5" method="POST" enctype="multipart/form-data" action="data/updateUser.php">
    <div class="form-group">
      <label for="nom">Full Name</label>
      <input type="text" name="nom" value="<?php echo $nom ?>" class="form-control" id="nom"   placeholder="nom">
    </div>
    <div class="form-group">
      <label for="email">Email</label>
      <input type="text" name="email" value="<?php echo $email ?>" class="form-control" id="email"   placeholder="qwerty@email.com">
    </div>
    <div class="form-group">
      <label for="picture">Picture</label>
      <input type="file" name="file" class="form-control" id="picture">
      <?php
          $_SESSION["image"]=$image;
          $_SESSION["id"]=$id;
       ?>
    </div>
    <div class="form-group">
      <label for="phone">Phone</label>
      <input type="phone" name="phone" value="<?php echo $phone ?>" class="form-control" id="phone" placeholder="phone">
    </div>
    <button type="submit" class="btn btn-primary">Update user</button>
  </form>
     <?php include_once"pages/footer.php"; ?>
     <?php include_once"pages/links.php"; ?>
  </body>
</html>
