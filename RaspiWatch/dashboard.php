<?php
session_start();
require 'php/connexion.php';
$bdd = new connexion();
$ip = $_SERVER['SERVER_ADDR'];


if (isset($_GET['id']) AND $_GET['id'] > 0)  // verfier si la variable id existe si elle exite alors cela affiche la page
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

        <title>Caméra en Direct</title>

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
						<?php echo "<a class="."navbar-brand"." href="."dashboard.php?id=".$userInfo['id']?>>RaspiWatch</a>
                    </div>

                    <ul class="nav navbar-right top-nav">
                        <!-- le menu profil  -->
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $userInfo['pseudo'] ?> <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <?php 
									if ($userInfo['id'] == 6){ 
									echo '<li>';
										echo '<a href="admin.php?id=6"><i class="glyphicon glyphicon-user"></i> Admin</a>';
									echo '</li>';	
									echo '<li>';
										echo '<a href="inscription.php"><i class="glyphicon glyphicon-plus"></i> Inscrire</a>';
									echo '</li>';
                                													
									}
								?>
								<li>
                                    <a href="parametres.php?id=<?= $userInfo['id']?> " ><i class="glyphicon glyphicon-wrench"></i> Paramètres</a>
                                </li>
								<li class="divider"></li>
                                <li>
                                    <li>
                                        <a href="php/deconnexion.php"><i class="glyphicon glyphicon-off"></i> Déconnexion</a>
                                    </li>
                            </ul>
                        </li>
                    </ul>

                    <!-- Menu a gauche  -->
                    <div class="collapse navbar-collapse navbar-ex1-collapse">
                        <ul class="nav navbar-nav side-nav">
                            <li class="active">
                                <?php echo "<a href="."dashboard.php?id=".$userInfo['id']?> "><i class="glyphicon glyphicon-facetime-video"></i> Caméra en Direct </a>
                            </li>
                            <li>
                                <?php echo "<a href="."controlMotion.php?id=".$userInfo['id']?> "><i class="fa fa-fw fa-wrench"></i> Configuration des Caméras </a>
                            </li>
                            <li>
                                <?php echo "<a href="."images.php?id=".$userInfo['id']?> "><i class="fa fa-fw fa-picture-o"></i> Visualisation des Images </a>
                            </li>
                        </ul>
                    </div>
                </nav>

                <div id="page-wrapper">

                    <div class="container-fluid">

                        <!-- Page Heading -->
                        <div class="row">
                            <div class="col-lg-12">
                                <?php
									if (isset($_SESSION['inscriptionOk']) AND isset($_SESSION['pseudoCree']) AND $userInfo['id'] == 6)  // test pour voir si un utilisateur a été crée
									{
											echo'<div class="alert alert-success" role="alert">L\'utilisateur '.$_SESSION['pseudoCree'].' a bien été crée</div>';
											unset($_SESSION['inscriptionOk']);  //supprimer le variable de session
											unset($_SESSION['pseudoCree']);	//supprimer le variable de session
									}
								?>
                                    <h1 class="page-header">
									Caméra en Direct <small>Visionner le flux des caméras en direct</small>
								</h1>
                                    <ol class="breadcrumb">
                                        <li>
                                            <i class="glyphicon glyphicon-facetime-video"></i> Caméra en Direct
                                        </li>
                                    </ol>
                            </div>
                        </div>

                        <div class="row">
                            <div class="panel panel-primary col-lg-6">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="embed-responsive embed-responsive-16by9">
                                            <iframe class="embed-responsive-item" src="http://<?=$ip?>:8081" scrolling="no" frameborder="0" allowfullscreen></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-primary col-lg-6">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="embed-responsive embed-responsive-16by9">
                                            <iframe class="embed-responsive-item" src="http://<?=$ip?>:8082" scrolling="no" frameborder="0" allowfullscreen></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-primary col-lg-6">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="embed-responsive embed-responsive-16by9">
                                            <iframe class="embed-responsive-item" src="http://<?=$ip?>:8083" scrolling="no" frameborder="0" allowfullscreen></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-primary col-lg-6">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="embed-responsive embed-responsive-16by9">
                                            <iframe class="embed-responsive-item" src="http://<?=$ip?>:8081" scrolling="no" frameborder="0" allowfullscreen></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
