<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1">
		<meta name="Content-Language" content="fr" />
		<meta name="Description" content="" />
		<meta name="Keywords" content="Offre aide umannity partage reseau social" />
		<meta name="Subject" content="" />
		<meta name="Content-Type" content="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">
		<link rel="stylesheet" href="style.css" />
		<script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
		<script src="inscription.js"></script>
		<title>Neo-web.fdr</title>
	</head>

	<body class="my_background">

		<div class="container">
			<form role="form" id="register" method="post" action="SUCCESS">
				<div class="row">
					<div class="col-md-offset-2 col-md-8">
						<h1> Inscription <br/> <small> Merci de renseigner vos informations </small></h1>
					</div>
				</div>

				<div class="row">
					<div class="col-md-offset-2 col-md-3">
					<div class="form-group">
						<label for="Nom">Nom</label>
						<input type="text" class="form-control" id="nom" placeholder="Nom">
					</div>
					</div>
					<div class="col-md-offset-1 col-md-3">
						<div class="form-group">
							<label for="Prenom">Prénom</label>
							<input type="text" class="form-control" id="prenom" placeholder="Prénom">
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-offset-2 col-md-7">
						<div class="form-group">
							<label for="Email">Email address</label>
							<input type="text" class="form-control" id="email" placeholder="Enter email">
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-offset-2 col-md-3">
						<div class="form-group">
							<label for="Password">Mot de passe</label>
							<input type="password" class="form-control" id="password" placeholder="Mot de passe">
						</div>
					</div>
					<div class="col-md-offset-1 col-md-3">
						<div class="form-group">
							<label for="Vpassword">Vérification mot de passe</label>
							<input type="password" class="form-control" id="vpassword" placeholder="Vérification mot de passe">
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-offset-2  col-md-3">
						<div class="input-group">
							<span class="input-group-addon glyphicon glyphicon-phone"> </span>
							<input type="text" class="form-control" id="tel" placeholder="Numéro de téléphone">
						</div>
					</div>
					<div class="col-md-offset-1  col-md-3">
						<div class="input-group">
							<span class="input-group-addon glyphicon glyphicon-globe"> </span>
							<input type="text" class="form-control" id="adresse" placeholder="Adresse">
						</div>
					</div>
					<br/>
					<div class="row">
						<div class="col-md-offset-5  col-md-1">
							<button type="submit" class="btn btn-primary">S'incrire</button>
						</div>
					</div>
				</div>

			</div>
		</form>
	</body>
</html>