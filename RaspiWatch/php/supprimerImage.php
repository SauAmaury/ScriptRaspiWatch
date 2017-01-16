<?php
session_start();
require 'connexion.php';
$bdd = new connexion();

if (isset($_SESSION['id']) AND  isset($_GET['nom']) AND $_SESSION['id']=6) 
{
	$imageASupprimer = $_GET['nom'];
	$nomImg = substr($_GET['nom'],20); // 29 a modifier pour mettre la valeur du lien de la pi
	//die($nomImg);
	$reqImage = $bdd->getConnexion()->prepare('DELETE FROM security WHERE filename="'.$imageASupprimer.'"');
	$reqImage->execute();
	$_SESSION['imageDel'] = true;
	unlink("../".$nomImg."");  // supprime l'image du ficher (on pass le lien ../imgCamera1/nom.jpg)
	header("Location: ../images.php?id=".$_SESSION['id']."");
	
}else
{
	header("Location: ../index.php");
}

?>