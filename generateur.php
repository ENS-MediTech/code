<?php
include "mesFonctionsGenerales.php";

// Connexion à la base de données BDEtudiant
$cnxBDD = new mysqli('localhost', 'root', 'Iroise29', 'MediTech', 3306);

// Vérifier la connexion à la base de données
if ($cnxBDD->connect_error) {
    die("Erreur de connexion à la base de données : " . $cnxBDD->connect_error);
}

// Les noms sont dans le fichier nom.txt
$NomFichier = 'nom.txt';
$tabloNomFamille = file($NomFichier);

// Les noms sont dans le fichier prenomfille.txt
$NomFichier = 'fille.txt';
$tabloPrenomF = file($NomFichier);


// Les prénoms garçon sont dans le fichier garcon.txt
$NomFichier = 'garcon.txt';
$tabloPrenomG = file($NomFichier);

// Villes + code postal
$NomFichier = 'codeville.txt';
$tabloVille = file($NomFichier);

// Adresse
$NomFichier = 'adresse.txt';
$tabloAdresse = file($NomFichier);

// Boucle garçon
$i = 1;
while ($i <= 10) {
$idGG = "";
$idG = "";
    $n = rand(0, sizeof($tabloNomFamille) - 1);
    $p = rand(0, sizeof($tabloPrenomG) - 1);
    $v = rand(0, sizeof($tabloVille) - 1);
    $D = rand(0, count($tabloAdresse)-1);
    $idGG = substr($tabloNomFamille[$n], 0, 2);
    $idG = substr($tabloPrenomG[$p], 0, 2);

    $ligne = $tabloVille[$v];
    $data = explode(';', $ligne);

    if (count($data) >= 4) {
        $codeCommune = $data[0];
        $nomCommune = $data[1];
        $codePostal = $data[2];

        $sql = "INSERT INTO visiteur(VIS_ID, VIS_NOM, VIS_PRENOM, VIS_ADRESSE, VIS_CP, VIS_VILLE, VIS_DATE_EMBAUCHE) VALUES ('$idGG$idG', '$tabloNomFamille[$n]', '$tabloPrenomG[$p]', '$tabloAdresse[$D]', '$codePostal', '$nomCommune', NULL)";

        echo "sql : " . $sql . "<br />";
        $result = $cnxBDD->query($sql) or die("Requête invalide : " . $sql);
    } else {
        echo "Erreur lors de la décomposition des données." . PHP_EOL;
    }

    $i++;
}

// Boucle fille
$i = 1;
while ($i <= 10) {
    $idFF = "";
    $idF = "";
    $n = rand(0, sizeof($tabloNomFamille) - 1);
    $p = rand(0, sizeof($tabloPrenomF) - 1);
    $v = rand(0, sizeof($tabloVille) - 1);
    $D = rand(0, count($tabloAdresse)-1);
    $idFF = substr($tabloNomFamille[$n], 0, 2);
    $idF = substr($tabloPrenomF[$p], 0, 2);

    $ligne = $tabloVille[$v];
    $data = explode(';', $ligne);

    if (count($data) >= 4) {
        $codeCommune = $data[0];
        $nomCommune = $data[1];
        $codePostal = $data[2];

        $sql = "INSERT INTO visiteur(VIS_ID, VIS_NOM, VIS_PRENOM, VIS_ADRESSE, VIS_CP, VIS_VILLE, VIS_DATE_EMBAUCHE) VALUES ('$id$idF', '$tabloNomFamille[$n]', '$tabloPrenomF[$p]', '$tabloAdresse[$D]', '$codePostal', '$nomCommune', NULL)";

        echo "sql : " . $sql . "<br />";
        $result = $cnxBDD->query($sql) or die("Requête invalide : " . $sql);
    } else {
        echo "Erreur lors de la décomposition des données." . PHP_EOL;
    }

    $i++;
}

// Fermer la connexion MySQL
$cnxBDD->close();
?>
