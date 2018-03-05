<?php
include_once("M2Lconnexion.lib.php");

function descriptionFormationsPartielles() { // FONCTION : afichage partiel de "formation" OUTDATED
    $tab = M2LgetFormation();
    ?>
    <section>
        <form action="M2Laccueil.php" method="post">
        <p>Voici la liste des formations qui n'ont pas encore commencés. Vous pouvez cocher les cases puis cliquer sur le bouton "details" en bas de la page pour avoir plus de d'informations sur les formations cochés.</p>
        <p><label>Si tu veux voir toutes les formations, même celles qui sont déjà finies, clique ici : </label><input type="submit" name="toutAfficher" value="tout afficher"></p>
    </section>
    <?php
    foreach($tab as $line) { 
        $date = date("d-m-Y"); 
        if(strtotime($line['date_debut']) >= strtotime($date)) {
            // echo "Valide";
            ?>
            <section><p>Formation : <strong>
            <?php echo $line['nom']; ?>
            </strong>. 
            <?php echo $line['description']; ?>
            </p>
            <label>Je veux les details : </label><input type="checkbox" name="checkbox[]" value="<?php echo $line['id']; ?>">
            </section>
            <?php
        } else {
            // echo "Date dépassée";
        }
    }
    ?>
    </select>
    <section>
    <label>Clique ici pour voir les détails des formations que tu as coché : </label><input type="submit" name="envoyer" value="Voir les Détails">
    </section></form> <?php
}
function descriptionFormationsPartiellesAnciennes() { // FONCTION : afichage partiel de "formation" OUTDATED
    $tab = M2LgetFormation();
    ?>
    <section>
        <form action="M2Laccueil.php" method="post">
        <p>Voici la liste de toutes les formations.</p>
        <p><label>Si tu veux voir seulement les formations qui n'ont pas étés commencés, <a href="./M2Laccueil.php">clique ici</a>.</p>
    </section>
    <?php
    foreach($tab as $line) { 
        ?>
        <section><p>Formation : <strong>
        <?php echo $line['nom']; ?>
        </strong>. 
        <?php echo $line['description']; ?>
        </p>
        <label>Je veux les details : </label><input type="checkbox" name="checkbox[]" value="<?php echo $line['id']; ?>">
        </section>
        <?php
    }
    ?>
    </select>
    <section>
    <label>Clique ici pour voir les détails des formations que tu as coché : </label><input type="submit" name="envoyer" value="Voir les Détails">
    </section>
    </form> <?php
}
function descriptionFormationsCompletes() { // FONCTION : affichage complet de "formation"
    $tab = M2LgetFormation();
    foreach($tab as $line) { 
        ?>
        <section><p>Formation n°
        <?php echo $line['id']; ?>
         : <strong>
        <?php echo $line['nom']; ?>
        </strong> - 
        <?php echo $line['description']; ?>
        <br>L'endroit de rendez-vous est :<br>
        <?php echo $line['lieu']; ?>
        <br><strong>Dates : </strong>Début de la formation le 
        <?php echo $line['date_debut']; ?>
        et fin de la formation le 
        <?php echo $line['date_fin']; ?>
        avec pour durée totale
        <?php echo $line['duree_jour']; ?>
         jours. Il y a  
        <?php echo $line['duree_heure']; ?>
         heures de formation par jour.
        <br><strong>Prérequis : </strong>
        <?php echo $line['prerequis']; ?>
        </p></section>
        <?php
    }
}
function descriptionOneFormationComplete($i) { // FONCTION : affichage complet d'UNE ligne de "formation"
    $tab = M2LgetFormation();
    foreach($tab as $ittm) {
        if($ittm['id'] == $i) { $line = $ittm; }
    }
    ?>
        <section><p>Formation : <strong>
        <?php echo $line['nom']; ?>
        </strong> - 
        <?php echo $line['description']; ?>
        <br>L'endroit de rendez-vous est :<br>
        <?php echo $line['lieu']; ?>
        <br><strong>Dates : </strong>Début de la formation le 
        <?php echo $line['date_debut']; ?>
        et fin de la formation le 
        <?php echo $line['date_fin']; ?>
        avec pour durée totale
        <?php echo $line['duree_jour']; ?>
         jours. Il y a  
        <?php echo $line['duree_heure']; ?>
         heures de formation par jour.
        <br><strong>Prérequis : </strong>
        <?php echo $line['prerequis']; ?>
        </p></section>
        <?php
}


function redirection($cible) { //fonction de redirection sur une page 
    header('Location:'.$cible, false);
}

function ladate() {
    $date = date("d-m-Y");
    echo "Nous sommes le $date";
}

function lheure() {
    $heure = date("H:i");
    echo "il est $heure";
}
    
?>