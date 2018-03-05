<?php
include_once("requetes.lib.php");


function connexion() {
	$host = "localhost";
	$dbname = "dbpjr";
	$utilisateur = "root";
	$mdp = "";
	// la connexion :
	$pdo = new PDO('mysql:host='.$host.';dbname='.$dbname, $utilisateur, $mdp) or die ("Prob connexion server");
	return $pdo;
}

function sendToDB($text) {
	$dbh = connexion(); // On met dans la variable dbh la connexion ci dessus
	$sql = requete1($_POST['message']); // requête SQL dans dataacces/requetes.php
	$insert = $dbh->exec($sql);
	if($insert === FALSE) {
		echo "Problème d'insertion de donées";
	}
}

function showFromDB() {
	$dbh = connexion(); // On met dans la variable dbh la connexion ci dessus
	$sql = requete2(); // requête SQL
	$values = $dbh->query($sql);
	return $values;
}

function connecteOupa($pseudo, $code) { // fonction utilisé our la vérification du pseudo+identifiant
	$code = md5($code);
	$dbh = connexion();
    $sql = "SELECT * FROM personnes WHERE :pseudo = pseudo AND :code = code";

    $stmt = $dbh->prepare($sql);

    $stmt->BindValue(':pseudo', $pseudo);
    $stmt->BindValue(':code', $code);

    $retour = $stmt->execute();
	
    // if($retour) {
    $retour = $stmt->fetchAll();
    // }

    $dbh = null;
	print_r($retour);
	if(count($retour) > 0) {
		return TRUE;
	} else {
		return FALSE; } 
}
?>