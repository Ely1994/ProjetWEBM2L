<?php
include_once 'connexion.lib.php';

// crée un TAB qui affiche les formations.
function formationAttente($id) {
    $tab = reqPolyvalente("SELECT F_id, F_nom, F_description, F_lieu, F_prerequis, F_date_debut, F_duree, F_credits FROM formation INNER JOIN inscrits ON formation.F_id = inscrits.formation_F_id WHERE employe_E_id = \"$id\" AND I_statut = '1' ");
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
        <th>Crédits</th>
    </tr>
    <?php
    if($tab == array()) {
        ?>
        <tr>
            <td colspan="8">Vous n'avez aucune formation en attente de validation</td>
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
                <td><?php echo $line['F_credits']; ?></td>
            </tr>
            <?php
        }
    }
    ?> <table> <?php
}

// Selectionne et affiche la table employe pour une personne (id).
function formationValides($id) {
    $tab = reqPolyvalente("SELECT F_id, F_nom, F_description, F_lieu, F_prerequis, F_date_debut, F_duree, F_credits FROM formation INNER JOIN inscrits ON formation.F_id = inscrits.formation_F_id WHERE employe_E_id = \"$id\" AND I_statut = '2';");
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
        <th>Credits</th>
    </tr>
    <?php
    if($tab == array()) {
        ?>
        <tr>
            <td colspan="8">Vous n'avez aucune formation en attente de validation</td>
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
                <td><?php echo $line['F_credits']; ?></td>
            </tr>
            <?php
        }
    }
    ?> <table> <?php
}

function estGrade($E_id) {
    $array = reqPolyvalente("SELECT E_statut FROM employe WHERE E_id = \"$E_id\";");
    if($array[0]['E_statut'] == "chef") {
        return $array;
    } else {
        return false;
    }
}

function jeminscrit($F_id, $E_id) {
    $valeur = reqPolyvalente("SELECT formation_F_id, employe_E_id, I_statut FROM inscrits WHERE formation_F_id = \"$F_id\" AND employe_E_id = \"$E_id\";");
    if($valeur == array()) {
        // l'employe n'existe pas : il faut l'ajouter.
        insertionPolyvalente("INSERT INTO inscrits VALUES (\"$F_id\", \"$E_id\", '1');");
        echo "La demande de formation à bien été prise en compte (n°$F_id).<br>";
        //maintenant on gère les crédits :
        $tabcreds = reqPolyvalente("SELECT F_credits FROM formation WHERE F_id = \"$F_id\";");
        $creds = $tabcreds[0]['F_credits'];
        removeCredits($creds, $E_id);
    } else {
        // l'employe existe : il n'y a rien à faire (option qui peut arriver si l'utilisateur recharge la page.)
        echo "ERREUR : DEJA EXISTANT.";
    }
}
function addCredits($num, $E_id) {
    $tabcreds = reqPolyvalente("SELECT E_credits FROM employe WHERE E_id = \"$E_id\";");
    $creds = $tabcreds[0]['E_credits'];
    $tot = $creds + $num;
    insertionPolyvalente("UPDATE employe SET E_credits = \"$tot\" WHERE E_id = \"$E_id\";");
}
function removeCredits($num, $E_id) {
    $tabcreds = reqPolyvalente("SELECT E_credits FROM employe WHERE E_id = \"$E_id\";");
    $creds = $tabcreds[0]['E_credits'];
    $tot = $creds - $num;
    insertionPolyvalente("UPDATE employe SET E_credits = \"$tot\" WHERE E_id = \"$E_id\";");
}

function chopId($login, $mdp) { // retourne la valeur de l'id de l'employe passé en paramètre
    $abc = reqPolyvalente("SELECT E_id FROM employe WHERE E_login =  \"$login\" AND E_mdp = \"$mdp\";");
    $abc = $abc[0]['E_id'];
    return $abc;
}

function allFormationAttente() {
    $tabAllForm = reqPolyvalente("SELECT F_id, F_nom, F_description, F_lieu, F_prerequis, F_date_debut, F_duree, E_login, E_id FROM formation INNER JOIN inscrits ON formation.F_id = inscrits.formation_F_id INNER JOIN employe ON employe.E_id = inscrits.employe_E_id WHERE I_statut = '1';");
    ?>
    <form action="profil.php" method="post">
    <table class="TAB_table">
        <tr>
            <th>Id</th>
            <th>nom</th>
            <th>Description</th>
            <th>Lieu</th>
            <th>Prérequis</th>
            <th>Date_début</th>
            <th>Durée</th>
            <th>Personne</th>
            <th>Valider</th>
            <th>Refuser</th>
        </tr>
    <?php
    foreach($tabAllForm as $line) {        
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
            <td><?php echo $line['E_login']; ?></td>
            <td><input class="TAB_submit" name="Accepter" type="submit" value="<?php echo $line['E_id'];?>/<?php echo $no_id;?>/Accepter"></td>
            <td><input class="TAB_submit" name="Refuser" type="submit" value="<?php echo $line['E_id'];?>/<?php echo $no_id;?>/Refuser"></td>
            <!-- Là on a une combinaison name/value dans le checkbox. Cela permet de renvoyer la variable ckeck avec une valeur égale à celle de l'id de la formation -->
        </tr>
        <?php
        
    }
    ?> </table> </form>
    <?php
}

function affichageFormation() {
    $id = $_SESSION['id'];
    $tabInscrits = reqPolyvalente("SELECT formation_F_id FROM inscrits WHERE employe_E_id = \"$id\";");
    $tab = reqPolyvalente("SELECT F_id, F_nom, F_description, F_lieu, F_prerequis, F_date_debut, F_duree, F_credits FROM formation");
    ?>
    <section>
    <h3>Affichage des formations auxquelles vous n'êtes pas inscrits (fn):</h3>
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
                <th>Credits</th>
                <th><input class="TAB_submit" type="submit" value="Sélectionner"></th>
            </tr>
        <?php
            foreach($tab as $line) {
                $abc = existe($tabInscrits, $line['F_id']);
                if($abc == TRUE) {
                    // inscrit à la formation : ne rien mettre
                } else {
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
                <td><?php echo $line['F_credits']; ?></td>
                <?php
                $tabcreds = reqPolyvalente("SELECT E_credits FROM employe WHERE E_id = \"$id\";");
                $creds = $tabcreds[0]['E_credits'];
                if($line['F_credits'] > $creds) {
                    ?>
                    <td>Vous n'avez pas assez de crédits (<?php echo $creds; ?>)</td>
                    <?php
                } else {
                    ?>
                    <td><input type="checkbox" class="TAB_click" name="check[]" value="<?php echo $no_id; ?>"></td>
                    <!-- Là on a une combinaison name/value dans le checkbox. Cela permet de renvoyer la variable ckeck avec une valeur égale à celle de l'id de la formation -->
                    <?php
                }
                ?>
                
            </tr>
            <?php
        }
    }
    ?> </table> </form> </section> 
    <?php
}
function existe($tabInscrits, $F_id) {
    foreach($tabInscrits as $line) {
        //$Fid = $line["formation_F_id"];
        if($line["formation_F_id"] == $F_id) {
            return TRUE;
        } else {
            
        }
    }
    return FALSE;
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