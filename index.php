<?php
  if(session_status()===PHP_SESSION_NONE) session_start();
  include_once"data/dbConnection.php";
?>
<?php
 if (isset($_POST['search'])) {
   $response   = '<ul class="list-group mt-3 text-center ">
                   <li class="list-group-item text-danger alert alert-danger" role="alert">No country found!</li>
                 </ul>';
   $q =  $_POST['q'];
   $stmt = $pdo->query("SELECT nom FROM user WHERE nom LIKE '%$q%' OR email LIKE '%$q%' OR phone LIKE '%$q%'");
     $response = '<ul class="list-group mt-3">';
     while ($data = $stmt->fetch()){
       $response .= '<a type="button" href="#"><li class="list-group-item">'. $data["nom"] . '</li></a>';
     }
     $response .= '</ul>';
   exit($response);
 }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include_once"pages/head.php" ?>
  </head>
  <body>
    <div class="text-center mt-5 ftco-animate">
      <h2 class="mb-5">My userList- <small class="form-text text-muted text-primary">list.</small></h2>
    </div>
    <div class="d-flex">
      <a type="button" href="insert.php" class="btn btn-primary mb-4 ml-3">Add new user</a>
      <a type="button" href="status.php" class="btn btn-primary mb-4 ml-3  ">Status</a>
       <form>
          <div class="form-group ml-3">
            <input class="form-control" type="search" aria-label="Search" placeholder="Search" id="searchBox">
          </div>
        </form>
    </div>
    <table class="table ml-3 mr-3 mb-5">
      <thead>
        <tr>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Phone</th>
          <th scope="col">Photo</th>
          <th scope="col">Status</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody id="searchBox">
         <div id="response"></div>
          <?php
              try{
          			 $stmt = $pdo->query("SELECT * FROM user WHERE status=1  ORDER BY id DESC");
          			 while ($row   =  $stmt->fetch()) {
          			 $email        =  $row["email"];
                 $nom          =  $row["nom"];
          			 $image        =  $row["photo"];
          			 $id1          =  $row["id"];
                 $phone        =  $row['phone'];
          			 $status       =  $row['status'];
          			 $image_src    =  "data/fileUpload/photo/".$image;
                  if(strlen($description)>20 ){
          				 $description = substr_replace($row["description"], " ... <a class=\"text-uppercase\" href=\"readDescription.php?id=$id1\">Lire Plus</a>", 20);
          			 }else{
          				 $description= $row["description"];
          			 }
          		    ?>
                  <tr>
                  <td><?php echo $nom ?></td>
                  <td><?php echo $email ?></td>
                  <td><?php echo $phone ?></td>
                  <td><img height="40px" width="40px"  loading="lazy" src="<?php echo $image_src ?>" alt="<?php echo $nom ?>">
                  </td>
                  <td><a href="#" class="btn btn-primary"><i class="far fa-check-circle"></i></a></td>
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
    </table>
     <?php include_once"pages/links.php"; ?>
     <script type="text/javascript">
           $(document).ready(function () {
               $("#searchBox").keyup(function () {
                   var query = $("#searchBox").val();
                   if (query.length > 0) {
                       $.ajax(
                           {
                               url: 'index.php',
                               method: 'POST',
                               data: {
                                   search: 1,
                                   q: query
                               },
                               success: function (data) {
                                   $("#response").html(data);
                               },
                               dataType: 'text'
                           }
                       );
                   }else {
                     $("#response").html("");
                   }
               });
               $(document).on('click', 'li', function () {
                   var country = $(this).text();
                   $("#searchBox").val(country);
                   $("#response").html("");
               });
           });
   //data from the table
      $(document).ready(function(){
        $("#searchBox").on("keyup", function() {
          var value = $(this).val().toLowerCase();
          $("#searchBox tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
          });
        });
      });
  </script>
  </body>
</html>
