<?php
$cnxBDD = new mysqli('localhost', 'root', 'Iroise29', 'MediTech', 3306);

if ($cnxBDD->connect_error) {
    die("Échec de la connexion à la base de données : " . $cnxBDD->connect_error);
}

$nom = $cnxBDD->real_escape_string($nom);
$prenom = $cnxBDD->real_escape_string($prenom);

$requete = "SELECT VIS_NOM, VIS_PRENOM, VIS_DATE_EMBAUCHE FROM visiteur";

$resultat = $cnxBDD->query($requete);

if (!$resultat) {
    die("Échec de la requête : " . $cnxBDD->error);
}

while ($ligne = $resultat->fetch_assoc()) {
    echo "Nom : " . $ligne['VIS_NOM'] . "<br>";
    echo "Prénom : " . $ligne['VIS_PRENOM'] . "<br>";
    echo "Date : " . $ligne['VIS_DATE_EMBAUCHE'] . "<br>";
    echo "<br>";
}

$resultat->free_result();

$cnxBDD->close();
?>
