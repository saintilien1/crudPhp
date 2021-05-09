<?php
include"dbConnection.php";
if(session_status()===PHP_SESSION_NONE) session_start();
$id             =$_SESSION["id"];
$nom            =$_POST["nom"];
$email          =$_POST["email"];
$phone          =$_POST["phone"];
$photo          =$_FILES["file"]['name'];
if(empty($photo)){
  $picture = $_SESSION["image"];
}else {
  $uniqId           = uniqid ("city",true);
  $targetfolderph   = "fileUpload/photo/";
  $targetfolderph   = $targetfolderph.$uniqId.basename($_FILES['file']['name']);
  $file_type        = $_FILES['file']['type'];
  $picture          = $uniqId.basename($_FILES['file']['name']);
  if (!$file_type=="image/gif" || !$file_type=="image/jpeg" || !$file_type=="image/JPEG" || !$file_type=="image/PNG" || !$file_type=="image/png" || !$file_type=="image/jpg" || !$file_type=="image/JPG") {
     $_SESSION['error']="Photo not uploaded";
     header("location:../update.php?id=$id");
  }elseif(!move_uploaded_file($_FILES['file']['tmp_name'], $targetfolderph)){
      $_SESSION['error']="picture not save";
      header("location:../update.php?id=$id");
  }
}
 if(strlen($nom)==0 || strlen($email)==0|| strlen($phone)==0){
   $_SESSION["error"]="All field are require";
   header("location:../update.php?id=$id");
 }else{
    try{
      $sql="UPDATE `user` SET `nom`=:nom,`photo`=:photo,`email`=:email,`phone`=:phone WHERE id=$id";
          $stmt = $pdo->prepare($sql);
           // Bind parameters to statement
           $stmt->bindParam(':nom',      $nom);
           $stmt->bindParam(':photo',$picture);
           $stmt->bindParam(':email',  $email);
           $stmt->bindParam(':phone',  $phone);
           // Execute the prepared statement
           $stmt->execute();
           $_SESSION["msg"]="Information User change";
          header("location:../update.php?id=$id");
       } catch(PDOException $e){
           die("ERROR: Could not able to execute $sql. " . $e->getMessage());
       }
 }
 unset($pdo);
?>
