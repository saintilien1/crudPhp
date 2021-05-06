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
      <h2>The big cities of Haiti - <small class="form-text text-muted text-primary">Add new City.</small></h2>
      <p class="text-center  alert alert-dark mr-3 ml-3" role="alert">
        Remplir tout les champs
      </p>
    </div>
   <a type="button" href="index.php" class="btn btn-primary mb-4 ml-3 mr-3">Cities List</a>
<?php
$description  = "";
$nom          = "";
$image        = "";
$id1          = "";
$departement  = "";
$image_src    = "";
try{
  $stmt = $pdo->query("SELECT * FROM ville  WHERE id =".$_GET['id']."");
  while ($row   =  $stmt->fetch()) {
  $description  =  $row["description"];
  $nom          =  $row["nom"];
  $image        =  $row["photo"];
  $id1          =  $row["id"];
  $departement  =  $row['departement'];
  $image_src    =  "data/fileUpload/photo/".$image;
   ?>
   <?php
      }
     }catch(PDOException $e){
       die("ERROR: Could not able to execute $sql. " . $e->getMessage());
     }
     unset($pdo);
  ?>
   <form class="mr-3 ml-3 mb-5" method="POST" enctype="multipart/form-data" action="data/updateDepartement.php">
    <div class="form-group">
      <label for="city">City Name</label>
      <input type="text" name="city" value="<?php echo $nom ?>" class="form-control" id="city"   placeholder="city">

    </div>
    <div class="form-group">
      <label for="departement">Depatement</label>
      <input type="text" name="departement" value="<?php echo $departement ?>" class="form-control" id="departement"   placeholder="Depatement">
    </div>
    <div class="form-group">
      <label for="picture">Picture</label>
      <input type="file" name="file" class="form-control" id="picture">
      <?php
            $_SESSION["image"]=$image;
            $_SESSION["id"]=$id1;
       ?>
    </div>
    <div class="form-group">
      <label for="description">Description</label>
      <input type="text" name="description" value="<?php echo $description ?>" class="form-control" id="description" placeholder="Description">
    </div>
    <button type="submit" class="btn btn-primary">Update city</button>
  </form>
     <?php include_once"pages/footer.php"; ?>
     <?php include_once"pages/links.php"; ?>
  </body>
</html>
