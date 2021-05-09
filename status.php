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
      <h2 class="mb-5">My userList - <small class="form-text text-muted text-primary">status.</small></h2>
    </div>
   <a type="button" href="index.php" class="btn btn-primary mb-4 ml-3 mr-3">List user</a>
    <table class="table ml-3 mr-3 mb-5">
      <thead>
        <tr>
          <th scope="col" class="text-center">Status</th>
          <th scope="col" class="text-center">Full name</th>
        </tr>
      </thead>
      <tbody>
          <?php

                  try{
          			 $stmt = $pdo->query("SELECT  `id`,`nom`,  `status` FROM `user`");
          			 while ($row   =  $stmt->fetch()) {
                   $status     =  $row["status"];
                   $nom        =  $row["nom"];
          			   $id         =  $row["id"];
          		    ?>
                  <tr>
                  <td class="text-center">
                    <?php
                    if($status==1){
                      ?>
                       <a type="button" href="data/status.php?id=<?=$id?>&status=<?=$status?>" class="btn btn-primary"><i class="fas fa-thumbs-up"></i></a>
                      <?php
                    }else{
                      ?>
                      <a type="button" href="data/status.php?id=<?=$id?>&status=<?=$status?>" class="btn btn-danger"><i class="fas fa-thumbs-down"></i></a></td>
                  <?php
                    }
                    ?>
                  </td>
                  <td class="text-center"><?php echo $nom ?></td>
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
