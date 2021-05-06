<?php
include"dbConnection.php";
if(session_status()===PHP_SESSION_NONE) session_start();
$nom            =$_POST["city"];
$departement    =$_POST["departement"];
$description    =$_POST["description"];
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
     header("Location:../insert.php");
  }elseif(!move_uploaded_file($_FILES['file']['tmp_name'], $targetfolderph)){
      $_SESSION['error']="picture not save";
      header("Location:../insert.php");
  }
}
if(!empty($nom) || ! empty($departement) || ! empty($description)|| ! empty($photo) ){
  $id=$_SESSION["id"];
   try{
     $sql="UPDATE `ville` SET `nom`=:nom,`photo`=:photo,`departement`=:departement,`description`=:description WHERE id=$id";
         $stmt = $pdo->prepare($sql);
          // Bind parameters to statement
          $stmt->bindParam(':nom',                $nom);
          $stmt->bindParam(':photo',          $picture);
          $stmt->bindParam(':departement',$departement);
          $stmt->bindParam(':description',$description);
          // Execute the prepared statement
          $stmt->execute();
          $_SESSION["msg"]="City change";
         header("location:../index.php");
      } catch(PDOException $e){
          die("ERROR: Could not able to execute $sql. " . $e->getMessage());
      }
 }else{
     $_SESSION["error"]="All field are require";
     header("location:../insert.php");
 }


 unset($pdo);
?>
