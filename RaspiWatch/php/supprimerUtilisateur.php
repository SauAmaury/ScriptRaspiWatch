<?php
session_start();
require 'connexion.php';
$bdd = new connexion();


if (isset($_SESSION['id']) AND  isset($_GET['id']) AND $_SESSION['id']=6) 
{
	$UtilisateurAsupp = $_GET['id'];
	$reqAdmin = $bdd->getConnexion()->prepare('DELETE FROM membre WHERE id='.$UtilisateurAsupp);
	$reqAdmin->execute();
	$_SESSION['suppOK'] = true;
	$_SESSION['pseudoDelete'] = $_GET['del'];
	header("Location: ../admin.php?id=".$_SESSION['id']."");
}else
{
	header("Location: ../index.php");
}

?>