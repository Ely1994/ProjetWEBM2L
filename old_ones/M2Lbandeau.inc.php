<!-- - - - - - - - - - - - - - - - - - - - - La CLASS du bandeau - - - - - - - - - - - - - - - - - - - - -->
<div id="bandeau"> 
    <!-- Le bandeau -->
    <div id="miseEnPage">
        <div class="mep">
            <img id="logo" src="../image/445.jpg" alt="logo" width="200px">
        </div>
        <div class="mep">
            <h1>Le titre du bandeau</h1>
            <p>Un petit paragraphe pour la route - <?php ladate(); ?> et <?php lheure(); ?>.</p>
        </div>
        <div class="mep">
            <?php
            if(isset($_SESSION['pseudo']) && (isset($_SESSION['code']))) {
            ?>
                <a href="M2Lprofil.php"><?php echo $_SESSION['pseudo']; ?></a>
                <p>Clique 
                <a href="M2Ldeconnexion.php"><input type="button" value="ici"></a>
                 pour te déconnecter</p>
            <?php
            } else {

            }
            ?>
        </div>
    </div>
    <!-- Le NAV, avec tous les liens -->
    <nav> 
        <ul>
		    <li><a href="./M2Laccueil.php">M2L - Page d'accueil</a></li>
		    <li><a href="./M2Lindex.php">M2L - Index</a></li>
		    <li><a href="./M2Lconnexion.php">M2L - Connexion</a></li>
            <li>7</a></li>
		    <li><a href="./index2.php">index2</a></li>
	    </ul>
    </nav>
</div>

<!-- Là on est sur letop qui met des liens en haut à droite de la page -->
<?php
        if(isset($_SESSION['profil'])) {
            ?>
            <div class="letop"><a href="./M2Ldeconnexion.php" >Déconnexion</a></div>
            <?php
        } else {
            ?>
            <div class="letop"><a href="./M2Lconnexion.php" >Connexion</a> / <a href="./M2Linscription.php" >Inscription</a></div>
            <?php
        }
        ?>