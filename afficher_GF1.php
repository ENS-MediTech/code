<?php
$cnxBDD = new mysqli('localhost', 'root', 'Iroise29', 'MediTech', 3306);

if ($cnxBDD->connect_error) {
    die("Échec de la connexion à la base de données : " . $cnxBDD->connect_error);
}

$nom = $cnxBDD->real_escape_string($nom);
$prenom = $cnxBDD->real_escape_string($prenom);

$requete = "SELECT nom, prenom, date FROM visiteur";

$resultat = $cnxBDD->query($requete);

if (!$resultat) {
    die("Échec de la requête : " . $cnxBDD->error);
}

while ($ligne = $resultat->fetch_assoc()) {
    echo "Nom : " . $ligne['nom'] . "<br>";
    echo "Prénom : " . $ligne['prenom'] . "<br>";
    echo "Date : " . $ligne['date'] . "<br>";
    echo "<br>";
}

$resultat->free_result();

$cnxBDD->close();
?>