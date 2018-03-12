<?php
// Session start
session_start();
// include
include_once "../lib/fonction.lib.php";
include_once "../old_ones/Rectangle.inc.php";
include_once "../old_ones/Livre.inc.php";
include_once "../old_ones/Librairie.inc.php";

// appel redirection
if(!isset($_SESSION['login']) && isset($_SESSION['mdp'])) {
    redirection('http://localhost/Try8/Try8/views/connexion.php');
}
// incrementation cookie (LIGHT)
if(isset($_COOKIE['holycookie'])==TRUE) {
    setcookie('holycookie', ($_COOKIE['holycookie']+1), time()+3600*24*365);
} else {
    setcookie('holycookie', 1, time()+3600*24*365);
}
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
    <title>M2L - Page de Profil</title>
</head>
<body>
    <?php include '../inc/header.inc.php'; ?>
        <?php include '../inc/nav.inc.php'; ?>
        <section> 
            <?php
            $livre = new Livre("AAA", 10);
            echo $livre->afficheLivre();

            $libra = new Librairie();
            $libra->addLivre(new Livre("EEE", 14));
            $libra->addLivre(new Livre("FFF", 18));
            $libra->addLivre(new Livre("GGG", 4));
            
            $libra->afficheTout();
            echo $libra->moyenne();

            ?>
        </section>
        <section>
            <h2>Test rectangle</h2>
            <?php 
                echo Rectangle::staAff();
                echo Rectangle::aze(10,10);
                $tab = array(new Rectangle(4,5), new Rectangle(8,4), new Rectangle(12,5));
                foreach($tab as $line) {
                    echo $line->afficher();
                }
                $tab2 = array();
                array_push($tab2, new Rectangle(8,4));
                array_push($tab2, new Rectangle(8,6));
                array_push($tab2, new Rectangle(8,8));
                array_push($tab2, new Rectangle(8,9));
                foreach($tab2 as $line) {
                    echo $line->afficher();
                }
                $rect = new Rectangle(10,5);
                echo $rect->afficher();
            ?>
        </section>
        <section>
            <h2>Petite fonction sur les requetes préparées</h2>
            <?php
            //$tabl = M2LreqPrep(3,"cours de Basket", "Cours exceptionnel de Mr. Rodriguez, visant des personnes qui connaissent déjà le sport. ");
            //print_r($tabl);
            //foreach($tabl as $line) {
                //echo $line['id']." - ".$line['nom'];
            //}
            ?>
        </section>
        <section>
            <h2>Exercice de JF sur les nouvelles</h2>
            <?php $tab = array("Le grand méchant loup", "Pizza volante apparue au dessus de la lune", "Un oursil de mer dans mon chausson ?", "comment progresser en gold", "Nouveau mod pour factorio", "la nouvelle extention d'hearstone est nulle", "don't starve together, n'y a-t-il plus personne ?", "vega conflict, le power creep infini ?", "fortnite, la star du momment", "le come-back de world of tanks ?"); ?>
            <?php
            if(isset($_POST['nouvelle'])) {
                echo $_POST['nouvelle'];
            } else {
                foreach($tab as $line) {
                    echo $line;
                }
            }
            ?>
            <form method="post" action="index.php">
                <label for="nouvelle">Votre nouvelle préférée : </label>
                <select id="nouv" name="nouvelle" required>
                <?php
                for($i = 4; $i < 9; $i++) {
                ?>
                    <option value="<?php echo $tab[($i+1)]; ?>"><?php echo ($i+1); ?></option>
                <?php
                }
                ?>
		        </select>
                <input type="submit" id="smbt" name="envoyer" value=" ENVOYER "/>
            </form>
        </section>
        <section>
            <h2>Exercice sur les fonctions de hashage</h2>
            <?php 
            $hash = md5("toto");
            echo $hash; 
            ?> <br> <?php
            $hash2 = password_hash("toto", 1);
            echo password_verify("toto",$hash2);
            ?>    
        </section>
    </div>
    <?php include '../inc/footer.inc.php'; ?>
</body>
</html>
<?php ?>