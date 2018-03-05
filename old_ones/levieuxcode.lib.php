<?php

function descriptionFormationsPartielles() { // FONCTION : afichage partiel de "formation" OUTDATED
    $tab = M2LgetFormation();
    $num = 0;
    foreach($tab as $line) { 
        // $num = $line['id']; echo "ecris".$num."()"; ?>
        <section> <h2>Formation : 
        <?php //echo $line['id']; ?>
        <!-- de -->
        <?php echo $line['nom']; ?>
        </h2><p>
        <?php echo $line['description']; ?>
        </p>
        <input type="button" value=" details " onclick="descriptionOneFormationComplete(<?php echo $line['id']; ?>)" /><br/>
        
        </section>
        <?php
    }
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






function formPartNonExpi() {
    $dbh=connexion();
    //$sql="select intitule_formation as intitule, Date_formation as datedeb, DATE_ADD(Date_formation, INTERVAL NbrJour_formation-1 DAY) as datefin, NbrJour_formation as jour, statut_formation as statut from formation;";
    $sql = 'SELECT id, nom, description, date_debut, duree_jour, duree_heure, lieu, prerequis, DATE_ADD(date_debut, INTERVAL (duree_jour - 1) DAY) as date_fin FROM formation ORDER BY id DESC;';
    $resultat=$dbh->query($sql);
    $row=$resultat->fetchAll();
    $nbr=count($row);
    $k=0;
    foreach ($row as $result) { // on mets les valeurs qui intéressent dans les tableaux 1 à 9.
        $tab1[$k]=$result['id'];
        $tab2[$k]=$result['nom'];
        $tab3[$k]=$result['description'];
        $tab4[$k]=$result['lieu'];
        $tab5[$k]=$result['prerequis'];
        $tab6[$k]=$result['date_debut'];
        $tab7[$k]=$result['duree_heure'];
        $tab8[$k]=$result['duree_jour'];
        $tab9[$k]=$result['date_fin'];
        $k++;
    }
    ?>
    <section> <!-- Là on crée la première section qui nous permettra de séléctionner les formation (le début du FORM) -->
        <form action="M2Laccueil.php" method="post">
        <p><label>Clique ici </label>
        <input type="submit" name="envoyer" value="Voir les Détails">
        <label> pour voir les détails des formations que tu as coché.</label></p>
        <p><label>Si tu veux voir toutes les formations même celles qui sont déjà finies, valide_moi ça : </label>
        <select name="viewold">
            <option value="0"> </option>
            <option value="1">Je veux voir tous les anciennes formations !</option>
		</select>
        </p>
    </section>
    <?php
    for ($i=0; $i<$nbr; $i++) { // Là on crée une section par ligne de tableau ou presque (si date expirée, on affiche pas)
        $date = date("d-m-Y"); 
        if(strtotime($tab6[$i]) >= strtotime($date)) {
            // echo "Valide";
            ?>
            <section><p>Formation : <strong>
            <?php echo $tab2[$i]; ?>
            </strong>.       Description : 
            <?php echo $tab3[$i]; ?>
            </p><label>Je veux les details : </label><input type="checkbox" name="checkbox[]" value="<?php echo $tab1[$i]; ?>">
            </section>
            <?php
        } else {
            // echo "Date dépassée";
        }
    }
    ?> </select> </form> <?php
}
function formPart() {
    $dbh=connexion();
    //$sql="select intitule_formation as intitule, Date_formation as datedeb, DATE_ADD(Date_formation, INTERVAL NbrJour_formation-1 DAY) as datefin, NbrJour_formation as jour, statut_formation as statut from formation;";
    $sql = 'SELECT id, nom, description, date_debut, duree_jour, duree_heure, lieu, prerequis, DATE_ADD(date_debut, INTERVAL (duree_jour - 1) DAY) as date_fin FROM formation ORDER BY id DESC;';
    $resultat=$dbh->query($sql);
    $row=$resultat->fetchAll();
    $nbr=count($row);
    $k=0;
    foreach ($row as $result) { // on mets les valeurs qui intéressent dans les tableaux 1 à 9.
        $tab1[$k]=$result['id'];
        $tab2[$k]=$result['nom'];
        $tab3[$k]=$result['description'];
        $tab4[$k]=$result['lieu'];
        $tab5[$k]=$result['prerequis'];
        $tab6[$k]=$result['date_debut'];
        $tab7[$k]=$result['duree_heure'];
        $tab8[$k]=$result['duree_jour'];
        $tab9[$k]=$result['date_fin'];
        $k++;
    }
    ?>
    <section> <!-- Là on crée la première section qui nous permettra de séléctionner les formation (le début du FORM) -->
        <form action="M2Laccueil.php" method="post">
        <p><label>Clique ici </label>
        <input type="submit" name="envoyer" value="Voir les Détails">
        <label> pour voir les détails des formations que tu as coché.</label></p>
        <p><label>Si tu veux voir toutes les formations même celles qui sont déjà finies, valide_moi ça : </label>
        <select name="viewold">
            <option value="0"> </option>
            <option value="1">Je veux voir tous les anciennes formations !</option>
		</select>
        </p>
    </section>
    <?php
    for ($i=0; $i<$nbr; $i++) { // Là on crée une section par ligne de tableau ou presque (si date expirée, on affiche pas)
        ?>
        <section><p>Formation : <strong>
        <?php echo $tab2[$i]; ?>
        </strong>.       Description : 
        <?php echo $tab3[$i]; ?>
        </p><label>Je veux les details : </label><input type="checkbox" name="checkbox[]" value="<?php echo $tab1[$i]; ?>">
        </section>
        <?php
    }
    ?> </select> </form> <?php
}
function descMain($requete) {
    $dbh = connexion();
    //$values = $dbh->query($requete);
    //echo print_r($values);
    //$tableau = $values->fetchAll();

    $stm = $dbh->prepare($requete);
    $stm->execute(array('id', 'nom', 'description', 'date_debut', 'duree_jour', 'duree_heure', 'lieu', 'prerequis', 'date_fin'));
    if($stm != NULL) {
        while($row = $stm->fetch(PDO::FETCH_OBJ)) {
            //echo $row->description;
        }
    } else {
        echo '$stm null.';
    }
    ?>
    <section>
        <form action="M2Laccueil.php" method="post">
        <p><label>Clique ici </label>
        <input type="submit" name="envoyer" value="Voir les Détails">
        <label> pour voir les détails des formations que tu as coché.</label></p>
        <p><label>Si tu veux voir toutes les formations même celles qui sont déjà finies, valide_moi ça : </label>
        <select name="viewold">
            <option value="0"> </option>
            <option value="1">Je veux voir tous les anciennes formations !</option>
		</select>
        </p>
    </section>
    <?php
    echo print_r($tableau);
    foreach($tableau as $line) {
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
            <?php
               
            ?>
            </section>
            <?php
        } else {
            // echo "Date dépassée";

        }
    }
    ?> </select> </form> <?php
}

?>