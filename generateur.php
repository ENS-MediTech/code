<?php
include "mesFonctionsGenerales.php";

// Connexion à la base de données BDEtudiant
$cnxBDD = new mysqli ('localhost', 'root', 'Iroise29' ,'MediTech', 3306);;

// les noms sont dans le fichier nom.txt
$NomFichier = 'nom.txt';
$tabloNomFamille = file($NomFichier);

// les prénoms garçon sont dans le fichier garcon.txt
$NomFichier = 'garcon.txt';
$tabloPrenom = file($NomFichier);


$NomFichier = 'codeville.txt';
$tabloVille = file($NomFichier);

// rand(x, y) fournit un nombre au hasard entre x et y
$n = rand(1, sizeof($tabloNomFamille)); // $n contient un rang au hasard
$p = rand(1, sizeof($tabloPrenom));     // $p contient un rang au hasard

$id = substr($tabloNomFamille[$n], 0, 4);
//$id= rand (1, $tabloNomFamille[2]); mini code de Imaaaane
// Insertion dans la table ETUDIANT du nième nom de famille et du pième prénom 
$sql="INSERT INTO visiteur(VIS_ID, VIS_NOM, VIS_PRENOM, VIS_ADRESSE, VIS_CP, VIS_VILLE, VIS_DATE_EMBAUCHE) VALUES ('$id', '$tabloNomFamille[$n]', '$tabloPrenom[$p]', NULL, '$commune', '$cp', NULL)";

echo "sql : ".$sql."<br />";
$result = $cnxBDD->query($sql)
    or die ("Requête invalide : ".$sql);

// Fermer la connexion MYSQL 
$cnxBDD->close();
?>
