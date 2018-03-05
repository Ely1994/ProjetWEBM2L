<?php
include_once("../dataacces/connexiondb.lib.php");
include_once("../dataacces/requetes.lib.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="../style/style.css" />
	<title>index2</title>
</head>
<body>
	
	<?php include'header.inc.php'; ?>
	
	<?php include'nav.inc.php'; ?>
	
	<div id="conteneurTriple">
		<div class="elementTriple"> <!--ELEMENT-->
			<?php
			if(isset($_POST['envoyer']) && isset($_POST['message'])) {
				// echo "Voila le message précédent : ".$_POST['message'];
				sendToDB($_POST['message']);
			}
			$tabAssio = showFromDB();
			foreach($tabAssio as $datalines) {
				echo $datalines['texte'];
				?> <br> <?php
			}
			?>
		</div>
		<div class="elementTriple"> <!-- Cette div ne fait que 10 pixels de large. ne rien mettre dedans svp. -->
		</div>
		<div class="elementTriple"> <!--ELEMENT-->
			<p>Salut. Je te montre la base de données dbpjr, qui a une table avec les champs id et texte.</p>
			
			<form method="post" action="index2.php">
				<textarea id="message" name="message" cols="25" rows="10" placeholder="mettre le texte ici"></textarea>
				<input type="submit" name="envoyer" value="Envoyer">
			</form>
			
			<br>
			<form method="post" action="index2.php">
				<label for="pseudo">Votre pseudo : </label><input type="text" id="pseudo" name="pseudo" size="25" placeholder="Pseudo..." maxlength="50" />
				<label for="code">Mot de passe : </label><input type="password" id="code" name="code" size="15" maxlength="25" />
				<input type="submit" name="envoyer2" value="Envoyer">
			</form>
			<?php
			if(isset($_POST['pseudo']) && isset($_POST['code']) && isset($_POST['envoyer2'])) {
				if(connecteOupa($_POST['pseudo'], $_POST['code']) == TRUE) {
					echo "Votre identifiant et votre mot de passe ont étés reconnu, c'est bien.";
				} else {
					echo "Combinaison invalide, veuillez réessayer !";
				}
			}
			?>
		</div>
		<div class="elementTriple"> <!-- Cette div ne fait que 10 pixels de large. ne rien mettre dedans svp. -->
		</div>
		<div class="elementTriple"> <!--ELEMENT-->
			<p>Yo</p>
		</div>
	</div>
	
	<?php include'footer.inc.php'; ?>
	
</body>
</html>