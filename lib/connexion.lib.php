<?php

function connexion() { // DATAACCES : connexion à la base de données dbpjr
	$host = "localhost";
	$dbname = "dbpjr";
	$utilisateur = "root";
	$mdp = "";
	// la connexion :
	$pdo = new PDO('mysql:host='.$host.';dbname='.$dbname, $utilisateur, $mdp,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')) or die ("Prob connexion server");
	return $pdo;
}

function M2LgetFormation() { // DATAACCES : accession à tout le contenu de formation
    $dbh = connexion();
    $sql = 'SELECT F_id, F_nom, F_description, F_lieu, F_prerequis FROM formation WHERE date_Formation>CURDATE() ORDER BY id;';
    /*  DESC */
    //$sql = "SELECT F_id, F_nom, F_description, F_lieu, F_prerequis, date_debut, duree_jour, duree_heure, DATE_ADD(date_debut, INTERVAL (duree_jour - 1) DAY) as date_fin FROM formation ORDER BY id DESC;";
    $prep=$dbh->prepare($sql);
    $resultat=$prep->execute(array());
    $resultat=$prep->fetchAll();
    print_r($resultat);
    return $resultat;
/* vieux code
    $values = $dbh->query($sql);
    $value2 = $values->fetchAll();
    return $value2;
*/
/* le code de frank
    $dbh=connexion();
    $req='SELECT id_Formation,titre_Formation,description_forma,date_Formation,duree_Formation,nom_Prestataire,credit FROM Prestataire inner join Formation on Prestataire.id_Prestataire=Formation.id_Prestataire where date_Formation>CURDATE()';
    $prep=$dbh->prepare($req);
    $resultat=$prep->execute(array());
    $resultat=$prep->fetchAll();
    return $resultat;
*/
/* un code 
    $dbh = connexion();
    $sql = "SELECT F_id, F_nom, F_description, F_lieu, F_prerequis FROM formation WHERE :F_id = F_id AND :F_nom = F_nom AND :F_description = F_description AND :F_lieu = F_lieu AND :F_prerequis = F_prerequis;";
    $stmt = $dbh->prepare($sql);
    $stmt->BindValue(':F_id', $id);
    $stmt->BindValue(':F_nom', $nom);
    $stmt->BindValue(':F_description', $description);
    $stmt->BindValue(':F_lieu', $lieu);
    $stmt->BindValue(':F_prerequis', $prerequis);

    $retour = $stmt->execute();
    $retour = $stmt->fetchAll();
    return $retour;
    */
}

function connectmd5() { // code en md5
    $dbh = connexion();
    $sql = "IN";
}

function M2LreqPrep($login, $mdp) { // REQUETE PREPAREE pour TEST, récup id et nom
    $dbh = connexion();
    $sql = "SELECT F_login, F_mdp FROM formation WHERE :F_login = F_login AND :F_mdp = F_mdp;";

    $stmt = $dbh->prepare($sql);

    $stmt->BindValue(':login', $login);
    $stmt->BindValue(':mdp', $mdp);

    $retour = $stmt->execute();

    $retour = $stmt->fetchAll();

    $dbh = null;
    // print_r($retour);
    return $retour; // retour tableau
}

// fonction qui vérifie la presence d'un duo logim/mdp sur la base de données
function estPresent($login, $mdp) { 
    echo print_r($login);
    echo print_r($mdp);
	$dbh = connexion();
    $sql = "SELECT E_login, E_mdp FROM employe WHERE :E_login = E_login AND :E_mdp = E_mdp;";

    $stmt = $dbh->prepare($sql);
    $stmt->BindValue(':E_login', $login);
    $stmt->BindValue(':E_mdp', $mdp);

    $retour = $stmt->execute();
    $retour = $stmt->fetchAll();

    $dbh = null;
	print_r($retour);
	if(count($retour) > 0) {
		return TRUE;
	} else {
		return FALSE; } 
}

?>