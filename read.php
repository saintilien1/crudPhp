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
      margin-left: 35% !important;
    }
    @media screen and (max-width: 600px) {
      .center{
        margin-left: 20% !important;
        margin-right: 5% !important;
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
      <h2 class="mb-5">My userList- <small class="form-text text-muted text-primary">list.</small></h2>
    </div>
    <div class="d-flex center ftco-animate">
            <?php
            $email        ="";
            $nom          ="";
            $image        ="";
            $id           ="";
            $phone        ="";
            $status       ="";
            $image_src    ="";
                try{
                   $stmt = $pdo->query("SELECT * FROM user WHERE id=".$_GET['id']."");
                   while ($row   =  $stmt->fetch()) {
                   $email        =  $row["email"];
                   $nom          =  $row["nom"];
                   $image        =  $row["photo"];
                   $id           =  $row["id"];
                   $phone        =  $row['phone'];
                   $status       =  $row['status'];
                   $image_src    =  "data/fileUpload/photo/".$image;
                       }
                      }catch(PDOException $e){
                        die("ERROR: Could not able to execute $sql. " . $e->getMessage());
                      }
                      unset($pdo);
                  ?>
                    <div class="form ftco-animate">
                    <img height="140px" width="140px" class="center"  loading="lazy" src="<?php echo $image_src ?>" alt="<?php echo $nom ?>">
                     <div class="form-group">
                       <label for="city">Full name</label>
                       <input type="text" value="<?=$nom?>" readonly name="nom" class="form-control" id="city" placeholder="Jhon Doe">
                     </div>
                     <div class="form-group">
                       <label for="email">Email</label>
                       <input type="email" name="email"value="<?=$email?>" readonly class="form-control" id="email" placeholder="qwerty@email.com">
                     </div>
                     <div class="form-group">
                       <label for="phone">Phone Number</label>
                       <input type="number" readonly value="<?=$phone?>" name="phone" class="form-control" id="phone" placeholder="0012424000000">
                     </div>
                     <div class="form-group">
                      <a type="button" href="index.php" class="btn btn-primary form-control">back</a>
                      </div>
                   </div>


    </div>
     <?php include_once"pages/links.php"; ?>
  </body>
</html>
