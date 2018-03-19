<?php
include_once 'connexion.lib.php';

function formationAttente($id) {
    $tab = reqPolyvalente("SELECT F_id, F_nom, F_description, F_lieu, F_prerequis, F_date_debut, F_duree FROM formation INNER JOIN inscrits ON formation.F_id = inscrits.formation_F_id WHERE employe_E_id = \"$id\" AND I_statut = '1' ");
    // "SELECT formation_F_id, employe_E_id, I_statut FROM inscrits WHERE employe_E_id = \"$id\" AND I_statut = '1';"
    ?>
    <table class="TAB_table">
    <tr>
        <th>Id</th>
        <th>nom</th>
        <th>Description</th>
        <th>Lieu</th>
        <th>Prérequis</th>
        <th>Date_début</th>
        <th>Durée</th>
    </tr>
    <?php
    if($tab == array()) {
        ?>
        <tr>
            <td colspan="7">Vous n'avez aucune formation en attente de validation</td>
        </tr>
        <?php
    } else {
        foreach($tab as $line) {
            ?>
            <tr>
                <td><?php echo $line['F_id']; ?></td>
                <td><?php echo $line['F_nom']; ?></td>
                <td><?php echo $line['F_description']; ?></td>
                <td><?php echo $line['F_lieu']; ?></td>
                <td><?php echo $line['F_prerequis']; ?></td>
                <td><?php echo $line['F_date_debut']; ?></td>
                <td><?php echo $line['F_duree']; ?></td>
            </tr>
            <?php
        }
    }
    ?> <table> <?php
}

function jeminscrit($F_id, $E_id) {
    $valeur = reqPolyvalente("SELECT formation_F_id, employe_E_id, I_statut FROM inscrits WHERE formation_F_id = \"$F_id\" AND employe_E_id = \"$E_id\";");
    if($valeur == array()) {
        // l'employe n'existe pas : il faut l'ajouter.
        insertionPolyvalente("INSERT INTO inscrits VALUES (\"$F_id\", \"$E_id\", '1');");
        echo "La demande de formationn à bien été prise en compte.s";
    } else {
        // l'employe existe : .  il n'y a rien à faire (option innacessible/impossible quand site fini)
        echo "ERREUR : DEJA EXISTANT.";
    }
}

function chopId($login, $mdp) { // retourne la valeur de l'id de l'employe passé en paramètre
    $abc = reqPolyvalente("SELECT E_id FROM employe WHERE E_login =  \"$login\" AND E_mdp = \"$mdp\";");
    $abc = $abc[0]['E_id'];
    return $abc;
}

function affichageFormation() {
    $tab = reqPolyvalente("SELECT F_id, F_nom, F_description, F_lieu, F_prerequis, F_date_debut, F_duree FROM formation");
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

function estPresent2($a, $b) {
    return estPresent($a, $b);
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