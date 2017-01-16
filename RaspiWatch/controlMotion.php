<?php
session_start();
require 'php/connexion.php';
$bdd = new connexion();

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

        <title>Contrôler les différentes caméras</title>

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
        <!-- CSS button -->
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
                            <li>
                                <?php echo "<a href="."dashboard.php?id=".$userInfo['id']?> "><i class="glyphicon glyphicon-facetime-video"></i> Caméra en Direct </a>
                            </li>
                            <li class="active">
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
                                <h1 class="page-header">
                            Configuration des Caméras <small>Contrôler les différentes caméras</small>
                        </h1>
                                <ol class="breadcrumb">
                                    <li>
                                        <i class="glyphicon glyphicon-facetime-video"></i>
                                        <?php echo "<a href="."dashboard.php?id=".$userInfo['id']?> ">Caméra en Direct</a>
                                    </li>
                                    <li class="active">
                                        <i class="fa fa-wrench"></i> Configuration des Caméras
                                    </li>
                                </ol>
                            </div>
                        </div>

                        <!---------------------------------------------------CAMEREA 1-------------------------------------------------------------------->
                        <ul class="nav nav-pills">
                            <li role="presentation" class="active"><a href="#">Caméra <span class="badge">1</span></a></li>
                        </ul>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="panel panel-green">
                                    <div class="panel-heading">
                                        <h3 class="panel-title text-center"> Action </h3>
                                    </div>
                                    <p>
                                        <div class="row">
                                            <div class="col-md-6 text-center">
                                                <div class="panel-body"> <a type="button" class="btn btn-lg btn-success" href="#"> Make Move </a> </div>
                                                <div class="panel-body"> <a type="button" class="btn btn-lg btn-success" href="#"> Snapshot </a> </div>
                                            </div>

                                            <div class="col-md-6 text-center">
                                                <div class="panel-body"> <a type="button" class="btn btn-lg btn-success" id="btnRestart" href=""> Restart </a> </div>
                                                <div class="panel-body"> <a type="button" class="btn btn-lg btn-success" id="btnQuit" href=""> Quit </a> </div>
                                            </div>
                                        </div>
                                    </p>
                                </div>
                            </div>



                            <div class="col-sm-6">
                                <div class="panel panel-red">
                                    <div class="panel-heading">
                                        <h3 class="panel-title text-center"> Detection </h3>
                                    </div>
                                    <p>

                                        <!--BOUTON ON/OFF-->

                                        <div class="row">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-3 col-sm-2 col-xs-3 "></div>
                                                <div class="col-md-1 col-xs-1">
                                                    <div class="flipswitch">
                                                        <input type="checkbox" name="flipswitch" class="flipswitch-cb" id="fs" disabled="disabled" checked>
                                                        <label class="flipswitch-label" for="fs">
                                                            <div class="flipswitch-inner"></div>
                                                            <div class="flipswitch-switch"></div>
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="col-md-1 col-xs-1"></div>
                                                <div class="col-md-1 col-xs-1"></div>
                                            </div>

                                            <!---------------->
                                            <div class="row">
                                                <div class="col-md-6 text-center">
                                                    <div class="panel-body"> <a type="button" class="btn btn-lg btn-danger" id="btnStart" href="#"> Start </a> </div>
                                                </div>
                                                <div class="col-md-6 text-center">
                                                    <div class="panel-body"> <a type="button" class="btn btn-lg btn-danger" id="btnStop" href="#"> Pause </a> </div>
                                                </div>
                                    </p>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---------------------------------------------------CAMEREA 2-------------------------------------------------------------------->

                        <ul class="nav nav-pills">
                            <li role="presentation" class="active"><a href="#">Caméra <span class="badge">2</span></a></li>
                        </ul>


                        <div class="row">
                            <div class="col-sm-6">
                                <div class="panel panel-green">
                                    <div class="panel-heading">
                                        <h3 class="panel-title text-center"> Action </h3>
                                    </div>
                                    <p>
                                        <div class="row">
                                            <div class="col-md-6 text-center">
                                                <div class="panel-body"> <a type="button" class="btn btn-lg btn-success" href="#"> Make Move </a> </div>
                                                <div class="panel-body"> <a type="button" class="btn btn-lg btn-success" href="#"> Snapshot </a> </div>
                                            </div>

                                            <div class="col-md-6 text-center">
                                                <div class="panel-body"> <a type="button" class="btn btn-lg btn-success" id="btnRestart2" href=""> Restart </a> </div>
                                                <div class="panel-body"> <a type="button" class="btn btn-lg btn-success" id="btnQuit2" href=""> Quit </a> </div>
                                            </div>
                                        </div>
                                    </p>
                                </div>
                            </div>



                            <div class="col-sm-6">
                                <div class="panel panel-red">
                                    <div class="panel-heading">
                                        <h3 class="panel-title text-center"> Detection </h3>
                                    </div>
                                    <p>

                                        <!--BOUTON ON/OFF-->

                                        <div class="row">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-3 col-sm-2 col-xs-3 "></div>
                                                <div class="col-md-1 col-xs-1">
                                                    <div class="flipswitch">
                                                        <input type="checkbox" name="flipswitch" class="flipswitch-cb" id="fs2" disabled="disabled" checked>
                                                        <label class="flipswitch-label" for="fs2">
                                                            <div class="flipswitch-inner"></div>
                                                            <div class="flipswitch-switch"></div>
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="col-md-1 col-xs-1"></div>
                                                <div class="col-md-1 col-xs-1"></div>
                                            </div>

                                            <!---------------->
                                            <div class="row">
                                                <div class="col-md-6 text-center">
                                                    <div class="panel-body"> <a type="button" class="btn btn-lg btn-danger" id="btnStart2" href="#"> Start </a> </div>
                                                </div>
                                                <div class="col-md-6 text-center">
                                                    <div class="panel-body"> <a type="button" class="btn btn-lg btn-danger" id="btnStop2" href="#"> Pause </a> </div>
                                                </div>
                                    </p>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---------------------------------------------------CAMEREA 3-------------------------------------------------------------------->

                        <ul class="nav nav-pills">
                            <li role="presentation" class="active"><a href="#">Caméra <span class="badge">3</span></a></li>
                        </ul>


                        <div class="row">
                            <div class="col-sm-6">
                                <div class="panel panel-green">
                                    <div class="panel-heading">
                                        <h3 class="panel-title text-center"> Action </h3>
                                    </div>
                                    <p>
                                        <div class="row">
                                            <div class="col-md-6 text-center">
                                                <div class="panel-body"> <a type="button" class="btn btn-lg btn-success" href="#"> Make Move </a> </div>
                                                <div class="panel-body"> <a type="button" class="btn btn-lg btn-success" href="#"> Snapshot </a> </div>
                                            </div>

                                            <div class="col-md-6 text-center">
                                                <div class="panel-body"> <a type="button" class="btn btn-lg btn-success" id="btnRestart3" href=""> Restart </a> </div>
                                                <div class="panel-body"> <a type="button" class="btn btn-lg btn-success" id="btnQuit3" href=""> Quit </a> </div>
                                            </div>
                                        </div>
                                    </p>
                                </div>
                            </div>



                            <div class="col-sm-6">
                                <div class="panel panel-red">
                                    <div class="panel-heading">
                                        <h3 class="panel-title text-center"> Detection </h3>
                                    </div>
                                    <p>

                                        <!--BOUTON ON/OFF-->

                                        <div class="row">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-3 col-sm-2 col-xs-3 "></div>
                                                <div class="col-md-1 col-xs-1">
                                                    <div class="flipswitch">
                                                        <input type="checkbox" name="flipswitch" class="flipswitch-cb" id="fs3" disabled="disabled" checked>
                                                        <label class="flipswitch-label" for="fs3">
                                                            <div class="flipswitch-inner"></div>
                                                            <div class="flipswitch-switch"></div>
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="col-md-1 col-xs-1"></div>
                                                <div class="col-md-1 col-xs-1"></div>
                                            </div>

                                            <!---------------->
                                            <div class="row">
                                                <div class="col-md-6 text-center">
                                                    <div class="panel-body"> <a type="button" class="btn btn-lg btn-danger" id="btnStart3" href="#"> Start </a> </div>
                                                </div>
                                                <div class="col-md-6 text-center">
                                                    <div class="panel-body"> <a type="button" class="btn btn-lg btn-danger" id="btnStop3" href="#"> Pause </a> </div>
                                                </div>
                                    </p>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---------------------------------------------------CAMEREA 4-------------------------------------------------------------------->

                        <ul class="nav nav-pills">
                            <li role="presentation" class="active"><a href="#">Caméra <span class="badge">4</span></a></li>
                        </ul>


                        <div class="row">
                            <div class="col-sm-6">
                                <div class="panel panel-green">
                                    <div class="panel-heading">
                                        <h3 class="panel-title text-center"> Action </h3>
                                    </div>
                                    <p>
                                        <div class="row">
                                            <div class="col-md-6 text-center">
                                                <div class="panel-body"> <a type="button" class="btn btn-lg btn-success" href="#"> Make Move </a> </div>
                                                <div class="panel-body"> <a type="button" class="btn btn-lg btn-success" href="#"> Snapshot </a> </div>
                                            </div>

                                            <div class="col-md-6 text-center">
                                                <div class="panel-body"> <a type="button" class="btn btn-lg btn-success" id="btnRestart4" href=""> Restart </a> </div>
                                                <div class="panel-body"> <a type="button" class="btn btn-lg btn-success" id="btnQuit4" href=""> Quit </a> </div>
                                            </div>
                                        </div>
                                    </p>
                                </div>
                            </div>



                            <div class="col-sm-6">
                                <div class="panel panel-red">
                                    <div class="panel-heading">
                                        <h3 class="panel-title text-center"> Detection </h3>
                                    </div>
                                    <p>

                                        <!--BOUTON ON/OFF-->

                                        <div class="row">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-3 col-sm-2 col-xs-3 "></div>
                                                <div class="col-md-1 col-xs-1">
                                                    <div class="flipswitch">
                                                        <input type="checkbox" name="flipswitch" class="flipswitch-cb" id="fs4" disabled="disabled" checked>
                                                        <label class="flipswitch-label" for="fs4">
                                                            <div class="flipswitch-inner"></div>
                                                            <div class="flipswitch-switch"></div>
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="col-md-1 col-xs-1"></div>
                                                <div class="col-md-1 col-xs-1"></div>
                                            </div>

                                            <!---------------->
                                            <div class="row">
                                                <div class="col-md-6 text-center">
                                                    <div class="panel-body"> <a type="button" class="btn btn-lg btn-danger" id="btnStart4" href="#"> Start </a> </div>
                                                </div>
                                                <div class="col-md-6 text-center">
                                                    <div class="panel-body"> <a type="button" class="btn btn-lg btn-danger" id="btnStop4" href="#"> Pause </a> </div>
                                                </div>
                                    </p>
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
