<?php
// Session start
session_start();
// include
include_once '../lib/fonction.lib.php';
// pas de redirection
//if(isset($_SESSION['login']) && isset($_SESSION['mdp'])) {
//    redirection('http://localhost/Try8/Try8/views/profil.php');
//}
?>

<?xml version="1.0" encoding="ISO-8859-1"?>
<!DOCTYPEhtml>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="../style/main.style.css" />
    <link rel="stylesheet" href="../style/header.style.css" />
    <link rel="stylesheet" href="../style/nav.style.css" />
    <link rel="stylesheet" href="../style/footer.style.css" />   
    <title>M2L - Page de connexion</title>
</head>
    <body>
        <?php include '../inc/header.inc.php'; ?>
        <?php include '../inc/nav.inc.php'; ?>
        <section>
        <?php
        if(isset($_SESSION['profil']) || isset($_SESSION['mdp'])) { // SI connecté
            redirection('http://localhost/Try8/Try8/views/profil.php');
        } elseif (isset($_POST['inscription']) || isset($_POST['ins-login']) && isset($_POST['ins-motdepasse'])) {
            // on vérifie que le login n'existe pas :
            $log = $_POST['ins-login'];
            $cod = $_POST['ins-motdepasse'];
            $lelogin = reqPolyvalente("SELECT E_login FROM employe WHERE E_login = '$log';");
            if(count($lelogin) >= 1) {
                echo "Le pseudo que vous avez entré existe déjà.";
                //on ne fait rien 
            } else {
                // Et là on inscrit.
                reqPolyvalente("INSERT INTO employe (E_nom, E_prenom, E_login, E_mdp, E_credits, E_date, E_statut) VALUES (' ', ' ', '$log','$cod', 20, NOW(), 'employe')");
                $_SESSION['login'] = $log;
                $_SESSION['mdp'] = $cod;
                $_SESSION['id'] = chopId($log, $cod);
                redirection('http://localhost/Try8/Try8/views/profil.php');
            }
        } else { // SI pas connecté
        ?>
        <section class="CON_cont-co">
            <div class="CON_div">
                <h3>Vous pouvez vous inscrire ici :</h3>
                <form method="post" action="./inscription.php">
                    <label>Nom utilisateur : </label><input class="CON_helo" type="text" placeholder="Pseudo..." id="ins-login" name="ins-login" size="20" maxlength="20" />
	    	        <br><label>Mot de passe : </label><input type="password" placeholder="mot de passe" id="ins-motdepasse" name="ins-motdepasse" size="20" maxlength="20" />
                    <br><input class="CON_submit" type="submit" name="inscription" value=" INSCRIPTION ">
                </form>
            </div>
        </section>
        <?php
        }
        ?>


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
        <?php include '../inc/footer.inc.php'; ?>
</body>
</html>
<?php ?>