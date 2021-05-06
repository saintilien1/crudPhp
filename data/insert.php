<?php
//script php qui permet d'inserer un professeur'
include"dbConnection.php";
include_once"email.php";
if(session_status()===PHP_SESSION_NONE) session_start();
 $attachement = "carte-haiti.jpg";
 $sujet       = "Confirmation de votre inscription";
if(isset($_POST["enregistreProf"])){
    $nom         = $_POST["nom"];
    $email       = $_POST["email"];
    $date        = $_POST["date"];
    $phone       = $_POST["phone"];
    $lieu        = $_POST["lieu"];
    $nif         = $_POST["nif"];
    $GS          = $_POST["GS"];
    $adresse     = $_POST["adresse"];
    $gender      = $_POST["gender"];
    $acces       = $_POST["access"];
    $password    = $_POST["password"];
    $reference   = $_POST["reference"];
    $statue      = $_POST["statue"];
    $nombre      = $_POST['nombre'];
    $maladie     = $_POST['maladie'];
    $statueUser  = "true";
    $cv          = '';
    $photo       = ""; 
    $text        = "$nom, votre compte vient de créer sur le site de l'Institut Le Marien, vous pouvez connecter maintenant à votre compte en cliquant sur ce lien <b>www.institutlemarien.com/index.php</b>, votre mot de passe est <b>12345</b>, vous devez changer votre mot de passe maintenant afin de mieux securiser votre compte.";
    if(!empty($_FILES['cv'])){
        $cv  =  $_FILES['cv']['name'];
    }else{
        $cv = $_FILES['cvEmpty']['name'];
    }
    if(!empty($_FILES['photo'])){
        $photo = $_FILES['photo']['name'];
    }else{
        $photo = $_FILES['photoEmpty']['name'];
    }
   
    $classe     = implode(', ', $_POST["classe"]);
    $matiere    = implode(', ', $_POST['matiere']);
    $niveau     = implode(', ', $_POST['niveau']);
    if($classe== "Choisir la classe" && $statue=="Choisir un statue" && $GS =="Choisir le groupe sanguin" ){
         $_SESSION["error"]="Vous devez choisir la classe, un statue et le groupe sanguin du professeur.";
         header("location:../admin/ajouteProfesseur.php");
    }else{
          if(!empty($nom) && !empty($email) && !empty($date) && !empty($phone) && !empty($classe) && !empty($nif)){
        try{
            $req = $pdo->prepare('SELECT userid FROM user WHERE username=?');
            $req->execute([$_POST['email']]);
            $user = $req->fetch();
            if($user){
                 $_SESSION["error"]="Cet email est déjà utilisé pour un autre compte.";
                 header("location:../admin/ajouteProfesseur.php");
            }else{
                
                $password = password_hash($password, PASSWORD_BCRYPT); 
                $targetfoldercv  = "fileUpload/CV/";
                $uniqId          = uniqid("CV_User",true);
                $targetfoldercv  = $targetfoldercv.$uniqId. basename($_FILES['cv']['name']) ;
                $file_typecv     = $_FILES['cv']['type'];
                $cv              = $uniqId. basename($_FILES['cv']['name']) ; 
                if ($file_typecv=="application/pdf" || $file_typecv=="application/docs" || $file_typecv=="application/txt" || $file_typecv=="image/jpg" || $file_typecv=="application/docs"|| $file_typecv=="application/docx") {

                    if(move_uploaded_file($_FILES['cv']['tmp_name'], $targetfoldercv)){
                        $targetfolderph  = "fileUpload/photo/";
                        $uniqId          = uniqid("Picture_User",true);
                        $targetfolderph  = $targetfolderph.$uniqId.basename( $_FILES['photo']['name']);
                        $file_typeph     = $_FILES['photo']['type'];
                        $photo           = $uniqId.basename( $_FILES['photo']['name']);
                        if ( $file_typeph=="image/gif" || $file_typeph=="image/jpeg" || $file_typeph=="image/jpg"|| $file_typeph=="image/png" || $file_typeph=="image/PNG") {
                            if(move_uploaded_file($_FILES['photo']['tmp_name'], $targetfolderph)){
                                 try{
                                $sql="INSERT INTO `user`(`username`, `password`,`cv`, `phone1`, `urgenceN`, `uname`,`lieu`, `adresse`, `classe`,`niveauProf`,`matiere`, `statue`, `sexe`, `access`, `date`,`nif`, `groupeSanguin`,`maladie`, `nombre_d`,`statueUser`, `picture`) VALUES(:email, :pass, :cv, :phone, :urgence, :nom, :lieu, :adresse, :classe, :niveau, :matiere, :statue, :sexe, :access,:date, :nif, :GS,:maladie,:nombre, :statUser, :photo)";
                                $stmt = $pdo->prepare($sql);
                                 // Bind parameters to statement
                                 $stmt->bindParam(':email',        $email);
                                 $stmt->bindParam(':pass',      $password);
                                 $stmt->bindParam(':cv',              $cv);
                                 $stmt->bindParam(':phone',        $phone);
                                 $stmt->bindParam(':urgence',  $reference);
                                 $stmt->bindParam(':nom',            $nom);
                                 $stmt->bindParam(':lieu',          $lieu);
                                 $stmt->bindParam(':adresse',    $adresse);
                                 $stmt->bindParam(':classe',      $classe);
                                 $stmt->bindParam(':niveau',      $niveau);
                                 $stmt->bindParam(':matiere',    $matiere);
                                 $stmt->bindParam(':statue',      $statue);
                                 $stmt->bindParam(':sexe',        $gender);
                                 $stmt->bindParam(':access',       $acces);
                                 $stmt->bindParam(':date',          $date);
                                 $stmt->bindParam(':nif',            $nif);
                                 $stmt->bindParam(':GS',              $GS);
                                 $stmt->bindParam(':nombre',      $nombre);
                                 $stmt->bindParam(':maladie',    $maladie);
                                 $stmt->bindParam(':statUser',$statueUser);
                                 $stmt->bindParam(':photo',        $photo);
                                 $stmt->execute();
                                 $_SESSION["msg"]="Vous avez ajouté un nouveau professeur.";
                                 sendMail($email, $nom,$sujet,$text);
                                 header("location:../admin/ajouteProfesseur.php");
                             } catch(PDOException $e){
                                 die("ERROR: Could not able to execute $sql. " . $e->getMessage());
                             }
                            }else{
                                $_SESSION['error']="photo not save";
                                header("Location:../admin/ajouteProfesseur.php");
                            }
                    }else{
                        $_SESSION['error']="Photo not uploaded";
                        header("Location:../admin/ajouteProfesseur.php");
                    }
                }else{
                    $_SESSION['error']="CV not save";
                    header("Location:../admin/ajouteProfesseur.php");
                }
        }else{
            $_SESSION['error']="CV not uploaded choose the correct extention";
            header("Location:../admin/ajouteProfesseur.php");
        }
            }
        } catch(PDOException $e){
                 die("ERROR: Could not able to execute $sql. " . $e->getMessage());
             }
    }
  }
 }elseif(isset($_POST['enregistreStudents'])){
    $nom          = $_POST["nom"];
    $classe       = $_POST["classe"];
    $acces        = $_POST["access"];
    $gender       = $_POST["gender"];
    $password     = $_POST["password"];
    $email        = $_POST["email"];
    $date         = $_POST["date"];
    $phone        = $_POST["phone"];
    $personne     = $_POST["personne"];
    $phone1       = $_POST["phone1"];
    $occupation   = $_POST["occupation"];
    $relation     = $_POST["relation"];
    $adresse      = $_POST["adresse"];
    $lieu         = $_POST["lieu"];
    $GS           = $_POST["GS"];
    $maladie      = $_POST['maladie'];
    $comportement = $_POST['comportement'];
    $password     = password_hash($password, PASSWORD_BCRYPT);
    $statueUser   = 'true';
    $text         = "$nom, votre compte vient de créer sur le site de l'Institut Le Marien, vous pouvez connecter maintenant à votre compte en cliquant sur ce lien <b>www.institutlemarien.com/index.php</b>, votre mot de passe est <b>12345</b>, vous devez changer votre mot de passe maintenant afin de mieux securiser votre compte.";
   if($classe== "Choisir la classe" && $GS =="Choisir le groupe sanguin"){
        $_SESSION["error"]="Vous devez choisir la classe et le groupe sanguin de l'etudiant.";
        header("location:../admin/ajouteStudents.php");
   }else{
          if(!empty($nom) && !empty($email) && !empty($date) && !empty($phone1) && !empty($lieu) && !empty($phone) && !empty($adresse)){
               try{
                    $req = $pdo->prepare('SELECT userid FROM user WHERE username=?');
                    $req->execute([$_POST['email']]);
                    $user = $req->fetch();
                    if($user){
                         $_SESSION["error"]="Cet email est déjà utilisé pour un autre compte.";
                         header("location:../admin/ajouteStudents.php");
                    }else{
                           $pictureInfo  = "";
                           $targetfolder = "fileUpload/photo/";
                           $uniqId       = uniqid ("User_picture",true);
                           $targetfolder = $targetfolder.$uniqId.basename($_FILES['file']['name']) ;
                           $file         = $_FILES['file']['name'];
                           $file_type    = $_FILES['file']['type'];
                           $file         = $uniqId.basename($_FILES['file']['name']);
                           if (!$file_type=="image/gif" || !$file_type=="image/jpeg" ||!$file_type=="image/jpg"||!$file_type=="image/png") {
                           if(!move_uploaded_file($_FILES['file']['tmp_name'], $targetfolder)){
                                $pictureInfo = "The picture not uploaded";
                                $file = $attachement;
                           } 
                           } else{
                                $pictureInfo = "You selected a bad picture extention, your picture not uploaded for that";
                                $file = $attachement;
                           }
                          
                       try{
                                $sql="INSERT INTO `user`(`username`, `password`, `uname`, `personneR`,`urgenceN`, `phone1`, `occupation`,`groupeSanguin`, `relation`, `lieu`, `adresse`,  `classe`,   `sexe`, `access`,  `date`, `maladie`,`comportement`,`picture`, `statueUser`) VALUES (:email, :pass, :nom, :personneR, :phone1, :phone, :occupation, :gs, :relation, :lieu, :adresse, :classe, :sexe, :access, :date,:maladie, :comportement,:picture, :statUser)";
                                $stmt = $pdo->prepare($sql);
                                // Bind parameters to statement
                                $stmt->bindParam(':email',              $email);
                                $stmt->bindParam(':pass',            $password);
                                $stmt->bindParam(':nom',                  $nom);
                                $stmt->bindParam(':personneR',       $personne);
                                $stmt->bindParam(':phone1',            $phone1);
                                $stmt->bindParam(':phone',              $phone);
                                $stmt->bindParam(':occupation',    $occupation);
                                $stmt->bindParam(':relation',        $relation);
                                $stmt->bindParam(':lieu',                $lieu);
                                $stmt->bindParam(':adresse',          $adresse);
                                $stmt->bindParam(':classe',            $classe);
                                $stmt->bindParam(':sexe',              $gender);
                                $stmt->bindParam(':gs',                    $GS);
                                $stmt->bindParam(':access',             $acces);
                                $stmt->bindParam(':date',                $date);
                                $stmt->bindParam(':comportement',$comportement);
                                $stmt->bindParam(':maladie',          $maladie);
                                $stmt->bindParam(':picture',             $file);
                                $stmt->bindParam(':statUser',      $statueUser);
                                // Execute the prepared statement
                                $stmt->execute();
                                echo $_SESSION["msg"]="Etudiant ajouté, $pictureInfo";
                                sendMail($email, $nom,$sujet,$text);
                                header("location:../admin/ajouteStudents.php");
                        } catch(PDOException $e){
                            die("ERROR: Could not able to execute $sql. " . $e->getMessage());
                        }         
                   }
           } catch(PDOException $e){
                    die("ERROR: Could not able to execute $sql. " . $e->getMessage());
                }
           }else{
                $_SESSION["error"]="Les champs nom, classe, email, phone, date de naissance, lieu de naissance, adresse sont obligatoire";
                 header("location:../admin/ajouteStudents.php");
           }
   }
 }
?>