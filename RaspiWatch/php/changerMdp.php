<?php
session_start();
require 'connexion.php';
// connexion a la BD 
$bdd = new connexion();

if(isset($_POST['ok']))
{

		$id=$_SESSION['id'];
		$reqUser = $bdd->getConnexion()->prepare("SELECT * FROM membre WHERE id = ?");
		$reqUser->execute(array($id));
		$use = $reqUser->fetch(); 
		$userMdp = $use['pass'];
		
		if(isset($_POST['ancienMdp']))
		{
			
			$MdpTape =  sha1($_POST['ancienMdp']);
			echo $userMdp."<br/>" ;
			//die($MdpTape);
			if ($userMdp == $MdpTape)   // si l'ancien mot de passe tapé par l'utilsiateur correspond  a celui dans la bdd on autorise la modification
			{  
				$mdp = sha1($_POST['password']);     // fonction de hashage 
				$mdp2 = sha1($_POST['password2']);
				
				
				if(!empty($_POST['password']) AND !empty($_POST['password2']))   // verifie si tous les champs ont été saisie
				{
					if($mdp == $mdp2)  // comparer si les 2 mot de passe sont identiques
					{
						// on insert l'utilisateur dnas la bdd
						$insertDansBd = $bdd->getConnexion()->prepare("UPDATE membre SET pass='".$mdp."' WHERE id=".$_SESSION['id']);   
						$insertDansBd->execute();
						$_SESSION['message'] = "Votre mot de passe a bien été changé"; 
	
					}else
					{
						$_SESSION['erreur'] = "Votre mot de passe ne correspondent pas ! " ;
					}
				}else
				{
					$_SESSION['erreur'] = "Tous les champs doivent être complétés !";
				}
			}
			else
			{
				$_SESSION['erreur'] = "Le mot de passe entré ne correspond pas avec votre mot de passe";
			}			
		}else
		{
			$_SESSION['erreur'] = "Tous les champs doivent être complétés ! ";
		}
}
header("Location: ../parametres.php?id=".$_SESSION['id']);

?>