<?php
// Session start
session_start();
// include
include_once "../lib/formation.lib.php";
// appel redirection
if(isset($_SESSION['login']) && !isset($_SESSION['code'])) {
    redirection('http://localhost/Try8/Try8/views/profil.php');
}
?>

<?xml version="1.0" encoding="ISO-8859-1"?>
<!DOCTYPEhtml>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="../style/M2Lstyle.css" />
    <script type="text/javascript" src="../javascript/lib.js"></script>    
    <title>M2L - Page de connexion</title>
</head>
<body>
    <div id="conteneur">
        <?php include'M2Lbandeau.inc.php'; ?>

        <div class="letop"><a href="./M2Lconnexion.php" >Connexion</a> / <a href="./M2Linscription.php" >Inscription</a></div>

        <section>
        <?php
        if(isset($_SESSION['profil']) || isset($_SESSION['mdp'])) { // SI connecté
            ?>
            <p>Salut mon ami <?php echo $_SESSION['pseudo']; ?>, ton code est : <?php echo $_SESSION['code']; ?></p>
            <?php           
        } else { // SI pas connecté
        ?>
            <section>
            <label>Vous pouvez vous inscrire avec ce formulaire :</label>
            <form method="post" action="M2Lconnexion.php">
                <label for="pseud">Pseudo : </label><input type="text" id="profil" name="profil" size="25" placeholder="Pseudo..." maxlength="30" />
		    	<br><label for="cod">Mot de passe : </label><input type="password" id="motdepasse" name="motdepasse" size="25" maxlength="25" />
                <br><input type="submit" name="envoyerIns" value=" INSCRIPTION ">
            </form>
        <?php
        }
        ?>
        </section>



        <section>



			<?php
			if(isset($_POST['pseudo']) && isset($_POST['code']) && isset($_POST['envoyer2'])) {
				if(connecteOupa($_POST['pseudo'], $_POST['code']) == TRUE) {
					echo "Votre identifiant et votre mot de passe ont étés reconnu, c'est bien.";
				} else {
					echo "Combinaison invalide, veuillez réessayer !";
				}
			}
			?>
        </section>
        <?php include 'M2Lfooter.inc.php'; ?>
    </div>
</body>
</html>
<?php ?>