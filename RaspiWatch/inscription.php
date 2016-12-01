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
		<form method="post" action="insex.php">
		  <input type="text" name="pseudo" id="username" required placeholder="Pseudo" autocomplete="off"> 
		  <input type="password" name="password" id="password" required placeholder="Mot de passe" autocomplete="off"> 
		  <input type="password" name="password2" id="password" required placeholder="Repeter le mot de passe" autocomplete="off">
		  <input type="submit" name="connect" value="Inscription" >
		</form>
	</div>
	</body>

</html>


