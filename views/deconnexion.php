<!--
Cette page M2Ldeconnexion.php est ulilisée quand un utilisateur connecté appuie sur le bouton déconnexion,
qui se situe dans le bandeau. Cette page annule alors la valeur des variables de session (2 pour l'instant).
Donc comme ça, l'utilisateur est déconnectée.
-->
<?php
// Session start
session_start();
// include
include_once "../lib/fonction.lib.php";
// appel redirection
if(!isset($_SESSION['login']) && !isset($_SESSION['mdp'])) {
    redirection('http://localhost/Try8/Try8/views/connexion.php');
} else {
    $_SESSION['login'] = null;
    $_SESSION['mdp'] = null;
}

?>

<?xml version="1.0" encoding="ISO-8859-1"?>
<!DOCTYPEhtml>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="../style/M2Lstyle.css" />
    <script type="text/javascript" src="../javascript/lib.js"></script>    
    <title>M2L - Déconnexion</title>
</head>
<body>
    <?php
    header('Location:connexion.php', false);
    ?>
</html>