<?php
session_start();
require 'php/connexion.php';
// connexion a la BD 
$bdd = new connexion();


if (isset($_POST['ok'])){ 
   $pseudoconnect = htmlspecialchars($_POST['username']);
   $mdpconnect = sha1($_POST['password']);
   
   if(!empty($pseudoconnect) AND !empty($mdpconnect)) // si les champs ne snt pas vide
   { 
       $reqUser = $bdd->getConnexion()->prepare("SELECT * FROM membre WHERE pseudo = ? AND pass = ?");
       $reqUser->execute(array($pseudoconnect,$mdpconnect));
       $userExist = $reqUser->rowCount(); // compte le nombre de ligne retourné
       
       if ($userExist == 1)  // si l'utilisateur existe dnas la bd
       {
           $userInfo = $reqUser->fetch();
           $_SESSION['id'] = $userInfo['id'];    // la variable de session id prend la valeur de l'id de l'utilisateur
           $_SESSION['pseudo'] = $userInfo['pseudo'];  // la variable de session pseudo prend la valeur du pseudo de l'utilisateur
           header("location: dashboard.php?id=".$_SESSION['id']);  // redirige vers la page dashboard
       }
       else  // si l'utilisateur n'existe pas dans la bd
       {
           $erreur = "Mauvais mail ou mot de passe !";
       }
   }
   else    // si l'un des champs es vide
   {
       $erreur = "Tous les champs doivent etre commpletés" ; 
   }
}
?>


<!DOCTYPE html>
<html>
	<head>
	  <title>Connection</title>
	  <meta charset="utf-8" />
	  <meta name="viewport" content="width=device-width, initial-scale=1" />
	  <link rel="stylesheet" href="assets/css/connexion.css" />
	  <link rel="icon" href="images/favicon.ico" />
	</head>


	<body>
	<div class="login-block">
		<h1>Se connecter</h1>
		<form method="post" action="connexion.php">
		  <input type="text"     name="username" id="username" required placeholder="Pseudo" autocomplete="off"> 
		  <input type="password" name="password" id="password" required placeholder="Mot de passe" autocomplete="off"> 
		  <input type="submit"   name="ok" value="Se connecter" >
		  <?php
        echo "<br>";
        if (isset($erreur))
        {
          echo'<font color ="red">'.$erreur.'</font>';            // affiche les different erreur qui pevent survenir  (en rouge)
        }
       ?>
		</form>
	</div>
	</body>

</html>
