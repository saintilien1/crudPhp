<?php
include"dbConnection.php";
if(session_status()===PHP_SESSION_NONE) session_start();
  $id=$_GET["id"];
  $status = $_GET['status'];
  if($status==1){
    $status =0;
  }else {
    $status=1;
  }
   try{
         $stmt = $pdo->prepare("UPDATE `user` SET `status`='".$status."' WHERE `id`='".$id."'");
          // Execute the prepared statement
          $stmt->execute();
          $_SESSION["msg"]="Status change";
          header("location:../index.php");
      } catch(PDOException $e){
          die("ERROR: Could not able to execute $sql. " . $e->getMessage());
      }
 unset($pdo);
?>
