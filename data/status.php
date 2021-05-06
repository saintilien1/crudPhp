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
     $sql="UPDATE `ville` SET `status`=:status WHERE id=$id";
         $stmt = $pdo->prepare($sql);
          // Bind parameters to statement
          $stmt->bindParam(':status',            $status);
          // Execute the prepared statement
          $stmt->execute();
          $_SESSION["msg"]="City change";
         header("location:../index.php");
      } catch(PDOException $e){
          die("ERROR: Could not able to execute $sql. " . $e->getMessage());
      }
 unset($pdo);
?>
