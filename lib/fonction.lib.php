<?php
include_once 'connexion.lib.php';

function jeminscrit($F_id, $E_id) { // retourne 
    $valeur = inscription_inscrits($F_id, $E_id);
    
}

function chopId($login, $mdp) { // retourne la valeur de l'id de l'employe passé en paramètre
    return getE_id($login, $mdp);
}

function affichageFormation() {
    $tab = getFormation();
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