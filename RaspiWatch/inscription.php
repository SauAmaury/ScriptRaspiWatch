<?php
session_start();
require 'php/connexion.php';
// connexion a la BD 
$bdd = new connexion();

if(isset($_POST['ok']))
{
        $pseudo = htmlspecialchars($_POST['username']);
        $mdp = sha1($_POST['password']);     // fonction de hashage 
        $mdp2 = sha1($_POST['password2']);
        
    if(!empty($_POST['username']) AND !empty($_POST['password']) AND !empty($_POST['password2']))   // verifie si tou les champs ont été saisie
    {  
        
        $pseudolength = strlen($pseudo);  // la taille du pseudo
        if($pseudolength <=255)
        {            
            $verifpseudo = $bdd->getConnexion()->prepare("SELECT * FROM membre WHERE pseudo = ?");     // on si le pseudo existe déjà dans la bd
            $verifpseudo->execute(array($pseudo));
            $pseudoexiste = $verifpseudo->rowCount();  // compte le nb de colone retourné par la requete 
            
            if($pseudoexiste == 0)   // si le pseudo n'existe pas 
            {
                if($mdp == $mdp2)  // comparer si les 2 mot de passe sont identiques
                {
                    // on insert l'utilisateur dnas la bdd
                    $insertDansBd = $bdd->getConnexion()->prepare("INSERT INTO membre(pseudo, pass,date_inscription) VALUES(?, ?,?) ");   
                    $datetime = date("Y-m-d H:i:s");  // on recupere la date du jour
                    $insertDansBd->execute(array($pseudo,$mdp,$datetime));
                    $erreur = "Votre compte a bien ete crée"; 
					$_SESSION['inscriptionOk'] = true;  // validation du creation de compte
					$_SESSION['pseudoCree']= $_POST['username'];  // stocker le pseudo crée
					header("Location: dashboard.php?id=".$_SESSION['id']."");
                }else
                {
                    $erreur = "Votre mot de passe ne correspondent pas ! " ;
                }
            }
            else  // si le pseudo existe alros
            {
                $erreur = "Le pseudo existe déjà";
            }
        }else 
        {
            $erreur = "Votre pseudo ne doit pas dépasser 255 caractères ! ";
        }
    }else
    {
        $erreur = "Tous les champs doivent être complétés ! ";
    }
}              
?>



<!DOCTYPE html>
<html>

<head>
    <title>Inscription</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="assets/css/inscription.css" />
    <link rel="icon" href="images/favicon.ico" />
</head>

<body>
    <div class="login-block">
        <h1>Inscription</h1>
        <form method="post" action="inscription.php">
            <input type="text" name="username" id="username" required placeholder="Pseudo" autocomplete="off" value="<?php if(isset($pseudo)) {echo $pseudo;} ?>">
            <input type="password" name="password" id="password" required placeholder="Mot de passe" autocomplete="off">
            <input type="password" name="password2" id="password" required placeholder="Repeter le mot de passe" autocomplete="off">
            <input type="submit" name="ok" value="Inscription">
			 <?php
                        if (isset($erreur)){
                            echo'<font color ="red">'. $erreur.'</font>';            // affiche les different erreur qui pevent survenir  (en rouge)
                        }
                         ?>
        </form>
    </div>
</body>

</html>
