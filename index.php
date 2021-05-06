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
      <h2 class="mb-5">The big cities of Haiti - <small class="form-text text-muted text-primary">City list.</small></h2>
    </div>
    <div class="d-flex">
      <a type="button" href="insert.php" class="btn btn-primary mb-4 ml-3 mr-3">Add new town</a>
      <form class="form-inline pb-4">
           <input class="mr-sm-2 form-control-sm" id="myInput" type="search" placeholder="Search" aria-label="Search">
       </form>
    </div>

    <table class="table ml-3 mr-3 mb-5">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">name</th>
          <th scope="col">Depatement</th>
          <th scope="col">Photo</th>
          <th scope="col">Description</th>
          <th scope="col">Status</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody id="myInput">
          <?php
                  try{
          			 $stmt = $pdo->query("SELECT * FROM ville  ORDER BY id DESC");
          			 while ($row   =  $stmt->fetch()) {
          			 $description  =  $row["description"];
                 $nom          =  $row["nom"];
          			 $image        =  $row["photo"];
          			 $id1          =  $row["id"];
                 $departement  =  $row['departement'];
          			 $status       =  $row['status'];
          			 $image_src    =  "data/fileUpload/photo/".$image;
                  if(strlen($description)>20 ){
          				 $description = substr_replace($row["description"], " ... <a class=\"text-uppercase\" href=\"readDescription.php?id=$id1\">Lire Plus</a>", 20);
          			 }else{
          				 $description= $row["description"];
          			 }
          		    ?>
                  <tr>
                  <th scope="row"><?php echo $id1 ?></th>
                  <td><?php echo $nom ?></td>
                  <td><?php echo $departement ?></td>
                  <td><img height="40px" width="40px"  loading="lazy" src="<?php echo $image_src ?>" alt="<?php echo $nom ?>">
                  </td>
                  <td><?php echo $description ?></td>
                  <td>
                    <?php
                       if($status==0){
                         ?>
                           <a type="button" href="data/status.php?id=<?=$id1?>&status=<?=$status?>" class="btn btn-danger"><i class="fas fa-thumbs-down"></i></a></td>
                           <?php
                       }else {
                         ?>
                        <a type="button" href="data/status.php?id=<?=$id1?>&status=<?=$status?>" class="btn btn-primary"><i class="fas fa-thumbs-up"></i></a></td>
                        <?php
                       }
                     ?>

                  <td>
                    <a type="button" href="data/delete.php?id=<?=$id1?>&image=<?php echo $image_src ?>" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                    <a type="button" href="update.php?id=<?=$id1?>" style="color:#fff" class="btn btn-warning"><i class="fas fa-pen-square"></i></a>
                  </td>
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
          <th scope="col">#</th>
          <th scope="col">name</th>
          <th scope="col">Depatement</th>
          <th scope="col">Photo</th>
          <th scope="col">Description</th>
          <th scope="col">Action</th>
        </tr>
      </tfooter>
    </table>

     <?php include_once"pages/footer.php"; ?>
     <?php include_once"pages/links.php"; ?>
     <script>
          ClassicEditor
          .create( document.querySelector( '#editor' ) )
          .catch( error => {
              console.error(error);
          });
      </script>

  <script>
  $(".alert").alert('close')
  </script>
    <script>
      $(document).ready(function(){
        $("#myInput").on("keyup", function() {
          var value = $(this).val().toLowerCase();
          $("#myInput tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
          });
        });
      });
  </script>
  </body>
</html>
