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
    $sql = "SELECT F_id, F_nom, F_description, F_lieu, F_prerequis FROM formation ORDER BY id DESC;";
    //$sql = "SELECT F_id, F_nom, F_description, F_lieu, F_prerequis, date_debut, duree_jour, duree_heure, DATE_ADD(date_debut, INTERVAL (duree_jour - 1) DAY) as date_fin FROM formation ORDER BY id DESC;";
    $values = $dbh->query($sql);
    $value2 = $values->fetchAll();
	return $value2;
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