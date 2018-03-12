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

// get the formation tableau
function M2LgetFormation() { // DATAACCES : accession à tout le contenu de formation
    $dbh = connexion();
    $req='SELECT F_id, F_nom, F_description, F_lieu, F_prerequis, F_date_debut, F_duree FROM formation';
    $prep=$dbh->prepare($req);
    $resultat=$prep->execute(array());
    $resultat=$prep->fetchAll();
    //print_r($resultat);
    return $resultat;
}

function connectmd5() { // code en md5
    $dbh = connexion();
    $sql = "IN";
}

// fonction qui vérifie la presence d'un duo logim/mdp sur la base de données
function estPresent($login, $mdp) { 
    //echo print_r($login);
    //echo print_r($mdp);
	$dbh = connexion();
    $sql = "SELECT E_login, E_mdp FROM employe WHERE :E_login = E_login AND :E_mdp = E_mdp;";

    $stmt = $dbh->prepare($sql);
    $stmt->BindValue(':E_login', $login);
    $stmt->BindValue(':E_mdp', $mdp);

    $retour = $stmt->execute();
    $retour = $stmt->fetchAll();

    $dbh = null;
	//print_r($retour);
	if(count($retour) > 0) {
		return TRUE;
	} else {
		return FALSE; } 
}
// htmlspecialchars()

function inscription($login, $mdp) {
    $dbh = connexion();
    $mdp = md5($mdp);
    $sql = "SELECT E_login, E_mdp FROM employe WHERE :E_login = E_login AND :E_mdp = E_mdp;";
    $stmt = $dbh->prepare($sql);
    $stmt->BindValue(':E_login', $login);
    $stmt->BindValue(':E_mdp', $mdp);
    $retour = $stmt->execute();
    $retour = $stmt->fetch();

    $date = ladate2();
    $reqMax = "SELECT MAX(E_id) FROM employe";
    $prep2 = $dbh->prepare($repMax);
    $max = $prep2->execute(array());
    $max = $prep2->fetch();
    $max = $max + 1;
    print_r($max);

    if(count($retour) == 0) {
        $sql2 = "INSERT INTO employe values('$max','unknowed', 'unknowed', '$login', '$mdp', '20', '$date', 'employe')";
        return TRUE;
	} else {
        echo "Erreur : combinaison déjà existante";
        return FALSE;
    } 
}

function ladate2() {
    $date = date("Y-m-d");
    return $date;
}
?>