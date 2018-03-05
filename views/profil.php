<?php
// Session start
session_start();
// include
include_once "../lib/connexion.lib.php";
// - - - - - gestion de la connexion - - - - - 
if(isset($_POST['login']) && isset($_POST['motdepasse'])) {
    if(estPresent($_POST['login'],$_POST['motdepasse']) == TRUE) { // identifiants de connexion présents
        $_SESSION['login'] = $_POST['login'];
        $_SESSION['mdp'] = $_POST['motdepasse'];
        $_POST['login'] = null;
        $_POST['motdepasse'] = null;
    } else { // id co non présents
?>
        <script>
            alert("Combinaison identifiant/mot de passe invalide");
        </script>
<?php
    }
}
// appel redirection
if(!isset($_SESSION['login']) && !isset($_SESSION['mdp'])) {
    //redirection('http://localhost/projet1/pjr/vues/M2Lconnexion.php');
    ?> <script type='text/javascript'>document.location.replace('M2Lconnexion.php');</script> <?php
}
// incrementation cookie (LIGHT)
if(isset($_COOKIE['holycookie'])==TRUE) {
    setcookie('holycookie', ($_COOKIE['holycookie']+1), time()+3600*24*365);
} else {
    setcookie('holycookie', 1, time()+3600*24*365);
} // Fin du programme bienveillant light cookie
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
    <script type="text/javascript" src="../javascript/lib.js"></script>    
    <title>M2L - Profil</title>
</head>
<body>
    <?php include '../inc/header.inc.php'; ?>
    <?php include '../inc/nav.inc.php'; ?>

        <section>
            <h2>Bienvenue sur ta page de profil <?php echo $_SESSION['login']; ?>.</h2>
        </section>
        <section>
            <p>Tu en as marre de tes cookies ? clique 
            <input type="button" value="ici" onclick="alerte()">
             pour donner tout tes cookies à Darth Jar Jar Binks.</p>
        </section>
    <?php include '../inc/footer.inc.php'; ?>
</body>
</html>
<?php ?>