<?php
session_start();
require 'php/connexion.php';
$bdd = new connexion();

if (isset($_GET['id']) AND $_GET['id'] > 0)  // verfier si la variable id existe si elle exite alros cela affiche la page
{  // ouverture de if numero 1
    $getId = intval($_GET['id']);   // transformer le id en int
    $reqUser = $bdd->getConnexion()->prepare('SELECT * FROM membre WHERE id = ?');
    $reqUser->execute(array($_GET['id']));
    $userInfo = $reqUser->fetch();
?>


<!DOCTYPE html>
<html lang="fr">

<head>

	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="images/favicon.ico" />
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Configuration Motion</title>

    <!-- Bootstrap Core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="assets/css/sb-admin.css" rel="stylesheet">
    <!-- Morris Charts CSS -->
    <link href="assets/css/plugins/morris.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- File JavaScript contenant function pour controler motion -->
    <script language="javascript" type="text/javascript" src="assets/js/popupConfigMotion.js"></script>
    <!-- Fichier CSS Button ON/OFF Motion -->
    <link href="assets/css/buttonOnOffMotion.css" rel="stylesheet" type="text/css">
</head>
<body>


<?php  // affiche du contenu propre a l'utlisateur (si l'ulisateur connecté veux visiter le profil d'un autre cela va afficher ce qu'il y a dans le else
		if (isset($_SESSION['id']) AND $userInfo['id'] == $_SESSION['id'])    // on verfie si l'id du user est le meme que celui de la session
		{     // ouverture de if numero 2
?>



	<div id="wrapper">

		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

			<div class="navbar-header">

	                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
	                    <span class="sr-only">Toggle navigation</span>
	                    <span class="icon-bar"></span>
	                    <span class="icon-bar"></span>
	                    <span class="icon-bar"></span>
	                </button>

	                <a class="navbar-brand" href="index.html">Dashboard</a>
	        </div>

	        <ul class="nav navbar-right top-nav">
	        	<!-- le menu profil  -->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $userInfo['pseudo'] ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="php/deconnexion.php"><i class="fa fa-fw fa-power-off"></i> Déconnexion</a>
                        </li>
                    </ul>
                </li>
            </ul>

            <!-- Menu a gauche  -->
             <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li >
                        <?php echo "<a href="."dashboard.php?id=".$userInfo['id']."><i class="."fa fa-fw fa-wrench"."></i> Dashboard</a>" ?>    <!-- PROBLEME SUR L'AFFICHAGE DE L'ICONE -->
                    </li>
                    <li class="active">
                        <a href="#"><i class="fa fa-fw fa-wrench"></i> Config Motion</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-fw fa-table"></i> Tables</a>
                    </li>
                </ul>
            </div>
		</nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Config Motion <small>Configuration de motion</small>
                        </h1>
                    </div>
                </div>

                <!-- 1er maniere de faire    -->
                <div class="row">
                    <!-- retourenr le message de la commande fait  (par exemple)-->
                    <div class="alert alert-success">
                        <strong>Bonjour!</strong> afficher ici le retour de la commande.
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <h3 class="panel-title"> Action </h3>
                            </div>
                            <p>
                                <div class="panel-body"> <a type="button" class="btn btn-lg btn-success" href="#"> Make Move </a> </div>
                                <div class="panel-body"> <a type="button" class="btn btn-lg btn-success" href="#"> Snapshot </a> </div>
                                <div class="panel-body"> <a type="button" class="btn btn-lg btn-success" href="#"> Restart </a> </div>
                                <div class="panel-body"> <a type="button" class="btn btn-lg btn-success" href="#"> Quit </a> </div>
                            </p>
                        </div>
                    </div>


                    <div class="col-sm-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <h3 class="panel-title"> Detection </h3>
                            </div>
                            <p>
                              <!-- <div class="panel-body"> <a type="button" class="btn btn-lg btn-danger" href="#" onclick="detectionStatus();"> Status </a> </div> -->           <div class="switch">
                                  <input id="cmn-toggle-1" class="cmn-toggle cmn-toggle-round" type="checkbox">
                                  <label for="cmn-toggle-1"></label>
                                </div>
                                <div class="switch">
                                  <input id="cmn-toggle-4" class="cmn-toggle cmn-toggle-round-flat" type="checkbox">
                                  <label for="cmn-toggle-4"></label>
                                </div>

                                <div class="switch">
                                  <input id="cmn-toggle-7" class="cmn-toggle cmn-toggle-yes-no" type="checkbox">
                                  <label for="cmn-toggle-7" data-on="Yes" data-off="No"></label>
                                </div>   
                                <div class="panel-body"> <a type="button" class="btn btn-lg btn-danger" href="#" onclick="detectionStart()"> Start </a> </div> 
                                <div class="panel-body"> <a type="button" class="btn btn-lg btn-danger" href="#" onclick="detectionStop()"> Pause </a> </div>
                            </p>
                        </div>
                    </div>
                </div> 

 
            <!-- 2eme maniere de faire    -->
<!--
                <div class="col-sm-4">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title">Panel title</h3>
                            </div>
                            <div class="panel-body">
                                 <p>
                                    <a type="button" href="#" class="btn btn-lg btn-default">Default</a>
                                    <a type="button" href="#" class="btn btn-lg btn-primary">Primary</a>
                                    <a type="button" href="#" class="btn btn-lg btn-success">Success</a>
                                    <a type="button" href="#" class="btn btn-lg btn-info">Info</a>
                                    <a type="button" href="#" class="btn btn-lg btn-warning">Warning</a>
                                    <a type="button" href="#" class="btn btn-lg btn-danger">Danger</a>
                                    <a type="button" href="#" class="btn btn-lg btn-link">Link</a>
                                </p>
                            </div>
                        </div>
                </div>

-->


            </div>
        </div>











	</div>


 <!-- jQuery -->
    <script src="assets/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="assets/js/plugins/morris/raphael.min.js"></script>
    <script src="assets/js/plugins/morris/morris.min.js"></script>
    <script src="assets/js/plugins/morris/morris-data.js"></script>


		<?php
			}   // fermeture  de if numero 2
	        else{
	            echo '<img class="pasdispo" src="images/pagePasDispo.png" alt="" > ';
	        }
	        ?>
	     </body>
	 </html>

	 <?php
 }    // fermeture  de if numero 1

	 ?>
