<?php
// Session start
session_start();
// include
include_once "../lib/fonction.lib.php";
// appel redirection
if(!isset($_SESSION['login']) && !isset($_SESSION['mdp'])) {
    redirection('http://localhost/Try8/Try8/views/connexion.php');
}
// incrémentation cookie (DARK)
if(isset($_COOKIE['darkcookie'])==TRUE) { // On s'occupe du dark cookie
    setcookie('darkcookie', ($_COOKIE['darkcookie']+1), time()+3600*24*365);
} else {
    setcookie('darkcookie', 1, time()+3600*24*365);
} // Fin du programme malveillant dark cookie
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
    <title>M2L - Formations</title>
</head>
<body>
    <div id="conteneur">
        <?php include '../inc/header.inc.php'; ?>
        <?php include '../inc/nav.inc.php'; ?>
        <section>
            <div class="SE1_titre">Page où tu peux valider des formation.</div>
        </section>
        <section>
            <div>hop : </div>
            <?php allFormationAttente(); ?>
        </section>
        <?php include '../inc/footer.inc.php'; ?>
    </div>
</body>
</html>