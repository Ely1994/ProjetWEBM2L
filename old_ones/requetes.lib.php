<?php
function requete1($value) { // insère dans la base de données les valeurs
	return 	"INSERT INTO commentaires VALUES (null,'$value');";
}

function requete2() {
	return "SELECT * FROM commentaires ORDER BY id DESC;";
}

function requete3($pseudo, $code) {
	return "SELECT * FROM personnes WHERE :pseudo = pseudo AND :code = code";
	bindValue(':pseudo',"Abcde");
}


// note : pour cracker le mot de passe, on remplace $pseudo par xx' OR 1=1 OR 'yy et $code par le même code. Et pif on est connecté. xx' OR 1='1
?>