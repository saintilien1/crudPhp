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
      <h2 class="mb-5">The big cities of Haiti - <small class="form-text text-muted text-primary">Read description.</small></h2>
    </div>
   <a type="button" href="index.php" class="btn btn-primary mb-4 ml-3 mr-3">List city</a>
    <table class="table ml-3 mr-3 mb-5">
      <thead>
        <tr>
          <th scope="col" class="text-center">Description</th>
        </tr>
      </thead>
      <tbody>
          <?php
                  try{
          			 $stmt = $pdo->query("SELECT description FROM ville WHERE id=".$_GET['id']."");
          			 while ($row   =  $stmt->fetch()) {
          			 $description  =  $row["description"];
          		    ?>
                  <tr>
                  <td class="text-center"><?php echo $description ?></td>
          			 <?php
          				  }
          				 }catch(PDOException $e){
          					 die("ERROR: Could not able to execute $sql. " . $e->getMessage());
          				 }
          				 unset($pdo);
          		 ?>
        </tr>
      </tbody>
      <tfooter>
        <tr>
          <th scope="col" class="text-center">Description</th>
        </tr>
      </tfooter>
    </table>

     <?php include_once"pages/footer.php"; ?>
     <?php include_once"pages/links.php"; ?>
  </body>
</html>
