<?php

function connexion(){
    $host = "localhost";
        $user = "root";
        $password = "";
        $dbname = "BDETUDIANT";
        $port ="3306";

        $mysqli = new mysqli($host, $user, $password, $dbname, $port);
        if ($mysqli->connect_errno) {
            echo "Echec lors de la connexion à MySQL : (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
            return($mysqli->connect_errno);
        }
        return $mysqli;

}
       
function erreurSQL() {
    global $cnxBDD;
    
    $err = mysql_errno($link) . ": " . mysql_error($cnxBDD). "\n";
    return $err;
}

function afficheErreur($sql, $erreur) {

	$uneChaine = "ERREUR SQL : ".date("j M Y - G:i:s.u --> ").$sql." : ($erreur) \r\n";

	ecritRequeteSQL($uneChaine);

	return "Erreur SQL de <b>".$_SERVER["SCRIPT_NAME"].
	"</b>.<br />Dans le fichier : ".__FILE__.
	" a la ligne : ".__LINE__.
	"<br />".$erreur.
	"<br /><br /><b>REQUETE SQL : </b>$sql<br />";

}

function ecritRequeteSQL($uneChaine) {
	$handle=fopen("requete.sql","a");
	fwrite($handle,$uneChaine);
	fclose($handle);
}



function ExtraireCommune($ligne, &$commune, &$cp) {
    // Séparation des champs de la ligne
    $champs = explode(';', $ligne);

    // Vérification du nombre de champs
    if (count($champs) >= 4) {
        // Extraction du nom de la commune et du code postal
        $commune = $champs[1];
        $cp = $champs[2];

        // Retourne true pour indiquer le succès
        return true;
    } else {
        // Retourne false si le nombre de champs est incorrect
        return false;
    }
}

?>







