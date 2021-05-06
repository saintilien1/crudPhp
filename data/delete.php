<?php
if(session_status()===PHP_SESSION_NONE) session_start();
include"dbConnection.php";
 if(isset($_GET["id"])){
   $image=$_GET["image"];
   try{
       $sql="DELETE FROM `ville` WHERE id=".$_GET['id']."";
       $stmt = $pdo->prepare($sql);
       unlink($image);
       $stmt->execute();
       $_SESSION["msg"]="You come to delete a city";
       header("location:../index.php");
    } catch(PDOException $e){
         die("ERROR: Could not able to execute $sql. " . $e->getMessage());
     }
}else{
  $_SESSION["error"]="You can't delete this person";
  header("location:../index.php");
}
?>
