<?php
  if(session_status()===PHP_SESSION_NONE) session_start();
  include_once"data/dbConnection.php";
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
    </style>
  </head>
  <body>
    <div class="text-center mt-5 ftco-animate">
      <i class="fas fa-user"></i>
      <h2 class="mb-5">My userList- <small class="form-text text-muted text-primary">list.</small></h2>
      <?php
        if(isset($_SESSION['msg'])){
          echo '<div class="alert alert-success" role="alert">
             '.$_SESSION['msg'].'
          </div>';
          unset($_SESSION['msg']);
        }else if($_SESSION['error']){
          echo '<div class="alert alert-danger" role="alert">
             '.$_SESSION['error'].'
          </div>';
          unset($_SESSION['error']);
        }
      ?>
    </div>
    <div class="d-flex ftco-animate center">
      <a type="button" href="insert.php" class="btn btn-primary mb-4 ml-3">Add new user</a>
      <a type="button" href="status.php" class="btn btn-primary mb-4 ml-3  ">Status</a>
       <form>
          <div class="form-group ml-3">
            <input class="form-control" type="search" aria-label="Search" placeholder="Search" id="searchBox">
          </div>
        </form>
    </div>
    <table class="table ml-3 mr-3 mb-5 ftco-animate">
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
          			 $id           =  $row["id"];
                 $phone        =  $row['phone'];
          			 $status       =  $row['status'];
          			 $image_src    =  "data/fileUpload/photo/".$image;
          		    ?>
                  <tr>
                  <td><?php echo $nom ?></td>
                  <td><?php echo $email ?></td>
                  <td><?php echo $phone ?></td>
                  <td><img height="40px" width="40px"  loading="lazy" src="<?php echo $image_src ?>" alt="<?php echo $nom ?>">
                  </td>
                  <td><a href="#" class="btn btn-primary"><i class="far fa-check-circle"></i></a></td>
                  <td>
                    <div class="d-flex">
                      <a type="button" href="data/delete.php?id=<?=$id?>&image=<?php echo $image_src ?>" class="btn btn-danger mr-1"><i class="fas fa-trash"></i></a>
                      <a type="button" href="update.php?id=<?=$id?>" style="color:#fff" class="btn btn-warning mr-1"><i class="fas fa-pen-square"></i></a>
                      <a type="button" href="read.php?id=<?=$id?>" class="btn btn-primary mr-1"><i class="fab fa-readme"></i></a>
                    </div>
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
