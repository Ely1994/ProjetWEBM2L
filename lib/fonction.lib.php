<?php
include_once 'connexion.lib.php';

function affichageFormation() {
    $tab = M2LgetFormation();
    ?>
    <section>
    <h3>Affichage de toutes les formations :</h3>
    <form action="profil.php" method="get">
    <table class="TAB_table">
        <tr>
            <th>Id</th>
            <th>nom</th>
            <th>Description</th>
            <th>Lieu</th>
            <th>Prérequis</th>
            <th>Date_début</th>
            <th>Durée</th>
            <th><input class="TAB_submit" type="submit" value="Sélectionner"></th>
        </tr>
    <?php
    foreach($tab as $line) {
        $no_id = $line['F_id'];
        ?>
            
            <tr>
                <td><?php echo $no_id; ?></td>
                <td><?php echo $line['F_nom']; ?></td>
                <td><?php echo $line['F_description']; ?></td>
                <td><?php echo $line['F_lieu']; ?></td>
                <td><?php echo $line['F_prerequis']; ?></td>
                <td><?php echo $line['F_date_debut']; ?></td>
                <td><?php echo $line['F_duree']; ?></td>
                <td><input type="checkbox" class="TAB_click" name="check[]" value="<?php echo $no_id; ?>"></td>
                <!-- Là on a une combinaison name/value dans le checkbox. Cela permet de renvoyer la variable ckeck avec une valeur égale à celle de l'id de la formation -->
            </tr>
        <?php
    }
    ?> </table> </form> </section> <?php
}

function descriptionFormationsPartielles() { // FONCTION : afichage partiel de "formation" OUTDATED
    $tab = M2LgetFormation();
    ?>
    <section>
        <form action="accueil.php" method="post">
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
        <form action="accueil.php" method="post">
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
    $date = date("Y-m-d");
    echo "Nous sommes le $date";
}

function lheure() {
    $heure = date("H:i");
    echo "il est $heure";
}
    
?>