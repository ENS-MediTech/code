<?php
include "mesFonctionsGenerales.php";
// Connexion à la base de données BDEtudiant
$cnxBDD = new mysqli ('localhost', 'root', 'Iroise29' ,'MediTech', 3306);;
// les noms sont dans le fichier nom.txt
// debut booucle garcon
$i = 1;
while ($i <= 10) {
$NomFichier = 'nom.txt';
$tabloNomFamille = file($NomFichier);

// les prénoms garçon sont dans le fichier garcon.txt
$NomFichier = 'garcon.txt';
$tabloPrenom= file($NomFichier);
    //villes + code postal
$NomFichier = 'codeville.txt';
$tabloVille = file($NomFichier);

// rand(x, y) fournit un nombre au hasard entre x et y
$n = rand(1, sizeof($tabloNomFamille)); // $n contient un rang au hasard
$p = rand(1, sizeof($tabloPrenom));// $p contient un rang au hasard
$id = substr($tabloNomFamille[$n], 0, 4);
$v= rand(1, sizeof($tabloVille)); 
    
$ligne=$tabloVille[$v];
    $data = explode(';', $ligne);
    if (count($data) >= 4) {
        // Récupère les données nécessaires
        $codeCommune = $data[0];
        $nomCommune = $data[1];
        $codePostal = $data[2];

 $sql = "INSERT INTO visiteur(VIS_ID, VIS_NOM, VIS_PRENOM, VIS_ADRESSE, VIS_CP, VIS_VILLE, VIS_DATE_EMBAUCHE) VALUES ('$id', '$tabloNomFamille[$n]', '$tabloPrenom[$p]', NULL, '$codePostal', '$nomCommune', NULL)";

        echo "sql : " . $sql . "<br />";
        $result = $cnxBDD->query($sql) or die("Requête invalide : " . $sql);
    } else {
        echo "Erreur lors de la décomposition des données." . PHP_EOL;
    }
}




echo "sql : ".$sql."<br />";
$result = $cnxBDD->query($sql)
    or die ("Requête invalide : ".$sql);
$i++;
}
//fin garcon
//boucle fille
$i = 1;
while ($i <= 10) {
$NomFichier = 'nom.txt';
$tabloNomFamille = file($NomFichier);

// les prénoms garçon sont dans le fichier garcon.txt
$NomFichier = 'fille.txt';
$tabloPrenomF = file($NomFichier);


$NomFichier = 'codeville.txt';
$tabloVille = file($NomFichier);

// rand(x, y) fournit un nombre au hasard entre x et y
$n = rand(1, sizeof($tabloNomFamille)); // $n contient un rang au hasard
$p = rand(1, sizeof($tabloPrenomF));// $p contient un rang au hasard
$id = substr($tabloNomFamille[$n], 0, 4);
    $v= rand(1, sizeof($tabloVille)); 
    
$ligne=$tabloVille[$v];
    $data = explode(';', $ligne);
    if (count($data) >= 4) {
        // Récupère les données nécessaires
        $codeCommune = $data[0];
        $nomCommune = $data[1];
        $codePostal = $data[2];
//$id= rand (1, $tabloNomFamille[2]); mini code de Imaaaane
// Insertion dans la table ETUDIANT du nième nom de famille et du pième prénom 
$sql="INSERT INTO visiteur(VIS_ID, VIS_NOM, VIS_PRENOM, VIS_ADRESSE, VIS_CP, VIS_VILLE, VIS_DATE_EMBAUCHE) VALUES ('$id', '$tabloNomFamille[$n]', '$tabloPrenomF[$p]', NULL,'$codePostal', '$nomCommune', NULL)";

echo "sql : ".$sql."<br />";
$result = $cnxBDD->query($sql)
    or die ("Requête invalide : ".$sql);
$i++;
}
// Fermer la connexion MYSQL 
$cnxBDD->close();
?>
